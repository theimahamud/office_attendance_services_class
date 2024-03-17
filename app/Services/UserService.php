<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{
    public function getUser()
    {

    }

    public function storeUser(array $data, $image = null)
    {

        $data['password'] = Hash::make($data['password']);
        $data['birth_date'] = Carbon::parse($data['birth_date'])->format('Y-m-d');
        $data['hire_date'] = Carbon::parse($data['hire_date'])->format('Y-m-d');
        $data['uuid'] = Str::uuid();
        $user = User::create($data);

        if ($image) {
            $user->addMedia($image)->toMediaCollection();
        }

        return $user;
    }

    public function updateUser(array $data, User $user, $image = null)
    {
        if (isset($data['password']) && $data['password'] !== null) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $data['birth_date'] = Carbon::parse($data['birth_date'])->format('Y-m-d');
        $data['hire_date'] = Carbon::parse($data['hire_date'])->format('Y-m-d');

        $user = tap($user)->update($data);

        if ($image) {
            $user->clearMediaCollection();
            $user->addMedia($image)
                ->toMediaCollection();
        }

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
