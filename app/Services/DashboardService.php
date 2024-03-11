<?php


namespace App\Services;


use App\Constants\AttendanceStatus;
use App\Models\Attendance;

class DashboardService
{

    public function OnTimeAttendance($check_in_time,$current_month,$current_year){
        return  Attendance::where('status', AttendanceStatus::PRESENT)
            ->where('check_in', '<=', $check_in_time)
            ->whereRaw("MONTH(STR_TO_DATE(check_in_out_date, '%m/%d/%Y')) = ?", [$current_month])
            ->whereRaw("YEAR(STR_TO_DATE(check_in_out_date, '%m/%d/%Y')) = ?", [$current_year])
            ->count();
    }

    public function absentAttendance($current_month,$current_year)
    {
        return Attendance::where('status', AttendanceStatus::ABSENT)
            ->whereRaw("MONTH(STR_TO_DATE(check_in_out_date, '%m/%d/%Y')) = ?", [$current_month])
            ->whereRaw("YEAR(STR_TO_DATE(check_in_out_date, '%m/%d/%Y')) = ?", [$current_year])
            ->count();
    }

    public function lateAttendance($check_in_time,$current_month,$current_year)
    {
        return Attendance::where('status', AttendanceStatus::PRESENT)
            ->where('check_in', '>', $check_in_time)
            ->whereRaw("MONTH(STR_TO_DATE(check_in_out_date, '%m/%d/%Y')) = ?", [$current_month])
            ->whereRaw("YEAR(STR_TO_DATE(check_in_out_date, '%m/%d/%Y')) = ?", [$current_year])
            ->count();
    }

    public function totalAttendance($current_month,$current_year)
    {
        return Attendance::whereRaw("MONTH(STR_TO_DATE(check_in_out_date, '%m/%d/%Y')) = ?", [$current_month])
            ->whereRaw("YEAR(STR_TO_DATE(check_in_out_date, '%m/%d/%Y')) = ?", [$current_year])
            ->count();
    }

}
