<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function allAttendance()
    {
       return view('attendance.all-attendance');
    }


    public function myAttendance()
    {
        return view('attendance.my-attendance');
    }
}
