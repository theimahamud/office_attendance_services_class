<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentStoreUpdateRequest;
use App\Models\Department;
use App\Services\DepartmentService;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::orderBy('created_at', 'DESC')->paginate(5);
        return view('departments.index',compact('departments'));
    }


    public function store(DepartmentStoreUpdateRequest $request,DepartmentService $departmentService)
    {
        $validated = $request->validated();

        $departmentService->storeDepartment($validated);

        Session::flash('success', 'Department created successfully');
        return redirect()->route('departments.index');
    }

    public function update(DepartmentStoreUpdateRequest $request, Department $department ,DepartmentService $departmentService)
    {
        $validated = $request->validated();

        $departmentService->updateDepartment($validated, $department);

        Session::flash('success', 'Department created successfully');
        return redirect()->route('departments.index');
    }


    public function edit(Department $department)
    {
        $departments = Department::orderBy('created_at', 'DESC')->paginate(5);
        return view('departments.index',compact('department','departments'));
    }


    public function destroy(Department $department,DepartmentService $departmentService)
    {
        $departmentService->destroyDepartment($department);

        return response('Department deleted');
    }
}
