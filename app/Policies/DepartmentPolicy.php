<?php

namespace App\Policies;

use App\Constants\Role;
use App\Models\User;

class DepartmentPolicy
{
    public function view(User $user)
    {
        return $user->role === Role::ADMIN;
    }

    public function create(User $user)
    {
        return $user->role === Role::ADMIN;
    }

    public function update(User $user)
    {
        return $user->role === Role::ADMIN;
    }

    public function delete(User $user)
    {
        return $user->role === Role::ADMIN;
    }
}
