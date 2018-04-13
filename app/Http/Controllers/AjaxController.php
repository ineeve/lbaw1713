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

    $news =  DB::select('SELECT title, date, body, image, votes, Sections.name, Users.username
                        FROM News, Sections, Users
                        WHERE Sections.id = News.section_id AND Users.id = News.author_id
                        AND NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE News.id = DeletedItems.news_id)
                        ORDER BY date DESC LIMIT 10 OFFSET 0;');

    $sections = DB::select('SELECT icon, name FROM Sections');

    $status_code = 200; // TODO: change if not found!
    $data = [
        'view' => View::make('partials.news')
            ->with('news', $news)
            ->with('sections', $sections)
            ->render()
    ];

    return Response::json($data, $status_code);
    
 }

 public function changeSection(Request $request, $section) {

    $news =  DB::select('SELECT title, date, body, image, votes, Sections.name, Users.username
    FROM News, Sections, Users
    WHERE Sections.id = News.section_id AND Users.id = News.author_id AND Sections.name = $section
    AND NOT EXISTS (SELECT DeletedItems.news_id FROM DeletedItems WHERE News.id = DeletedItems.news_id)
    ORDER BY date DESC LIMIT 10 OFFSET 0;', [$section]);

    $status_code = 200; // TODO: change if not found!
    $data = [
        'view' => View::make('partials.section')
            ->with('section', $news)
            ->render()
    ];

    return Response::json($data, $status_code);
    
 }


}