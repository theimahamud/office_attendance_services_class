<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index');
    }

    public function store(Request $request)
    {
        Settings::set('title',$request->get('title'));
        Settings::set('company_email',$request->get('company_email'));
        Settings::set('check_in',$request->get('check_in'));
        Settings::set('check_out',$request->get('check_out'));
        Settings::set('grace_time',$request->get('grace_time'));
        Settings::set('ip_address',serialize($request->get('ip_address')));
        Settings::set('working_days',serialize($request->get('working_days')));
        return redirect()->route('settings.index')->with('success','Settings has been updated successfully');
    }
}
