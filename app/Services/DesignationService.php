<?php

namespace App\Services;

use App\Models\Designation;

class DesignationService
{
    public function storeDesignation(array $data)
    {
        Designation::create($data);
    }

    public function updateDesignation(array $data, Designation $designation)
    {
        $designation->update($data);
    }

    public function destroyDesignation(Designation $designation)
    {
        $designation->delete();
    }
}
