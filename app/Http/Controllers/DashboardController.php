<?php

namespace App\Http\Controllers;

use App\Constants\AttendanceStatus;
use App\Models\Attendance;
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


    public function index(DashboardService $dashboardService)
    {
        $events = [];
        $current_month = Carbon::now()->month;
        $current_year = Carbon::now()->year;
        $check_in_time = Settings::get('check_in');

        $user = User::all();
        $department = Department::all();
        $designation = Designation::all();

        $on_time = $dashboardService->OnTimeAttendance($check_in_time,$current_month,$current_year);

        $absent = $dashboardService->absentAttendance($current_month,$current_year);

        $late = $dashboardService->lateAttendance($check_in_time,$current_month,$current_year);

        $total_attendance = $dashboardService->totalAttendance($current_month,$current_year);

        $today_attendance =$dashboardService->todayAttendance();

        $on_time_percentage = ($on_time / $total_attendance) * 100;
        $absent_percentage = ($absent / $total_attendance) * 100;
        $late_percentage = ($late / $total_attendance) * 100;

        $chartData = [
            'labels' => ["On Time({$on_time_percentage}%)", "Absent({$absent_percentage}%)", "Late({$late_percentage}%)"],
            'data' => [$on_time_percentage, $absent_percentage, $late_percentage]
        ];


        $holidays = Holiday::all();

        foreach ($holidays as $holiday){
            $events[]=['title'=>$holiday->title,'start'=>$holiday->start_date,'end'=>Carbon::parse($holiday->end_date)->addDay(1)];
        }


        return view('dashboard', compact('user', 'department', 'designation','chartData','on_time','absent','late','events','today_attendance'));
    }

    public function seeAllNotification()
    {
        $notifications = Auth::user()->notifications()->get();
        auth()->user()->unreadNotifications()->update(['read_at' => now()]);

        return view('notifications.index', ['notifications' => $notifications]);
    }

}
