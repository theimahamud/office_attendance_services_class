<?php

namespace App\Services;

use App\Constants\LeaveStatus;
use App\Constants\Role;
use App\Constants\Status;
use App\Models\Leavepolicy;
use App\Models\leaveRequest;
use App\Models\Settings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LeaveRequestService
{
    public function storeLeaveRequest(array $data)
    {
        // Parse dates as Carbon instances
        $startDate = Carbon::parse($data['start_date']);
        $endDate = Carbon::parse($data['end_date']);

        // Calculate number of days for the leave request
        $days = $startDate->diffInDays($endDate) + 1;

        // Format dates to 'Y-m-d' for database storage
        $startDateFormatted = $startDate->format('Y-m-d');
        $endDateFormatted = $endDate->format('Y-m-d');

        // Merge default data with provided data
        $data = array_merge($data, [
            'user_id' => $data['user_id'] ?? Auth::id(),
            'days' => $days,
            'start_date' => $startDateFormatted,
            'end_date' => $endDateFormatted,
        ]);

        if(auth()->user()->role === Role::ADMIN){
            $totalLeaveDays = LeaveRequest::where('user_id',$data['user_id'])
                ->where('leave_policy_id', $data['leave_policy_id'])
                ->where('status', LeaveStatus::APPROVED)
                ->sum('days');

            $leavePolicy = Leavepolicy::where('id',$data['leave_policy_id'])->where('status',Status::ACTIVE)->first();

            if ($totalLeaveDays >= $leavePolicy->maximum_in_year) {

              return "vacation_is_over";

            }else{
                $leaveRequest = LeaveRequest::create($data);
            }
        }else{
            $leaveRequest = LeaveRequest::create($data);
        }

        return $leaveRequest;
    }

    public function updateLeaveRequest(array $data, LeaveRequest $leaveRequest)
    {
        // Parse dates as Carbon instances
        $startDate = Carbon::parse($data['start_date']);
        $endDate = Carbon::parse($data['end_date']);

        // Calculate number of days for the leave request
        $days = $startDate->diffInDays($endDate) + 1;

        // Format dates to 'Y-m-d' for database storage
        $startDateFormatted = $startDate->format('Y-m-d');
        $endDateFormatted = $endDate->format('Y-m-d');

        if($data['status'] === LeaveStatus::APPROVED){

            $comment = $data['comment'] ?? Settings::get('leave_request_approved_comment');

        }elseif($data['status'] === LeaveStatus::REJECTED){

            $comment = $data['comment'] ?? Settings::get('leave_request_rejected_comment');

        }

        // Merge default data with provided data
        $data = array_merge($data, [
            'user_id' => $data['user_id'] ?? Auth::id(),
            'days' => $days,
            'start_date' => $startDateFormatted,
            'end_date' => $endDateFormatted,
            'comment' => $comment,
        ]);

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

    //    public function getEmailData($data)
    //    {
    //        $user = User::where('id',$data->user_id)->first();
    //        $leave_policy = Leavepolicy::where('id',$data->leave_policy_id)->first();
    //        $referred_user = User::where('id',$data->referred_by)->first();
    //        $data = [
    //            'id' => $data->id,
    //            'name' => $user->name,
    //            'leave_policy_name' => $leave_policy->title,
    //            'leave_reason' => $data->leave_reason,
    //            'start_date' => $data->start_date,
    //            'end_date' => $data->end_date,
    //            'days' => $data->days,
    //            'referred_by' => $referred_user->name,
    //            'view_request_link' => route('leave-request.edit',$data->id)
    //        ];
    //        return $data;
    //    }
}
