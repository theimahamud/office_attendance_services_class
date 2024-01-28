<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{
    public function getUser()
    {

    }

    public function storeUser(array $data)
    {

        $data['password'] = Hash::make($data['password']);
        $data['birth_date'] = $data['birth_date'];
        $data['hire_date'] = $data['hire_date'];
        $data['uuid'] = Str::uuid();
        $user = User::create($data);

        return $user;
    }

    public function updateUser(array $data, User $user)
    {
        if (isset($data['password']) && $data['password'] !== null) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user = $user->update($data);

        return $user;
    }

    public function destroyUser(User $user)
    {
        $user->update([
            'deleted_by' => auth()->user()->id,
            'deleted_at' => now(),
        ]);

    }
}
