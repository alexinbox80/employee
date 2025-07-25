<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
//    Route::get('/', AdminIndexController::class)
//        ->name('index');
    Route::get('/', function() {
        return view('admin.index');
    })->name('index');
});
