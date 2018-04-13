<?php

namespace App\Policies;

use App\Notification;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotificationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the notification.
     *
     * @param  \  $user
     * @param  \App\Notification  $notification
     * @return bool
     */
    public function view( $user, Notification $notification)
    {
        return $user->id === $notification->target_user_id;
    }
}
