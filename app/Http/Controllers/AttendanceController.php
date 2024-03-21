<?php

namespace App\Http\Controllers;

use App\Constants\AttendanceStatus;
use App\Constants\Role;
use App\Http\Requests\AttendanceRequest;
use App\Models\Attendance;
use App\Models\Settings;
use App\Models\User;
use App\Services\AttendanceReport;
use App\Services\AttendanceService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function allAttendance()
    {
        $current_date = Carbon::now()->format('Y-m-d');
        $present_attendance = Attendance::with('user')->where('status', AttendanceStatus::PRESENT)->where('check_in_out_date', $current_date)->get();
        $absent_attendance = Attendance::with('user')->where('status', AttendanceStatus::ABSENT)->where('check_in_out_date', $current_date)->get();

        return view('attendance.all-attendance', compact('present_attendance', 'absent_attendance'));
    }

    public function myAttendance()
    {
        return view('attendance.my-attendance');
    }

    public function allAbsentPresentAttendance(AttendanceRequest $request, AttendanceService $attendanceService)
    {

        $validated = $request->validated();

        $attendance = $attendanceService->store($validated);

        if ($request->status === 'Present') {

            return back()->with('success', 'All user have been present successfully');
        } else {

            return back()->with('success', 'All user have been absent successfully');
        }

    }

    public function individualAttendance(Request $request)
    {

        foreach ($request->attendance_id as $key => $attend_id) {

            $attendance = Attendance::find($attend_id);

            if ($attendance) {
                $attendance->check_in_out_date = $request->check_in_out_date[$key];
                $attendance->check_in = $request->check_in[$key];
                $attendance->check_out = $request->check_out[$key];
                $attendance->status = $request->status[$key];
                $attendance->save();
            }
        }

        return redirect()->back()->with('success', 'Attendance records updated successfully.');

    }

    public function checkInAttendanceStore(Request $request, AttendanceService $attendanceService)
    {
        $response = $attendanceService->checkInAttendance();

        return redirect()->back()->with($response['success'] ? 'success' : 'error', $response['message']);
    }

    public function checkOutAttendanceUpdate(Request $request, AttendanceService $attendanceService)
    {
        $response = $attendanceService->checkOutAttendance();

        return redirect()->back()->with($response['success'] ? 'success' : 'error', $response['message']);
    }


    public function attendanceSummary(Request $request)
    {

        $totalWorkingDays = $totalWorkTime = $totalPresent = $totalAbsent = $totalHoliday = $totalLeave = $totalWeekend = $totalEarlyLeft = $totalLate = $totalInTime = 0;
        $checkInArray = $checkOutArray = $checkInOutCount = [];

        $check_in = Settings::get('check_in') ??  '00:00';
        $check_out = Settings::get('check_out') ??  '00:00';
        $company_name = Settings::get('title') ?? 'Uibarn Ltd';

        $user_id = $request->query('user_id');
        $year = $request->query('year');

        $monthName = $request->query('month');


        $users = auth()->user()->role === Role::ADMIN ? User::all() : auth()->user();

        $years = Attendance::selectRaw('YEAR(check_in_out_date) as year')->distinct()->pluck('year');

        $attendance_summary = $user_id && $year && $monthName ? AttendanceReport::generateAttendance($request) :
            Attendance::with('user')->where('user_id', auth()->user()->id)
                ->whereYear('check_in_out_date', Carbon::now()->format('Y'))
                ->whereMonth('check_in_out_date', Carbon::now()->format('m'))
                ->get();


        foreach ($attendance_summary as $attendance) {
            $totalWorkingDays++;

            if (!empty($attendance->check_in) && !empty($attendance->check_out)) {
                $checkIn = Carbon::parse($attendance->check_in);
                $checkOut = Carbon::parse($attendance->check_out);

                $workDuration = $checkOut->diff($checkIn);

                $totalWorkTime += $workDuration->format('%H') * 3600 + $workDuration->format('%I') * 60;

                $checkInArray[] = $attendance->check_in;
                $checkOutArray[] = $attendance->check_out;
                $checkInOutCount[] = $workDuration;
            }

            if (!empty($attendance->check_in)) {
                $checkInTime = Carbon::parse($attendance->check_in);
                if ($checkInTime->greaterThanOrEqualTo(Carbon::parse($check_in))) {
                    $totalLate++;
                } else {
                    $totalInTime++;
                }
            }

            if ($attendance->status === AttendanceStatus::PRESENT) {
                $totalPresent++;
                if (!empty($attendance->check_out) && Carbon::parse($attendance->check_out)->lt(Carbon::parse($check_out))) {
                    $totalEarlyLeft++;
                }
            }

            if ($attendance->status === AttendanceStatus::ABSENT) {
                $totalAbsent++;
            }

            if ($attendance->status === AttendanceStatus::HOLIDAY) {
                $totalHoliday++;
            }

            if ($attendance->status === AttendanceStatus::LEAVE) {
                $totalLeave++;
            }

            if ($attendance->status === AttendanceStatus::WEEKEND) {
                $totalWeekend++;
            }
        }


        $averageCheckInTime = filled($checkOutArray) ? date('h:i A', array_sum(array_map('strtotime', $checkInArray)) / count($checkInArray)) : $check_in;
        $averageCheckOutTime = filled($checkOutArray) ? date('h:i A', array_sum(array_map('strtotime', $checkOutArray)) / count($checkOutArray)) : $check_out;

        return view('attendance.attendance-summary', compact(
            'users',
            'years',
            'attendance_summary',
            'monthName',
            'year',
            'company_name',
            'totalWorkingDays',
            'totalWorkTime',
            'totalPresent',
            'totalAbsent',
            'totalHoliday',
            'totalLeave',
            'totalWeekend',
            'totalEarlyLeft',
            'averageCheckInTime',
            'averageCheckOutTime',
            'totalInTime',
            'totalLate'
        ));
    }


    public function attendanceUpdateDateWise($id)
    {
        $attendance = Attendance::with('user')->find($id);

        return view('attendance.attendance-update-date-wise',compact('attendance'));
    }

    public function attendanceUpdateByDate(Request $request, $id)
    {
        // Find the Attendance record by ID
        $attendance = Attendance::findOrFail($id);

        // Update the attendance record with the new data
        $attendance->check_in_out_date = $request->check_in_out_date;
        $attendance->check_in = $request->check_in;
        $attendance->check_out = $request->check_out;
        $attendance->status = $request->status;
        $attendance->save();

        // Redirect back to the attendance summary page with a success message
        return redirect()->route('attendance-summary')->with('success', 'Attendance updated successfully!');
    }

    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
        return response('Attendance deleted');
    }


}
