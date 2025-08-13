<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\ScheduleController;
use App\Http\Controllers\api\v1\DivisionController;
use App\Http\Controllers\api\v1\EmployeeController;
use App\Http\Controllers\api\v1\StatusController;

Route::group(['prefix' => 'v1'], function () {
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('get.api.schedule');
    Route::post('/schedules', [ScheduleController::class, 'create'])->name('post.api.schedule');
    Route::resource('divisions', DivisionController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('statuses', StatusController::class);
});
