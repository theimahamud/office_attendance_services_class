<?php

namespace App\Console\Commands;

use App\Constants\AttendanceStatus;
use App\Models\Attendance;
use App\Models\Settings;
use App\Models\User;
use App\Services\CreateAttendanceService;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
