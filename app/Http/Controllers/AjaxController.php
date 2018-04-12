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

    $comments =  DB::select('SELECT text, date, Users.username AS commentator
        FROM Comments, Users
        WHERE Comments.target_news_id = ? AND Comments.creator_user_id = Users.id
        AND NOT EXISTS (SELECT DeletedItems.comment_id FROM DeletedItems WHERE DeletedItems.comment_id = Comments.id)
        ORDER BY date DESC LIMIT 10 OFFSET ?; ',[$news_id, $request->input('next_comment')]);

    $status_code = 200; // TODO: change if not found!
    $data = [
        'view' => View::make('partials.comment')
            ->with('comments', $comments)
            ->render()
    ];

    return Response::json($data, $status_code);
    return response()->json($comments, $status_code);
 }
}