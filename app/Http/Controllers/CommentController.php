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
       // dd($request);
        $comment->text = $request->text;
        $comment->save();
        // TODO: see if happened
        $status_code = 200; 
        return Response::json(['id' => $comment->id, 'body' => $comment->text], $status_code);
    }

    public function delete($news_id, $comm_id) {
        $comment = Comment::find($comm_id);
        if(!is_null($comment)) {
            $status_code = 200; 
            $this->authorize('delete', $comment);
            if (Auth::user()->id == $comment->creator_user_id){
                Comment::destroy($comm_id);
            } else {
                $this->markDeleted($comm_id);
            }
        } else {
            $status_code = 404;
        }
        
        return Response::json($comm_id, $status_code);
    }
    
    public function markDeleted($comm_id){
        $deletedItems = DB::table('deleteditems')->where('comment_id', $comm_id)->get();
        if (count($deletedItems) > 0) {
        // item was already deleted
            return;
      }
      DB::insert('INSERT INTO DeletedItems (user_id, comment_id) VALUES (?, ?);', [Auth::user()->id, $comm_id]);
    }

}