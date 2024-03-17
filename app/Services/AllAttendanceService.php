<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\Settings;
use App\Models\User;
use Carbon\Carbon;

class AllAttendanceService
{
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
}
