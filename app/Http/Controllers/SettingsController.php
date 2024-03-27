<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $logo = Settings::where('key', 'logo')->first();
        $logoUrl = $logo ? $logo->getFirstMediaUrl('company_logo') : null;

        return view('settings.index', compact('logoUrl'));
    }

    public function store(Request $request)
    {

        Settings::set('title', $request->get('title'));
        Settings::set('company_email', $request->get('company_email'));
        Settings::set('check_in', $request->get('check_in'));
        Settings::set('check_out', $request->get('check_out'));
        Settings::set('grace_time', $request->get('grace_time'));
        Settings::set('ip_address', serialize($request->get('ip_address')));
        Settings::set('working_days', serialize($request->get('working_days')));
        Settings::set('leave_request_approved_comment', $request->get('leave_request_approved_comment'));
        Settings::set('leave_request_rejected_comment', $request->get('leave_request_rejected_comment'));

        // Save logo using Spatie Media Library
        if ($request->hasFile('logo')) {
            $logo = Settings::set('logo', $request->get('logo')); // Save the path to the logo in the settings
            $logo->clearMediaCollection('company_logo');
            $logo->addMedia($request->file('logo'))->toMediaCollection('company_logo'); // Add the logo to media collection
        }

        return redirect()->route('settings.index')->with('success', 'Settings has been updated successfully');
    }
}
