<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Reporteditem;
class ReporteditemPolicy
{
    use HandlesAuthorization;

    public function show(User $user)
    {
        return $user->permission == 'admin' || $user->permission == 'moderator';
    }
}
