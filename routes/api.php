<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\ScheduleController;

Route::group(['prefix' => 'v1'], function () {
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('get.api.schedule');
    Route::post('/schedules', [ScheduleController::class, 'create'])->name('post.api.schedule');
});
