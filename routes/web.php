<?php

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

Auth::routes(['verify'=>true]);




Route::get('/vonage', [App\Http\Controllers\VonageNotify::class,'send']);
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('guest.index');
Route::get('/doctor', [App\Http\Controllers\HomeController::class, 'doctor'])->name('guest.doctor');
Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin'])->name('guest.admin');

Route::get('/email/verify/{id}/{hash}',[App\Http\Controllers\VerificationController::class,'verify'])
    ->middleware(['signed'])
    ->name('verification.verify');

Route::middleware(['PreventBackHistory','auth','is_admin'])->prefix('admin')->name('admin.')->group(function(){
    Route::resources([
        'dashboard' =>App\Http\Controllers\Admin\DashboardController::class,
        'appointment'=>App\Http\Controllers\Admin\AppointmentController::class,
        'assignroom'=>App\Http\Controllers\Admin\AppointmentRoomController::class,
        'room'=>App\Http\Controllers\Admin\RoomController::class,
        'service'=>App\Http\Controllers\Admin\ServiceController::class,
        'doctor'=>App\Http\Controllers\Admin\DoctorController::class,
        'account'=>App\Http\Controllers\Admin\AccountController::class,
    ]);

    Route::controller(App\Http\Controllers\Admin\AppointmentRoomController::class)->group(function () {
        Route::get('/assignroom/appointment/{appointment}', 'appointment')->name('assignroom.appointment');
        Route::get('/assignroom/list/{appointment}', 'list')->name('assignroom.list');
        Route::get('/assignroom/history/{appointment}', 'history')->name('assignroom.history');
        Route::get('/assignroom/list/user/{appointment}', 'user')->name('assignroom.user');
        Route::patch('/assignroom/list/end/{appointment}', 'end')->name('assignroom.end');

    });
    Route::controller(App\Http\Controllers\Admin\AppointmentController::class)->group(function () {
        Route::patch('/appointment/done/{appointment}','done')->name('appointment.done');
        Route::patch('/appointment/decline/{appointment}','decline')->name('appointment.decline');
        Route::get('/appointment/is_approve/{id}', 'isApprove')->name('appointment.is_approve');
        Route::get('/appointment/is_done/{id}', 'isDone')->name('appointment.is_done');
        Route::get('/appointment/is_decline/{id}','isDecline')->name('appointment.is_decline');
        Route::get('/appointment/is_expired/{id}','isExpired')->name('appointment.is_expired');
        Route::get('/appointment/is_going/{id}','isGoing')->name('appointment.is_going');
        Route::get('/appointment/view/email','email')->name('appointment.email');
    });
});

Route::middleware(['PreventBackHistory','auth','is_doctor','doctor_notification'])->prefix('doctor')->name('doctor.')->group(function(){
    Route::resources([
        'dashboard' =>App\Http\Controllers\Doctor\DashboardController::class,
        'appointment'=>App\Http\Controllers\Doctor\AppointmentController::class,
        'history'=>App\Http\Controllers\Doctor\HistoryAppointmentController::class,
        'account'=>App\Http\Controllers\Doctor\AccountController::class,
    ]);
    Route::controller(App\Http\Controllers\Doctor\AppointmentController::class)->group(function () {
        Route::patch('/appointment/going/{appointment}','going')->name('appointment.going');
    });
});

Route::middleware(['PreventBackHistory','auth','is_patient','verified'])->prefix('patient')->name('patient.')->group(function(){
    Route::resources([
        'dashboard' =>App\Http\Controllers\Patient\DashboardController::class,
        'appointment'=>App\Http\Controllers\Patient\AppointmentController::class,
        'history'=>App\Http\Controllers\Patient\HistoryAppointmentController::class,
        'account'=>App\Http\Controllers\Patient\AccountController::class,
    ]);
});
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('guest.logout');
