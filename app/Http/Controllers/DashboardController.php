<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Holiday;
use App\Models\Settings;
use App\Models\User;
use App\Services\DashboardService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //dashboard view
    public function index(DashboardService $dashboardService)
    {
        $events = [];
        $current_day = Carbon::now()->day;
        $current_month = Carbon::now()->month;
        $current_year = Carbon::now()->year;
        $current_date = Carbon::now()->format('Y-m-d');
        $check_in_time = Settings::get('check_in') ?? '09:00';

        $user = User::all();
        $department = Department::all();
        $designation = Designation::all();

        $on_time = $dashboardService->OnTimeAttendance($check_in_time, $current_month, $current_year);

        $absent = $dashboardService->absentAttendance($current_month, $current_year);

        $late = $dashboardService->lateAttendance($check_in_time, $current_month, $current_year);

        $holiday_percent = $dashboardService->holidayAttendance($current_month, $current_year);

        $leave_percent = $dashboardService->leaveAttendance($current_month, $current_year);

        $weekend_percent = $dashboardService->weekendAttendance($current_month, $current_year);

        $total_attendance = $dashboardService->totalAttendance($current_month, $current_year);

        $today_attendance = $dashboardService->todayAttendance($current_date);

        $leave_announcement = $dashboardService->leaveAnnouncement($current_date);

        $birthday_announcement = $dashboardService->birthdayAnnouncement($current_day, $current_month);

        $joining_announcement = $dashboardService->joiningAnnouncement($current_day, $current_month);

        $on_time_percentage = $total_attendance == 0 ? 0 : round(($on_time / $total_attendance) * 100);
        $absent_percentage = $total_attendance == 0 ? 0 : round(($absent / $total_attendance) * 100);
        $late_percentage = $total_attendance == 0 ? 0 : round(($late / $total_attendance) * 100);
        $holiday_percentage = $total_attendance == 0 ? 0 : round(($holiday_percent / $total_attendance) * 100);
        $leave_percentage = $total_attendance == 0 ? 0 : round(($leave_percent / $total_attendance) * 100);
        $weekend_percentage = $total_attendance == 0 ? 0 : round(($weekend_percent / $total_attendance) * 100);

        $chartData = [
            'labels' => ["On Time ({$on_time_percentage}%)", "Absent ({$absent_percentage}%)", "Late ({$late_percentage}%)", "Holiday ({$holiday_percentage}%)", "Leave ({$leave_percentage}%)", "Weekend ({$weekend_percentage}%)"],
            'data' => [$on_time_percentage, $absent_percentage, $late_percentage, $holiday_percentage, $leave_percentage, $weekend_percentage],
        ];

        $holidays = Holiday::all();

        foreach ($holidays as $holiday) {
            $events[] = ['title' => $holiday->title, 'start' => $holiday->start_date, 'end' => Carbon::parse($holiday->end_date)->addDay(1)];
        }

        return view('dashboard',
            compact(
                'user',
                'department',
                'designation',
                'chartData',
                'on_time',
                'absent',
                'late',
                'holiday_percent',
                'leave_percent',
                'weekend_percent',
                'events',
                'today_attendance',
                'leave_announcement',
                'birthday_announcement',
                'joining_announcement'
            ));
    }

    //see all notifications
    public function seeAllNotification()
    {
        $notifications = Auth::user()->notifications()->get();
        auth()->user()->unreadNotifications()->update(['read_at' => now()]);

        return view('notifications.index', ['notifications' => $notifications]);
    }
}
