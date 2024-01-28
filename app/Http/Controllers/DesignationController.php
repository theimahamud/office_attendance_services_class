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
        $designations = Designation::orderBy('created_at', 'DESC')->paginate(5);
        return view('designations.index',compact('designations'));
    }

    public function store(DesignationStoreUpdateRequest $request,DesignationService $designationService)
    {
        $validated = $request->validated();

        $designationService->storeDesignation($validated);

        Session::flash('success', 'Designation created successfully');
        return redirect()->route('designations.index');
    }

    public function update(DesignationStoreUpdateRequest $request, Designation $designation ,DesignationService $designationService)
    {
        $validated = $request->validated();

        $designationService->updateDesignation($validated, $designation);

        Session::flash('success', 'Designation created successfully');
        return redirect()->route('designations.index');
    }

    public function edit(Designation $designation)
    {
        $designations = Designation::orderBy('created_at', 'DESC')->paginate(5);
        return view('designations.index',compact('designation','designations'));
    }

    public function destroy(Designation $designation,DesignationService $designationService)
    {
        $designationService->destroyDesignation($designation);

        return response('Designation deleted');
    }
}
