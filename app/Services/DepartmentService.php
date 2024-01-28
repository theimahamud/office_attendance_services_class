<?php

namespace App\Services;

use App\Models\Department;

class DepartmentService
{
    public function storeDepartment(array $data)
    {
        Department::create($data);
    }

    public function updateDepartment(array $data, Department $department)
    {
        $department->update($data);
    }

    public function destroyDepartment(Department $department)
    {
        $department->delete();
    }
}
