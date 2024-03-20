<?php

namespace App\Console\Commands;

use App\Services\CreateAttendanceService;
use Illuminate\Console\Command;

class CreateAttendanceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:dispatch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create attendance everyday at 12 AM';

    /**
     * Execute the console command.
     */
    public function handle(CreateAttendanceService $createAttendanceService)
    {
        $createAttendanceService->createAttendance();

        $this->info('Attendance jobs dispatched successfully.');
    }
}
