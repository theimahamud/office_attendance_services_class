<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LeavepolicyController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\ProfileController;
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


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/mail',function (){
//    return view('emails.leave-request-send');
//});


Route::middleware('auth')->group(function () {

    Route::resource('users', UserController::class);
    Route::resource('departments', DepartmentController::class)->except('show');
    Route::resource('designations', DesignationController::class)->except('show');
    Route::resource('holiday', HolidayController::class);
    Route::resource('leave-policy', LeavepolicyController::class);
    Route::resource('leave-request', LeaveRequestController::class);
    Route::get('my-leave-request',[LeaveRequestController::class,'myLeaveRequest'])->name('my-leave-request');
    Route::get('yearly-leave',[LeavepolicyController::class,'yearlyLeave'])->name('yearly-leave');
    Route::get('all-attendance',[AttendanceController::class,'allAttendance'])->name('all-attendance');
    Route::get('my-attendance',[AttendanceController::class,'myAttendance'])->name('my-attendance');
    Route::post('all-absent-present-attendance',[AttendanceController::class,'allAbsentPresentAttendance'])->name('all-absent-present-attendance');
    Route::post('individual-attendance-update',[AttendanceController::class,'individualAttendance'])->name('individual-attendance-update');

    Route::get('see-all-notification',[DashboardController::class,'seeAllNotification'])->name('see-all-notification');

    Route::get('/user/profile', [ProfileController::class, 'view'])->name('profile.view');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
