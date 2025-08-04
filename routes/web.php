<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DivisionController as AdminDivisionController;
use App\Http\Controllers\admin\EmployeeController as AdminEmployeeController;
use App\Http\Controllers\admin\StatusController as AdminStatusController;
use App\Http\Controllers\admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\site\PageController;
use App\Http\Controllers\site\DocxController;

Route::get('/generate-docx', [DocxController::class, 'generate'])->name('page_generate_docx');

Route::get('/', [PageController::class, 'index'])->name('page_index');
Route::get('/create', [PageController::class, 'create'])->name('page_create');
Route::get('/employee/{employee}', [PageController::class, 'getEmployeeById'])->name('page_employee');
Route::get('/division/{division}', [PageController::class, 'getDivisionById'])->name('page_division');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', function() {
        return view('admin.index');
    })->name('index');

    Route::resource('divisions', AdminDivisionController::class);
    Route::resource('employees', AdminEmployeeController::class);
    Route::resource('statuses', AdminStatusController::class);
    Route::resource('schedules', AdminScheduleController::class);
});
