<?php

namespace App\Console\Commands;

use App\Services\CreateNoticeService;
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
    public function handle(CreateNoticeService $createNoticeService)
    {
        $createNoticeService->createNotice();

        $this->info('Holiday notice jobs dispatched successfully.');
    }
}
