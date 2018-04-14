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
    $comments =  DB::select('SELECT text, date, Users.username AS commentator
        FROM Comments, Users
        WHERE Comments.target_news_id = ? AND Comments.creator_user_id = Users.id
        AND NOT EXISTS (SELECT DeletedItems.comment_id FROM DeletedItems WHERE DeletedItems.comment_id = Comments.id)
        ORDER BY date DESC LIMIT 10 OFFSET ?; ',[$news_id, $request->input('next_comment')]);

    $status_code = 200; // TODO: change if not found!
    $data = [
        'view' => View::make('partials.comment')
            ->with('comments', $comments)
            ->render(),
        'next' => count($comments)
    ];

    return Response::json($data, $status_code);
    
 }

 public function changeToSectionAll(Request $request) {

    $news = DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview 
    FROM news JOIN users ON news.author_id = users.id WHERE NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE News.id = DeletedItems.news_id)
    ORDER BY date DESC LIMIT 10 OFFSET 0');
    $status_code = 200; // TODO: change if not found!
    $view = View::make('partials.news_item_preview_list')->with('news', $news)->render();
    $data = ['news' => $view];

    return Response::json($data, $status_code);
    
 }

 public function changeSection(Request $request, $section) {
    $news = DB::select('SELECT news.id, title, users.username As author, date, votes, image, substring(body, \'(?:<p>)[^<>]*\.(?:<\/p>)\') as body_preview 
    FROM news JOIN users ON news.author_id = users.id JOIN sections ON sections.id = news.section_id
    WHERE sections.name = ? AND NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE News.id = DeletedItems.news_id)
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


alert($request->input('next_preview'));


    $status_code = 200; // TODO: change if not found!
    $view = View::make('partials.news_item_preview_list')->with('news', $news)->render();
    $data = ['news' => $view];

    return Response::json($data, $status_code);
    
 }


}