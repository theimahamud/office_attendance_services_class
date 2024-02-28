<?php

namespace App\Http\Controllers;

use App\Constants\AttendanceStatus;
use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use App\Services\AllAttendanceService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function allAttendance()
    {
        $current_date = Carbon::now()->format('m/d/Y');
        $present_attendance = Attendance::with('user')->where('status', AttendanceStatus::PRESENT)->where('check_in_out_date',$current_date)->get();
        $absent_attendance = Attendance::with('user')->where('status', AttendanceStatus::ABSENT)->where('check_in_out_date',$current_date)->get();
        return view('attendance.all-attendance',compact('present_attendance','absent_attendance'));
    }


    public function myAttendance()
    {
        return view('attendance.my-attendance');
    }


    public function allAbsentPresentAttendance(AttendanceRequest $request, AllAttendanceService $allAttendanceService)
    {

       $validated = $request->validated();

       $attendance = $allAttendanceService->store($validated);

       if($request->status == 'Present'){

           return back()->with('success','All user have been present successfully');
       }else{

           return back()->with('success','All user have been absent successfully');
       }

    }

    public function individualAttendance(Request $request)
    {

       foreach ($request->attendance_id as $key => $attend_id){

           $attendance = Attendance::find($attend_id);

           if($attendance){
               $attendance->check_in_out_date = $request->check_in_out_date[$key];
               $attendance->check_in = $request->check_in[$key];
               $attendance->check_out = $request->check_out[$key];
               $attendance->status = $request->status[$key];
               $attendance->save();
           }
       }

        return redirect()->back()->with('success', 'Attendance records updated successfully.');

    }




}
