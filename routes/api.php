<?php

use App\Http\Controllers\Affiliate\AffiliateLinkController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Product\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;

Route::controller(UserController::class)
    ->prefix('user')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('index', 'index')->name('user-index'); // ✓
        Route::get('show/{id?}', 'show')->name('user-show');
        Route::post('store', 'store')->name('user-store') // ✓
            ->withoutMiddleware('auth:sanctum');
        Route::put('update', 'update')->name('user-update');
        Route::put('update-other-user/{id?}', 'updateOtherUser')->name('update-other-user');
        Route::delete('destroy', 'destroy')->name('user-destroy'); // ✓
        Route::delete('destroy-other-user/{id?}', 'destroyOtherUser')->name('destroy-other-user');
    });

Route::controller(AuthController::class)
    ->prefix('auth')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::post('login', 'login')->name('login')
            ->withoutMiddleware('auth:sanctum');
        Route::get('logout', 'logout')->name('logout');
    });

Route::controller(ProductController::class)
    ->prefix('product')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('index', 'index')->name('product-index');
        Route::get('show/{id?}', 'show')->name('product-show');
        Route::post('store', 'store')->name('product-store');
        Route::put('update', 'update')->name('product-update');
        Route::delete('destroy/{id?}', 'destroy')->name('product-destroy');
    });

Route::controller(AffiliateLinkController::class)
    ->prefix('affiliate-link')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::get('index', 'index')->name('al-index');
        Route::get('getMyAffiliateLinks', 'getMyAffiliateLinks')->name('al-getMyAffiliateLinks');
        Route::post('store', 'store')->name('al-store');
        Route::delete('destroy/{id?}', 'destroy')->name('al-destroy');
    });
