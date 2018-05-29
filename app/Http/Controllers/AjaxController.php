<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\News as News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use App\Comment;
class AjaxController extends Controller
{
    public function index()
    {
        $msg = "This is a simple message.";
        return response()->json(array('msg' => $msg), 200);
    }

    public function scrollComments(Request $request, $news_id)
    {

         $comments = Comment::getComments($request, $news_id);
        $status_code = 200;
        $data = [
            'view' => View::make('partials.comment')
                ->with('comments', $comments)
                ->with('news_id', $news_id)
                ->render(),
            'next' => count($comments),
        ];

        return Response::json($data, $status_code);
    }

    public function showMorePreviews(Request $request, $section)
    {
        $news = News::getNews($request, $section);

        $status_code = 200;
        $view = View::make('partials.news_item_preview_list')->with('news', $news)->render();
        $data = ['news' => $view];

        return Response::json($data, $status_code);
    }

    public function showMorePreviewsOfAll(Request $request)
    {

        $news = News::getPreviews($request);
        $status_code = 200;
        $view = View::make('partials.news_item_preview_list')->with('news', $news)->render();
        $data = ['news' => $view];

        return Response::json($data, $status_code);
    }

    public function userOwnsNews($news_id, $user_id)
    {
        $result = News::userOwnsNews($news_id, $user_id);
        return !empty($result);
    }

    public function getUserVote(Request $request, $news_id)
    {
        $auth_user = \Auth::user();
        $return['value'] = 'null';
        if ($auth_user != null) {
            $user_id = $auth_user->id;
            $previousVote = News::getVote($news_id, $user_id);
            if (is_array($previousVote) && !empty($previousVote)) {
                $return['value'] = $previousVote[0]->type ? 'up' : 'down';
            }
        }
        echo json_encode($return);
    }

    public function createVote(Request $request, $news_id)
    {
        $user_id = \Auth::user()->id;
        $request_vote_type = ($request->input('type') == 'true' ? true : false);

        //Check user does not own the news
        if ($this->userOwnsNews($news_id, $user_id)) {
            $return['action'] = 'none';
            $return['votes'] = News::getVotes($news_id)[0]->votes;
        } else {
            //Check if user has voted before
            $previousVote = News::getVote($news_id, $user_id);
            if (empty($previousVote)) {
                News::insertVote($user_id, $news_id, $request_vote_type);
                $return['action'] = 'insert';
            } else {
                //vote already exists
                $previousVote = $previousVote[0]->type;
                if ($previousVote == $request_vote_type) {
                    News::deleteVote($user_id, $news_id);
                    $return['action'] = 'delete';

                } else {
                    News::updateVote($user_id, $news_id, $request_vote_type);
                    $return['action'] = 'update';
                }

            }
            $return['value'] = ($request_vote_type) ? 'up' : 'down';
            $return['votes'] = News::getVotes($news_id)[0]->votes;
        }
        echo json_encode($return);
    }

}
