<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DivisionController as AdminDivisionController;
use App\Http\Controllers\admin\EmployeeController as AdminEmployeeController;
use App\Http\Controllers\admin\StatusController as AdminStatusController;
use App\Http\Controllers\admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\site\PageController;

//Route::get('/', function () {
//    return view('index', ['hello' => 'world']);
//});

Route::get('/', [PageController::class, 'index']);

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
