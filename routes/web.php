<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::controller(UserController::class)
    ->middleware('auth')
    ->prefix('user')
    ->group(function () {
        Route::get('index', 'index')->name('user-index');
        Route::get('show', 'show')->name('user-show');
        Route::post('store', 'store')->name('user-store');
        Route::put('update', 'update')->name('user-update');
        Route::delete('destroy', 'destroy')->name('user-destroy');
    });