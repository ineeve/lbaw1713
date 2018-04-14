<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Comment;

class CommentController extends Controller
{

    /**
     * Store a newly created resource in storage.
     * POST.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($news_id, Request $request) {
        $request['creator_user_id'] = Auth::user()->id;
        $request['target_news_id'] = $news_id;
        Comment::create($request->all());
        return back();
    }
}
