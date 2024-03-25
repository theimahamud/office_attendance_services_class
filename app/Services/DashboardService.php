<?php

namespace App\Services;

use App\Constants\AttendanceStatus;
use App\Constants\LeaveStatus;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardService
{
    public function OnTimeAttendance($check_in_time, $current_month, $current_year)
    {
        return Attendance::where('user_id', Auth::id())
            ->where('status', AttendanceStatus::PRESENT)
            ->where('check_in', '<=', $check_in_time)
            ->whereMonth('check_in_out_date', $current_month)
            ->whereYear('check_in_out_date', $current_year)
            ->count();
    }

    public function absentAttendance($current_month, $current_year)
    {
        return Attendance::where('user_id', Auth::id())
            ->where('status', AttendanceStatus::ABSENT)
            ->whereMonth('check_in_out_date', $current_month)
            ->whereYear('check_in_out_date', $current_year)
            ->count();
    }

    public function lateAttendance($check_in_time, $current_month, $current_year)
    {
        return Attendance::where('user_id', Auth::id())
            ->where('status', AttendanceStatus::PRESENT)
            ->where('check_in', '>', $check_in_time)
            ->whereMonth('check_in_out_date', $current_month)
            ->whereYear('check_in_out_date', $current_year)
            ->count();
    }

    public function holidayAttendance($current_month, $current_year)
    {
        return Attendance::where('user_id', Auth::id())
            ->where('status', AttendanceStatus::HOLIDAY)
            ->whereMonth('check_in_out_date', $current_month)
            ->whereYear('check_in_out_date', $current_year)
            ->count();
    }

    public function leaveAttendance($current_month, $current_year)
    {
        return Attendance::where('user_id', Auth::id())
            ->where('status', AttendanceStatus::LEAVE)
            ->whereMonth('check_in_out_date', $current_month)
            ->whereYear('check_in_out_date', $current_year)
            ->count();
    }

    public function weekendAttendance($current_month, $current_year)
    {
        return Attendance::where('user_id', Auth::id())
            ->where('status', AttendanceStatus::WEEKEND)
            ->whereMonth('check_in_out_date', $current_month)
            ->whereYear('check_in_out_date', $current_year)
            ->count();
    }

    public function totalAttendance($current_month, $current_year)
    {
        return Attendance::where('user_id', Auth::id())
            ->whereMonth('check_in_out_date', $current_month)
            ->whereYear('check_in_out_date', $current_year)
            ->count();
    }

    public function todayAttendance($current_date)
    {
        return Attendance::where('status', AttendanceStatus::PRESENT)
            ->where('user_id', Auth::id())
            ->whereDate('check_in_out_date', $current_date)
            ->first();
    }

    public function leaveAnnouncement($current_date)
    {
        return LeaveRequest::with('user')->where('start_date', '<=', $current_date)
            ->where('end_date', '>=', $current_date)
            ->where('status', LeaveStatus::APPROVED)
            ->get();
    }

    public function birthdayAnnouncement($current_day, $current_month)
    {
        return User::whereMonth('birth_date', $current_month)
            ->whereDay('birth_date', $current_day)
            ->get();
    }

    public function joiningAnnouncement($current_day, $current_month)
    {
        return User::whereMonth('hire_date', $current_month)
            ->whereDay('birth_date', $current_day)
            ->get();
    }
}
