<?php

namespace App\Http\Controllers;

use App\Constants\LeaveStatus;
use App\Constants\Role;
use App\Http\Requests\StoreleaveRequestRequest;
use App\Http\Requests\UpdateleaveRequestRequest;
use App\Mail\LeaveRequestSend;
use App\Models\Leavepolicy;
use App\Models\LeaveRequest;
use App\Models\User;
use App\Notifications\LeaveRequestApprovedRejectedNotification;
use App\Notifications\LeaveRequestSendNotification;
use App\Services\LeaveRequestService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', LeaveRequest::class);

        $authUser = auth()->user();

        $leaveRequest = LeaveRequest::with(['user', 'referredBy', 'leavePolicy'])->orderBy('created_at', 'DESC')->get();

        return view('leave-requests.index', compact('leaveRequest'));
    }

    public function myLeaveRequest()
    {

        $this->authorize('viewMy', LeaveRequest::class);

        $authUser = auth()->user();

        $leaveRequest = LeaveRequest::with(['user', 'referredBy', 'leavePolicy'])->orderBy('created_at', 'DESC')->where('user_id', $authUser->id)->paginate(5);

        return view('leave-requests.index', compact('leaveRequest'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', LeaveRequest::class);

        $users = User::orderBy('name')->get();
        $leavePolicies = Leavepolicy::orderBy('title')->get();

        return view('leave-requests.create', compact('users', 'leavePolicies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreleaveRequestRequest $request, LeaveRequestService $leaveRequestService)
    {
        $this->authorize('create', LeaveRequest::class);

        $validated = $request->validated();

        $result = $leaveRequestService->storeLeaveRequest($validated);

        if ($result) {

            // Mail::to(config('mail.admin_email'))->send(new LeaveRequestSend($data));  //This code is for email send
            //$data = (object)$leaveRequestService->getEmailData($result);

            $leave_request_data = $result->load('user', 'leavePolicy', 'referredBy');

            $users = User::where('role', Role::ADMIN)->get();

            Notification::send($users, new LeaveRequestSendNotification($leave_request_data));

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
        $this->authorize('create', $leaveRequest);

        $leaveRequest->load(['user', 'referredBy', 'leavePolicy']);

        $current_date = Carbon::now()->format('m/d/y');

        $yearlyLeave = Leavepolicy::orderBy('created_at', 'DESC')->get();

        $unreadMessage = auth()->user()->unreadNotifications;

        foreach ($unreadMessage as $notification) {
            if (isset($notification->data['leave_request_id']) && $notification->data['leave_request_id'] === $leaveRequest->id) {
                $notification->markAsRead();
            }
        }

        return view('leave-requests.view', compact('leaveRequest', 'current_date', 'yearlyLeave'));
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

            if ($request->status === LeaveStatus::APPROVED || $request->status === LeaveStatus::REJECTED) {

                $leave_request_data = $leaveRequest->load('user', 'leavePolicy', 'referredBy');

                $leave_request_data->user->notify(new LeaveRequestApprovedRejectedNotification($leave_request_data));

            }

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
    public function destroy(LeaveRequest $leaveRequest, LeaveRequestService $leaveRequestService)
    {
        $leaveRequestService->destroyLeaveRequest($leaveRequest);

        return response('Leave Request Deleted.');
    }
}
