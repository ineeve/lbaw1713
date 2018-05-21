<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\DB;
class NotificationController extends Controller
{
    const FOLLOW = 'FollowMe';
    const VOTE = 'VoteMyPost';
    const COMMENT = 'CommentMyPost';
    const PUBLISH = 'FollowedPublish';

    public function queryUser($user_id) {
        $user = DB::select('SELECT users.id, username, email, gender, Countries.name As country, picture, points, permission
        FROM users NATURAL JOIN countries
        WHERE users.id = ?;',[$user_id]);
  
        if(count($user) == 0) {
          return redirect('/error/404');
        }
  
        return $user[0];
  
      }

    public function process($id) {
        $notification = Notification::find($id);
        $this->authorize('process', $notification);
        $notification->was_read = true;
        $notification->save();
        switch ($notification->type) {
            case self::FOLLOW:
                $user = $this->queryUser($notification->user_id);
                return redirect('users/'.$user->username);
            case self::VOTE:
            case self::COMMENT:
            case self::PUBLISH:
                return redirect('news/'.$notification->news_id);
            default:
                return redirect('error/404');
        }
    }
}
