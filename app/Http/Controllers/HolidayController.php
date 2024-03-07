<?php

namespace App\Http\Controllers;

use App\Constants\Status;
use App\Http\Requests\StoreHolidayRequest;
use App\Http\Requests\UpdateHolidayRequest;
use App\Jobs\HolidayNoticeJob;
use App\Models\Holiday;
use App\Models\User;
use App\Notifications\HolidayNoticeNotificationCreate;
use App\Services\HoliDayService;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;

class HolidayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view', User::class);

        $holidays = Holiday::orderBy('created_at', 'DESC')->get();

        return view('holiday.index', compact('holidays'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('view', User::class);

        return view('holiday.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHolidayRequest $request, HoliDayService $holiDayService)
    {
        $this->authorize('create', Holiday::class);

        $validated = $request->validated();

        $result = $holiDayService->storeHoliday($validated, $request->hasFile('image') ? $request->file('image') : null);

        if ($result) {

            if($request->status === Status::PUBLISHED){

                $startDate = $validated['start_date'];
                $dispatchDate = \Carbon\Carbon::parse($startDate)->subHours(12);
                // Dispatch job
                HolidayNoticeJob::dispatch($result)->delay($dispatchDate);
            }

            Session::flash('success', 'Holiday created successfully');

            return redirect()->back();
        } else {
            Session::flash('error', 'Holiday not created successfully');

            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Holiday $holiday)
    {
        $this->authorize('view', $holiday);

        $unreadMessage = auth()->user()->unreadNotifications;

        foreach ($unreadMessage as $notification) {
            if (isset($notification->data['holiday_notice_id']) && $notification->data['holiday_notice_id'] === $holiday->id) {
                $notification->markAsRead();
            }
        }

        return view('holiday.view', compact('holiday'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Holiday $holiday)
    {
        $this->authorize('view', $holiday);

        return view('holiday.edit', compact('holiday'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHolidayRequest $request, Holiday $holiday, HoliDayService $holiDayService)
    {
        $this->authorize('update', $holiday);

        $validated = $request->validated();

        $result = $holiDayService->updateHoliday($validated, $holiday, $request->hasFile('image') ? $request->file('image') : null);

        if ($result) {

            if($request->status === Status::PUBLISHED){
                $startDate = $validated['start_date'];
                $dispatchDate = \Carbon\Carbon::parse($startDate)->subHours(12);
                // Dispatch job
                HolidayNoticeJob::dispatch($result)->delay($dispatchDate);
            }

            Session::flash('success', 'Holiday updated successfully');

            return redirect()->back();
        } else {
            Session::flash('error', 'Holiday not updated successfully');

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Holiday $holiday, HoliDayService $holiDayService)
    {
        $this->authorize('delete', $holiday);
        $holiDayService->destroyHoliday($holiday);

        return response('Holiday deleted');
    }
}
