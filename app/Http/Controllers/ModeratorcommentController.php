<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Moderatorcomment;

class ModeratorcommentController extends Controller
{
    public function createnews($news_id, Request $request) {
        $request['creator_user_id'] = Auth::user()->id;
        $request['news_id'] = $news_id;
        Moderatorcomment::create($request->all());
        return back();
    }
    public function createcomments($news_id, $comment_id, Request $request) {
        $request['creator_user_id'] = Auth::user()->id;
        $request['comment_id'] = $comment_id;
        Moderatorcomment::create($request->all());
        return back();
    }
}
