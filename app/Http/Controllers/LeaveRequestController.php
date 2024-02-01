<?php

namespace App\Http\Controllers;

use App\Constants\Role;
use App\Http\Requests\StoreleaveRequestRequest;
use App\Http\Requests\UpdateleaveRequestRequest;
use App\Models\Leavepolicy;
use App\Models\LeaveRequest;
use App\Models\User;
use App\Services\LeaveRequestService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny',LeaveRequest::class);

        $authUser = auth()->user();

        $leaveRequest = LeaveRequest::with(['user', 'referredBy', 'leavePolicy'])->orderBy('created_at', 'DESC')->paginate(5);

        return view('leave-requests.index', compact('leaveRequest'));
    }


    public function myLeaveRequest()
    {

        $this->authorize('viewMy',LeaveRequest::class);

        $authUser = auth()->user();

        $leaveRequest = LeaveRequest::with(['user', 'referredBy', 'leavePolicy'])->orderBy('created_at', 'DESC')->where('user_id',$authUser->id)->paginate(5);

        return view('leave-requests.index', compact('leaveRequest'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',LeaveRequest::class);

        $users = User::orderBy('name')->get();
        $leavePolicies = Leavepolicy::orderBy('title')->get();

        return view('leave-requests.create', compact('users', 'leavePolicies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreleaveRequestRequest $request, LeaveRequestService $leaveRequestService)
    {
        $this->authorize('create',LeaveRequest::class);

        $validated = $request->validated();

        $result = $leaveRequestService->storeLeaveRequest($validated);

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
    public function show(LeaveRequest $leaveRequest)
    {
        $this->authorize('create',$leaveRequest);

        $leaveRequest->load(['user', 'referredBy', 'leavePolicy']);

        return view('leave-requests.view', compact('leaveRequest'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveRequest $leaveRequest)
    {

        $this->authorize('update', $leaveRequest);

        $users = User::orderBy('name')->get();
        $leavePolicies = Leavepolicy::orderBy('title')->get();

        return view('leave-requests.edit', compact('leaveRequest', 'leavePolicies', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateleaveRequestRequest $request, LeaveRequest $leaveRequest, LeaveRequestService $leaveRequestService)
    {
        $this->authorize('update', $leaveRequest);

        $validated = $request->validated();

        $result = $leaveRequestService->updateLeaveRequest($validated, $leaveRequest);

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
    public function destroy(LeaveRequest $leaveRequest,LeaveRequestService $leaveRequestService)
    {
        $leaveRequestService->destroyLeaveRequest($leaveRequest);

        return response('Leave Request Deleted.');
    }
}
