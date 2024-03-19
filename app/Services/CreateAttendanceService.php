<?php


namespace App\Services;


use App\Constants\AttendanceStatus;
use App\Constants\LeaveStatus;
use App\Models\Attendance;
use App\Models\Holiday;
use App\Models\LeaveRequest;
use App\Models\Settings;
use App\Models\User;
use Carbon\Carbon;

class CreateAttendanceService
{
    public function createAttendance()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $users = User::all();

        foreach ($users as $user){

            $working_day = Settings::get('working_days');
            $working_day = unserialize($working_day);

            $isWorkingDay = in_array(Carbon::now()->dayOfWeek, $working_day);


            $existingAttendance = Attendance::where('user_id', $user->id)
                ->where('check_in_out_date', $currentDate)
                ->first();

            if (!$existingAttendance) {
                $leaveRequest = LeaveRequest::where('user_id', $user->id)
                    ->whereDate('start_date', '<=', $currentDate)
                    ->whereDate('end_date', '>=', $currentDate)
                    ->where('status', LeaveStatus::APPROVED)
                    ->first();

                $holiday = Holiday::whereDate('start_date', '<=', $currentDate)
                    ->whereDate('end_date', '>=', $currentDate)
                    ->first();


                $attendance = new Attendance();
                $attendance->user_id = $user->id;
                $attendance->check_in_out_date = Carbon::now()->format('Y-m-d');


                if ($leaveRequest) {

                    $attendance->status = AttendanceStatus::LEAVE;

                } elseif ($holiday) {

                    $attendance->status = AttendanceStatus::HOLIDAY;

                }elseif (!$isWorkingDay) {

                    $attendance->status = AttendanceStatus::WEEKEND;
                }
                else {

                    $attendance->status = AttendanceStatus::ABSENT;

                }

                $attendance->save();
            }
        }
    }

}
