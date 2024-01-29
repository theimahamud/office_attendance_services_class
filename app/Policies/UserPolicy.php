<?php

namespace App\Policies;

use App\Constants\Role;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $loggedInUser, User $user)
    {
        return $loggedInUser->role === Role::ADMIN || $user->id == $loggedInUser->id;
    }

    public function view(User $user)
    {
        return $user->role === Role::ADMIN;
    }

    public function create(User $user)
    {
        return $user->role === Role::ADMIN;
    }

    public function update(User $loggedInUser, User $user)
    {
        return $loggedInUser->role === Role::ADMIN || $user->id == $loggedInUser->id;
    }

    public function delete(User $user)
    {
        return $user->role === Role::ADMIN;
    }
}
