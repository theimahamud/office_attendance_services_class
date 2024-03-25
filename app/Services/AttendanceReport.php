<?php

namespace App\Services;

use App\Models\Attendance;

class AttendanceReport
{
    public static function generateAttendance($request)
    {

        $month = $request->month;

        $year = $request->year;

        $userId = $request->user_id;

        $attendance_report = Attendance::with('user')->where('user_id', $userId)
            ->whereYear('check_in_out_date', $year)
            ->whereMonth('check_in_out_date', $month)
            ->get();

        return $attendance_report;
    }
}
