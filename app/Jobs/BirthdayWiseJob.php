<?php

namespace App\Jobs;

use App\Mail\BirthdayWiseMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class BirthdayWiseJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $current_date = Carbon::now()->format('Y-m-d');

        $users = User::whereDate('birth_date', $current_date)->get();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new BirthdayWiseMail($user));
        }
    }
}
