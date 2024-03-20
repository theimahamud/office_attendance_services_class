<?php

namespace App\Console;

use App\Jobs\BirthdayWiseJob;
use App\Jobs\CreateAttendanceJob;
use App\Jobs\CreateNoticeJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        Commands\CreateAttendanceCommand::class,
        Commands\BirthdayWiseCommand::class,
        Commands\DispatchHolidayNoticeJob::class,
    ];


    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        //$schedule->command('inspire')->hourly();
        //$schedule->command('holiday:dispatch')->everyMinute();
        //$schedule->command('attendance:dispatch')->everyMinute();

        $schedule->job(CreateNoticeJob::dispatch())->hourly();
        $schedule->job(CreateAttendanceJob::dispatch())->dailyAt('00:00');
        $schedule->job(BirthdayWiseJob::dispatch())->dailyAt('00:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
