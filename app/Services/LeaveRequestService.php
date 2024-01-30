<?php

namespace App\Services;

use App\Models\leaveRequest;
use Illuminate\Support\Facades\Auth;

class LeaveRequestService
{
    public function storeLeaveRequest(array $data)
    {

        $data['user_id'] = isset($data['user_id']) ? $data['user_id'] : Auth::user()->id;

        $leaveRequest = leaveRequest::create($data);

        return $leaveRequest;

    }

    public function updateLeaveRequest(array $data, leaveRequest $leaveRequest)
    {

        $leaveRequest = $leaveRequest->update($data);

        return $leaveRequest;
    }

    public function destroyLeaveRequest(leaveRequest $leaveRequest)
    {
            $leaveRequest->update([
                'deleted_at'=>now(),
                'deleted_by'=> Auth::user()->id
            ]);
    }
}
