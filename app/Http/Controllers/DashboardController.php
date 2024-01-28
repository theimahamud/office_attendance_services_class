<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::all();
        $department = Department::all();
        $designation = Designation::all();

        return view('dashboard', compact('user', 'department', 'designation'));
    }
}
