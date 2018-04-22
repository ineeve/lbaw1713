<?php

namespace App\Policies;

use App\User;

use App\Notification;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotificationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can process the notification.
     *
     * @param  \  $user
     * @param  \App\Notification  $notification
     * @return bool
     */
    public function process(User $user, Notification $notification)
    {
        return $user->id === $notification->target_user_id;
    }
}
