<?php

namespace App\Services;

use App\Models\Attendance;
use App\Models\User;

class AllAttendanceService
{
    public function store(array $data)
    {
        $user_ids = User::pluck('id');

        foreach ($user_ids as $user_id) {
            $attendanceData = array_merge($data, [
                'user_id' => $user_id,
                'check_in' => '09:00',
                'check_out' => '18:00',
            ]);

            $attendanceExists = Attendance::where('check_in_out_date', $data['check_in_out_date'])
                ->where('user_id', $user_id)
                ->exists();

            if ($attendanceExists) {

                Attendance::where('check_in_out_date', $data['check_in_out_date'])
                    ->where('user_id', $user_id)
                    ->update($attendanceData);
            } else {

                Attendance::create($attendanceData);
            }
        }
    }
}
