<?php

namespace App\Services;

use App\Constants\AttendanceStatus;
use App\Models\Attendance;
use App\Models\Settings;
use App\Models\User;
use Carbon\Carbon;

class AttendanceService
{
    public DashboardService $dashboard;

    public function __construct()
    {
        $this->dashboard = new DashboardService();
    }

    public function store(array $data)
    {
        $userIds = User::pluck('id')->toArray();

        // Format the date outside the loop
        $checkInOutDate = Carbon::parse($data['check_in_out_date'])->format('Y-m-d');

        $checkIn = Settings::get('check_in') ?? '09:00';
        $checkOut = Settings::get('check_out') ?? '18:00';

        // Check existing attendances for all users
        $existingAttendances = Attendance::whereIn('user_id', $userIds)
            ->where('check_in_out_date', $checkInOutDate)
            ->get()
            ->keyBy('user_id');

        foreach ($userIds as $userId) {
            $attendanceData = [
                'user_id' => $userId,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'check_in_out_date' => $checkInOutDate,
                'status' => $data['status'],
            ];

            // Check if attendance exists for the user
            if (isset($existingAttendances[$userId])) {

                $existingAttendances[$userId]->update($attendanceData);
            } else {
                Attendance::create($attendanceData);
            }
        }
    }

    public function checkInAttendance()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $todayAttendance = $this->dashboard->todayAttendance($currentDate);

        if ($todayAttendance) {
            return ['success' => false, 'message' => 'You have already checked in!'];
        } else {

            $attendance = Attendance::where('user_id', auth()->user()->id)
                ->where('check_in_out_date', $currentDate)
                ->first();

            if ($attendance) {
                // Attendance record exists, update it
                $attendance->check_in = Carbon::now()->format('H:i');
                $attendance->status = AttendanceStatus::PRESENT;
                $attendance->save();
            } else {
                // Attendance record does not exist, create a new one
                $attendance = new Attendance();
                $attendance->user_id = auth()->user()->id;
                $attendance->check_in = Carbon::now()->format('H:i');
                $attendance->status = AttendanceStatus::PRESENT;
                $attendance->check_in_out_date = $currentDate;
                $attendance->save();
            }

            return ['success' => true, 'message' => 'Your attendance has been taken successfully.'];
        }
    }

    public function checkOutAttendance()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $todayAttendance = $this->dashboard->todayAttendance($currentDate);

        if ($todayAttendance) {
            if ($todayAttendance->check_out) {
                return ['success' => false, 'message' => 'You have already checked out.'];
            } else {
                $todayAttendance->check_out = Carbon::now()->format('H:i');
                $todayAttendance->save();

                return ['success' => true, 'message' => 'You have checked out successfully.'];
            }
        }

        return ['success' => false, 'message' => 'Attendance record not found.'];
    }
}
