<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\ScheduleController;
use App\Http\Controllers\api\v1\DivisionController;
use App\Http\Controllers\api\v1\EmployeeController;
use App\Http\Controllers\api\v1\StatusController;

Route::group(['prefix' => 'v1'], function () {
    Route::get('/blade_schedules', [ScheduleController::class, 'index_blade'])->name('get.api.schedule.blade');
    Route::post('/blade_schedules', [ScheduleController::class, 'create_blade'])->name('post.api.schedule.blade');

    Route::resource('divisions', DivisionController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('schedules', ScheduleController::class);
    Route::resource('statuses', StatusController::class);
});
