<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Response;

class AjaxController extends Controller {
   public function index(){
      $msg = "This is a simple message.";
      return response()->json(array('msg'=> $msg), 200);
   }

    public function scrollComments(Request $request, $news_id) {

    // echo "ECHOING NEWS ID: ".$news_id;
    $comments =  DB::select('SELECT Comments.id AS id,text, date, Users.username AS commentator, Users.picture AS commentator_picture
        FROM Comments, Users
        WHERE Comments.target_news_id = ? AND Comments.creator_user_id = Users.id
        AND NOT EXISTS (SELECT DeletedItems.comment_id FROM DeletedItems WHERE DeletedItems.comment_id = Comments.id)
        ORDER BY date DESC LIMIT 10 OFFSET ?; ',[$news_id, $request->input('next_comment')]);

    $status_code = 200; // TODO: change if not found!
    $data = [
        'view' => View::make('partials.comment')
            ->with('comments', $comments)
            ->with('news_id',$news_id)
            ->render(),
        'next' => count($comments)
    ];

    return Response::json($data, $status_code);
    
 }

 public function changeToSectionAll(Request $request) {

    $news = DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview 
                        FROM news JOIN users ON news.author_id = users.id
                        WHERE NOT EXISTS (SELECT * FROM DeletedItems WHERE News.id = DeletedItems.news_id)
                        ORDER BY date DESC LIMIT 10 OFFSET 0');
    $status_code = 200; // TODO: change if not found!
    $view = View::make('partials.news_item_preview_list')->with('news', $news)->render();
    $data = ['news' => $view];

    return Response::json($data, $status_code);
    
 }

 public function changeSection(Request $request, $section) {
    $news = DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview 
                        FROM news JOIN users ON news.author_id = users.id JOIN sections ON sections.id = news.section_id
                        WHERE sections.name = ?
                            AND NOT EXISTS (SELECT * FROM DeletedItems WHERE News.id = DeletedItems.news_id)
                        ORDER BY date DESC LIMIT 10 OFFSET 0', [$section]);
    $status_code = 200; // TODO: change if not found!
    $view = View::make('partials.news_item_preview_list')->with('news', $news)->render();
    $data = ['news' => $view];


    return Response::json($data, $status_code);
    
 }

 public function showMorePreviews(Request $request, $section) {
    $news = DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview 
    FROM news JOIN users ON news.author_id = users.id JOIN sections ON sections.id = news.section_id
    WHERE sections.name = ? AND NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE News.id = DeletedItems.news_id)
    ORDER BY date DESC LIMIT 10 OFFSET ?',[$section, $request->input('next_preview')]);

    $status_code = 200; // TODO: change if not found!
    $view = View::make('partials.news_item_preview_list')->with('news', $news)->render();
    $data = ['news' => $view];

    return Response::json($data, $status_code);
 }

 public function showMorePreviewsOfAll(Request $request) {

    $news = DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview 
    FROM news JOIN users ON news.author_id = users.id WHERE NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE News.id = DeletedItems.news_id)
    ORDER BY date DESC LIMIT 10 OFFSET ?',[$request->input('next_preview')]);
    $status_code = 200; // TODO: change if not found!
    $view = View::make('partials.news_item_preview_list')->with('news', $news)->render();
    $data = ['news' => $view];

    return Response::json($data, $status_code);
    
 }
 public function userOwnsNews($news_id,$user_id){
    $result = DB::select('SELECT * FROM news WHERE id = ? AND author_id = ?',[$news_id,$user_id]);
    return !empty($result);
 }

 public function getUserVote(Request $request,$news_id){
    $auth_user = \Auth::user();
    $return['value']='null';
    if ($auth_user != null){
        $user_id = $auth_user->id;
        $previousVote = DB::select('SELECT type from votes WHERE user_id = ? AND news_id = ?',[$user_id,$news_id]);
        if (is_array($previousVote) && !empty($previousVote)){
            $return['value']= $previousVote[0]->type ? 'up' : 'down';;
        }
    }
    echo json_encode($return);  
 }

 public function createVote(Request $request, $news_id){
    $user_id = \Auth::user()->id;
    $request_vote_type = ($request->input('type') == 'true' ? TRUE : FALSE);
    
    //Check user does not own the news
    if ($this->userOwnsNews($news_id,$user_id)){
        $return['action'] = 'none';
        $return['votes'] = DB::select('SELECT votes FROM news WHERE id = ?', [$news_id])[0]->votes;
    }else{
        //Check if user has voted before
        $previousVote = DB::select('SELECT type from votes WHERE user_id = ? AND news_id = ?',[$user_id,$news_id]);
        if (empty($previousVote)){
            DB::select('INSERT INTO Votes (user_id, news_id, type) VALUES (?, ?, ?);',[$user_id,$news_id,$request_vote_type]);
            $return['action'] = 'insert';
        }else{
            //vote already exists
            $previousVote = $previousVote[0]->type;
            if($previousVote == $request_vote_type){
                DB::select('DELETE FROM votes WHERE user_id=? AND news_id=?',[$user_id,$news_id]);
                $return['action'] = 'delete';
            }else{
                DB::select('UPDATE Votes SET type=? WHERE user_id=? AND news_id=?',[$request_vote_type,$user_id,$news_id]);
                $return['action'] = 'update';    
            }
                    
        }
        $return['value'] = ($request_vote_type) ? 'up' : 'down';    
        $return['votes'] = DB::select('SELECT votes FROM news WHERE id = ?', [$news_id])[0]->votes;
    }
    echo json_encode($return);
 }




}