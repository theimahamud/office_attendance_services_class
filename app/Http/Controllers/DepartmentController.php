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
        $this->authorize('view', Department::class);

        $departments = Department::orderBy('created_at', 'DESC')->get();

        return view('departments.index', compact('departments'));
    }

    public function store(DepartmentStoreUpdateRequest $request, DepartmentService $departmentService)
    {
        $this->authorize('create', Department::class);
        $validated = $request->validated();

        $departmentService->storeDepartment($validated);

        Session::flash('success', 'Department created successfully');

        return redirect()->route('departments.index');
    }

    public function edit(Department $department)
    {
        $this->authorize('view', $department);
        $departments = Department::orderBy('created_at', 'DESC')->paginate(5);

        return view('departments.index', compact('department', 'departments'));
    }

    public function update(DepartmentStoreUpdateRequest $request, Department $department, DepartmentService $departmentService)
    {
        $this->authorize('update', $department);
        $validated = $request->validated();

        $departmentService->updateDepartment($validated, $department);

        Session::flash('success', 'Department updated successfully');

        return redirect()->route('departments.index');
    }

    public function destroy(Department $department, DepartmentService $departmentService)
    {
        $this->authorize('delete', $department);
        $departmentService->destroyDepartment($department);

        return response('Department deleted');
    }
}
