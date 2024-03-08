<?php

namespace App\Console\Commands;

use App\Constants\Status;
use App\Jobs\HolidayNoticeJob;
use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DispatchHolidayNoticeJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'holiday:dispatch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch holiday notice job for draft holidays.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $draftHolidays = Holiday::where('status', Status::DRAFT)
            ->whereDate('start_date', '=', Carbon::now()->addHours(12)->toDateString())
            ->get();

        foreach ($draftHolidays as $holiday) {

            dispatch(new HolidayNoticeJob($holiday));
            $holiday->update(['status' => Status::PUBLISHED]);

        }

        $this->info('Holiday notice jobs dispatched successfully.');
    }
}
