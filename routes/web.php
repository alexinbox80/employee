<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\StatusController as AdminStatusController;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
//    Route::get('/', AdminIndexController::class)
//        ->name('index');
    Route::get('/', function() {
        return view('admin.index');
    })->name('index');

    Route::resource('statuses', AdminStatusController::class);
});
