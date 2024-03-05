<?php

namespace App\Services;

use App\Models\Leavepolicy;
use App\Models\leaveRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LeaveRequestService
{
    public function storeLeaveRequest(array $data)
    {
        $startDate = Carbon::parse($data['start_date']);
        $endDate = Carbon::parse($data['end_date']);

        $days = $startDate->diffInDays($endDate);

        $data['user_id'] = isset($data['user_id']) ? $data['user_id'] : Auth::user()->id;

        $data['days'] = $days + 1;

        $leaveRequest = LeaveRequest::create($data);

        return $leaveRequest;

    }

    public function updateLeaveRequest(array $data, LeaveRequest $leaveRequest)
    {
        $startDate = Carbon::parse($data['start_date']);
        $endDate = Carbon::parse($data['end_date']);

        $days = $startDate->diffInDays($endDate);

        $data['days'] = $days + 1;

        $leaveRequest = $leaveRequest->update($data);

        return $leaveRequest;
    }

    public function destroyLeaveRequest(LeaveRequest $leaveRequest)
    {
        $leaveRequest->update([
            'deleted_at' => now(),
            'deleted_by' => Auth::user()->id,
        ]);
    }

    public function getEmailData($data)
    {
        $user = User::where('id',$data->user_id)->first();
        $leave_policy = Leavepolicy::where('id',$data->leave_policy_id)->first();
        $referred_user = User::where('id',$data->referred_by)->first();

        $data = [
            'id' => $data->id,
            'name' => $user->name,
            'leave_policy_name' => $leave_policy->title,
            'leave_reason' => $data->leave_reason,
            'start_date' => $data->start_date,
            'end_date' => $data->end_date,
            'days' => $data->days,
            'referred_by' => $referred_user->name,
            'view_request_link' => route('leave-request.edit',$data->id)
        ];

        return $data;
    }
}
