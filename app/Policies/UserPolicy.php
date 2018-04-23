<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    public function update(User $me, User $user)
    {
        return $me->id === $user->id;
    }
}
