<?php

namespace App\Http\Controllers;

use App\Constants\Gender;
use App\Models\User;

class ReportController extends Controller
{
    public function officeReport()
    {
        $male = User::where('gender', Gender::MALE)->count();
        $female = User::where('gender', Gender::FEMALE)->count();
        $other = User::where('gender', Gender::OTHER)->count();

        $data = [
            'labels' => Gender::gender,
            'data' => [$male, $female, $other],
            'colors' => ['#3366cc', '#ff9900', '#109618'],
        ];

        return view('reports.office-report', compact('data'));
    }

    public function attendanceReport()
    {

    }
}
