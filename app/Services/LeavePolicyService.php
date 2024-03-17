<?php

namespace App\Services;

use App\Models\Leavepolicy;
use Carbon\Carbon;

class LeavePolicyService
{
    public function storeLeavePolicy(array $data)
    {
        $startDate = Carbon::parse($data['start_date'])->format('Y-m-d');
        $endDate = Carbon::parse($data['end_date'])->format('Y-m-d');

        $data = array_merge($data,[
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);

        $leavePolicy = Leavepolicy::create($data);

        return $leavePolicy;
    }

    public function updateLeavePolicy(array $data, Leavepolicy $leavepolicy)
    {
        $startDate = Carbon::parse($data['start_date'])->format('Y-m-d');
        $endDate = Carbon::parse($data['end_date'])->format('Y-m-d');

        $data = array_merge($data,[
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);

        $leavePolicy = $leavepolicy->update($data);

        return $leavePolicy;
    }

    public function destroyLeavePolicy(Leavepolicy $leavepolicy)
    {
        $leavepolicy->delete();
    }
}
