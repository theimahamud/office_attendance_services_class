<?php

namespace App\Services;

use App\Models\Leavepolicy;

class LeavePolicyService
{
    public function storeLeavePolicy(array $data)
    {
        $leavePolicy = Leavepolicy::create($data);

        return $leavePolicy;
    }

    public function updateLeavePolicy(array $data, Leavepolicy $leavepolicy)
    {
        $leavePolicy = $leavepolicy->update($data);

        return $leavePolicy;
    }

    public function destroyLeavePolicy(Leavepolicy $leavepolicy)
    {
        $leavepolicy->delete();
    }
}
