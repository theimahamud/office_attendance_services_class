<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeavepolicyRequest;
use App\Http\Requests\UpdateLeavepolicyRequest;
use App\Models\Leavepolicy;
use App\Models\User;
use App\Services\LeavePolicyService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LeavepolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', User::class);

        $leavePolicies = Leavepolicy::orderBy('created_at', 'DESC')->get();

        return view('leave-policy.index', compact('leavePolicies'));
    }

    public function yearlyLeave()
    {
        $current_date = Carbon::now()->format('m/d/y');

        $yearlyLeave = Leavepolicy::orderBy('created_at', 'DESC')->paginate(10);

        return view('leave-policy.yearly-leave', compact('current_date', 'yearlyLeave'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('view', User::class);

        return view('leave-policy.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeavepolicyRequest $request, LeavePolicyService $leavePolicyService)
    {
        $this->authorize('create', User::class);

        $validated = $request->validated();

        $result = $leavePolicyService->storeLeavePolicy($validated);

        if ($result) {
            Session::flash('success', 'Leave policy created successfully');

            return redirect()->back();
        } else {
            Session::flash('error', 'Leave policy not created successfully');

            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('view', Leavepolicy::class);

        $leavepolicy = Leavepolicy::findOrfail($id);

        return view('leave-policy.view', compact('leavepolicy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('view', Leavepolicy::class);

        $leavepolicy = Leavepolicy::findOrfail($id);

        return view('leave-policy.edit', compact('leavepolicy'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeavepolicyRequest $request, string $id, LeavePolicyService $leavePolicyService)
    {
        $this->authorize('update', [Auth::user(), Leavepolicy::class]);

        $validated = $request->validated();

        $leavePolicy = Leavepolicy::findOrfail($id);

        $result = $leavePolicyService->updateLeavePolicy($validated, $leavePolicy);

        if ($result) {
            Session::flash('success', 'Leave policy updated successfully');

            return redirect()->back();
        } else {
            Session::flash('error', 'Leave policy not updated successfully');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, LeavePolicyService $leavePolicyService)
    {
        $this->authorize('delete', Leavepolicy::class);

        $leavepolicy = Leavepolicy::findOrfail($id);

        $leavePolicyService->destroyLeavePolicy($leavepolicy);

        return response('Leave Policy deleted successfully');

    }
}
