<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesignationStoreUpdateRequest;
use App\Models\Designation;
use App\Services\DesignationService;
use Illuminate\Support\Facades\Session;

class DesignationController extends Controller
{
    public function index()
    {
        $this->authorize('view', Designation::class);

        $designations = Designation::orderBy('created_at', 'DESC')->paginate(5);

        return view('designations.index', compact('designations'));
    }

    public function store(DesignationStoreUpdateRequest $request, DesignationService $designationService)
    {
        $this->authorize('create', Designation::class);
        $validated = $request->validated();

        $designationService->storeDesignation($validated);

        Session::flash('success', 'Designation created successfully');

        return redirect()->route('designations.index');
    }

    public function edit(Designation $designation)
    {
        $this->authorize('view', $designation);
        $designations = Designation::orderBy('created_at', 'DESC')->paginate(5);

        return view('designations.index', compact('designation', 'designations'));
    }

    public function update(DesignationStoreUpdateRequest $request, Designation $designation, DesignationService $designationService)
    {
        $this->authorize('update', $designation);
        $validated = $request->validated();

        $designationService->updateDesignation($validated, $designation);

        Session::flash('success', 'Designation updated successfully');

        return redirect()->route('designations.index');
    }

    public function destroy(Designation $designation, DesignationService $designationService)
    {
        $this->authorize('delete', $designation);
        $designationService->destroyDesignation($designation);

        return response('Designation deleted');
    }
}
