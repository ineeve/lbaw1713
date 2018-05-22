<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function admin(User $user) {
        return $user->permission === 'admin';
      }

    public function update(User $user, User $user1)
    {
        return $user->id === $user1->id;
    }
}
