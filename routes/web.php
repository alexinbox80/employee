<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DivisionController as AdminDivisionController;
use App\Http\Controllers\admin\EmployeeController as AdminEmployeeController;
use App\Http\Controllers\admin\StatusController as AdminStatusController;
use App\Http\Controllers\admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\site\PageController;
use App\Http\Controllers\site\DocxController;

Route::group(['as' => 'page.'], function () {
    Route::get('/generate-docx', [DocxController::class, 'generate'])->name('get.docx');
    Route::get('/', [PageController::class, 'index'])->name('get.index');
    Route::get('/create', [PageController::class, 'create'])->name('get.create');
    Route::get('/stat', [PageController::class, 'stat'])->name('get.stat');
    Route::get('/employee/{employee}', [PageController::class, 'getEmployeeById'])->name('get.employee');
    Route::get('/division/{division}', [PageController::class, 'getDivisionById'])->name('get.division');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', function() {
        return view('admin.index');
    })->name('index');

    Route::resource('divisions', AdminDivisionController::class);
    Route::resource('employees', AdminEmployeeController::class);
    Route::resource('statuses', AdminStatusController::class);
    Route::resource('schedules', AdminScheduleController::class);
});
