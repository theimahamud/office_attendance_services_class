<?php

namespace App\Jobs;

use App\Models\Holiday;
use App\Models\User;
use App\Notifications\HolidayNoticeNotificationCreate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class HolidayNoticeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */

    public $data;

    public function __construct(Holiday $holidayNotice)
    {
        $this->data = $holidayNotice;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try{

            $users = User::all();

            foreach ($users as $user){

                $user->notify(new HolidayNoticeNotificationCreate($this->data));

            }

        }catch (\Exception $exception){

            \Log::error('Failed to send holiday notice notification: ' . $exception->getMessage());
        }

    }
}
