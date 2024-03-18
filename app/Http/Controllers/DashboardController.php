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
        $check_in_time = Settings::get('check_in');

        $user = User::all();
        $department = Department::all();
        $designation = Designation::all();

        $on_time = $dashboardService->OnTimeAttendance($check_in_time, $current_month, $current_year);

        $absent = $dashboardService->absentAttendance($current_month, $current_year);

        $late = $dashboardService->lateAttendance($check_in_time, $current_month, $current_year);

        $total_attendance = $dashboardService->totalAttendance($current_month, $current_year);

        $today_attendance = $dashboardService->todayAttendance($current_date);

        $leave_announcement = $dashboardService->leaveAnnouncement($current_date);

        $birthday_announcement = $dashboardService->birthdayAnnouncement($current_day, $current_month);

        $joining_announcement = $dashboardService->joiningAnnouncement($current_day, $current_month);

        //        dd($leave_announcement);

        $on_time_percentage = $total_attendance == 0 ? 0 : round(($on_time / $total_attendance) * 100);
        $absent_percentage = $total_attendance == 0 ? 0 : round(($absent / $total_attendance) * 100);
        $late_percentage = $total_attendance == 0 ? 0 : round(($late / $total_attendance) * 100);

        $chartData = [
            'labels' => ["On Time({$on_time_percentage}%)", "Absent({$absent_percentage}%)", "Late({$late_percentage}%)"],
            'data' => [$on_time_percentage, $absent_percentage, $late_percentage],
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
