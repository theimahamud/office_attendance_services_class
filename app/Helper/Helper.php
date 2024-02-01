<?php


namespace App\Helper;


use App\Constants\LeaveStatus;
use App\Models\LeaveRequest;

class Helper
{

    public static function leaveSpent($leave_policy_id,$start_date,$end_date)
    {
        $leave_request = LeaveRequest::where('status',LeaveStatus::APPROVED)
            ->where('user_id',auth()->user()->id)
            ->where('leave_policy_id',$leave_policy_id)
            ->where('start_date', '>=' ,$start_date)
            ->where('end_date','<=',$end_date)->get();

        $days = 0;

        foreach ($leave_request as $leave){
            $days += $leave->days;
        }

        return $days;

    }

    public static function availableDays($maximum_in_year,$leave_spent)
    {
        return $maximum_in_year - $leave_spent;
    }


}
