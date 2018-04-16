<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    const FOLLOW = 'FollowMe';
    const VOTE = 'VoteMyPost';
    const COMMENT = 'CommentMyPost';
    const PUBLISH = 'FollowedPublish';

    public function process($id) {
        $notification = Notification::find($id);
        $this->authorize('process', $notification);
        switch ($notification->type) {
            case self::FOLLOW:
                return redirect('users/'.$notification->user_id);
            case self::VOTE:
            case self::COMMENT:
            case self::PUBLISH:
                return redirect('news/'.$notification->news_id);
            default:
                return redirect('error/404');
        }
    }
}
