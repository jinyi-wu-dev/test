<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IconController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\SeriesController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest:admin')->group(function() {
        Route::get('/login', [AdminAuthController::class, 'login'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'authenticate']);
    });
    Route::middleware('auth:admin')->group(function() {
        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/top', function() { return view('/admin/top'); })->name('top');

        //Route::resource('user', UserController::class)->except(['create', 'store', 'show']);
        Route::resource('user', UserController::class);
        Route::resource('feature', FeatureController::class)->except('show');
        Route::resource('icon', IconController::class)->except('show');
        Route::resource('series', SeriesController::class)->except('show');
        Route::post('series/m_update', [SeriesController::class, 'multi_update'])->name('series.multi_update');
        Route::post('series/m_destroy', [SeriesController::class, 'multi_destroy'])->name('series.multi_destroy');
    });
});
