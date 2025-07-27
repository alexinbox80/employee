<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DivisionController as AdminDivisionController;
use App\Http\Controllers\admin\EmployeeController as AdminEmployeeController;
use App\Http\Controllers\admin\StatusController as AdminStatusController;
use App\Http\Controllers\admin\ScheduleController as AdminScheduleController;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
//    Route::get('/', AdminIndexController::class)
//        ->name('index');
    Route::get('/', function() {
        return view('admin.index');
    })->name('index');

    Route::resource('divisions', AdminDivisionController::class);
    Route::resource('employees', AdminEmployeeController::class);
    Route::resource('statuses', AdminStatusController::class);
    Route::resource('schedules', AdminScheduleController::class);
});
