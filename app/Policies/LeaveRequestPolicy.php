<?php

namespace App\Policies;

use App\Constants\LeaveStatus;
use App\Constants\Role;
use App\Models\LeaveRequest;
use App\Models\User;

class LeaveRequestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->role === Role::ADMIN;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function viewMy(User $user)
    {
        return $user->role === Role::USER;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role === Role::ADMIN || $user->role === Role::USER;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, leaveRequest $leaveRequest): bool
    {
        return $user->role === Role::ADMIN || ($user->role === Role::USER && $user->id === $leaveRequest->user_id && $leaveRequest->status === LeaveStatus::PENDING);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, leaveRequest $leaveRequest): bool
    {
        return $user->role === Role::ADMIN;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, leaveRequest $leaveRequest): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, leaveRequest $leaveRequest): bool
    {
        //
    }
}
