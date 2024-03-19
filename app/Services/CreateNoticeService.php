<?php


namespace App\Services;


use App\Constants\Status;
use App\Jobs\HolidayNoticeJob;
use App\Models\Holiday;
use Carbon\Carbon;

class CreateNoticeService
{

    public function createNotice()
    {
        $draftHolidays = Holiday::where('status', Status::DRAFT)
            ->whereDate('start_date', '=', Carbon::now()->addHours(12)->toDateString())
            ->get();

        foreach ($draftHolidays as $holiday) {

            dispatch(new HolidayNoticeJob($holiday));
            $holiday->update(['status' => Status::PUBLISHED]);

        }
    }

}
