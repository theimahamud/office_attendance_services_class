<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LeavepolicyController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/xclean', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:cache');
    dd('CACHE-CLEARED, VIEW-CLEARED,ROUTE-CLEARED & CONFIG-CACHED WAS SUCCESSFUL!');
});

Route::get('/attendance', function () {
    Artisan::call('attendance:dispatch');
});

Route::get('/test', function () {
   return view('emails.leave-request-send');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::resource('users', UserController::class);
    Route::resource('departments', DepartmentController::class)->except('show');
    Route::resource('designations', DesignationController::class)->except('show');
    Route::resource('holiday', HolidayController::class);
    Route::resource('leave-policy', LeavepolicyController::class);
    Route::resource('leave-request', LeaveRequestController::class);

    Route::put('leave-request-approved/{id}', [LeaveRequestController::class, 'leaveRequestApproved'])->name('leave-request-approved');
    Route::put('leave-request-rejected/{id}', [LeaveRequestController::class, 'leaveRequestRejected'])->name('leave-request-rejected');

    Route::get('my-leave-request', [LeaveRequestController::class, 'myLeaveRequest'])->name('my-leave-request');
    Route::get('yearly-leave', [LeavepolicyController::class, 'yearlyLeave'])->name('yearly-leave');
    Route::get('all-attendance', [AttendanceController::class, 'allAttendance'])->name('all-attendance');
    Route::get('my-attendance', [AttendanceController::class, 'myAttendance'])->name('my-attendance');
    Route::post('all-absent-present-attendance', [AttendanceController::class, 'allAbsentPresentAttendance'])->name('all-absent-present-attendance');
    Route::post('individual-attendance-update', [AttendanceController::class, 'individualAttendance'])->name('individual-attendance-update');

    Route::get('see-all-notification', [DashboardController::class, 'seeAllNotification'])->name('see-all-notification');
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings/store', [SettingsController::class, 'store'])->name('settings.store');

    Route::prefix('reports')->group(function () {
        Route::get('office', [ReportController::class, 'officeReport'])->name('office.reports');
        Route::get('attendance', [ReportController::class, 'attendanceReport'])->name('attendance.reports');
        Route::post('report-generate', [ReportController::class, 'reportGenerate'])->name('report-generate');
        Route::get('download-attendance-report', [ReportController::class, 'downloadAttendanceReport'])->name('download-attendance-report');
    });

    Route::post('check-in-attendance', [AttendanceController::class, 'checkInAttendanceStore'])->name('check-in-attendance');
    Route::post('check-out-attendance', [AttendanceController::class, 'checkOutAttendanceUpdate'])->name('check-out-attendance');
    Route::get('attendance-summary', [AttendanceController::class, 'attendanceSummary'])->name('attendance-summary');
    Route::get('attendance-update-date-wise/{id}', [AttendanceController::class, 'attendanceUpdateDateWise'])->name('attendance-update-date-wise');
    Route::post('attendance-update-by-date/{id}', [AttendanceController::class, 'attendanceUpdateByDate'])->name('attendance-update-by-date');
    Route::delete('attendance/delete/{id}', [AttendanceController::class, 'destroy'])->name('attendance.destroy');

    Route::get('/user/profile', [ProfileController::class, 'view'])->name('profile.view');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
