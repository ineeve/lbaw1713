<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Response;
use App\Comment;
use Illuminate\Http\RedirectResponse;

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
        $this->authorize('store', Comment::class);
        $request['creator_user_id'] = Auth::user()->id;
        $request['target_news_id'] = $news_id;
        Comment::create($request->all());
        return back();
    }

    public function update($news_id, $comm_id, Request $request) {
        $comment = Comment::find($comm_id);
        $this->authorize('update', $comment);
        $comment->save($request->body);
        // TODO: see if happened
        $status_code = 200; 
        return Response::json($comment->id, $comment->body, $status_code);
    }

    public function delete($news_id, $comm_id) {
        $comment = Comment::find($comm_id);
        $this->authorize('delete', $comment);
        Comment::destroy($comm_id);
        // TODO: see if happened
        $status_code = 200; 
        return Response::json($comm_id, $status_code);
      }  

}