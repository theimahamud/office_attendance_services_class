<?php

namespace App\Services;

use App\Models\leaveRequest;
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
                'deleted_at'=>now(),
                'deleted_by'=> Auth::user()->id
            ]);
    }
}
