<?php

namespace App\Providers;

use App\Models\LeaveRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        View::composer('*', function ($view) {
            $currentUser = Auth::user();
            $unreadNotifications = [];

            // Check if there is an authenticated user
            if ($currentUser) {
                $unreadNotifications = $currentUser->unreadNotifications;
            }

            $view->with(['currentUser' => $currentUser, 'unreadNotifications' => $unreadNotifications]);
        });
    }
}
