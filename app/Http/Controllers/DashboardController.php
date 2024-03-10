<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::all();
        $department = Department::all();
        $designation = Designation::all();

        $data = ['labels' => ['On Time','Absent','Late'],
                 'data' => [25, 30, 15],
                ];

        return view('dashboard', compact('user', 'department', 'designation','data'));
    }

    public function seeAllNotification()
    {

        $notifications = Auth::user()->notifications()->get();
        //        dd($notifications);
        auth()->user()->unreadNotifications()->update(['read_at' => now()]);

        return view('notifications.index', ['notifications' => $notifications]);
    }
}
