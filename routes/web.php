<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IconController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CableItemGroupController;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\LendItemController;

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

        Route::resource('icon', IconController::class)->except('show');
        Route::post('icon/destroy_multiple', [IconController::class, 'destroy_multiple'])->name('icon.destroy_multiple');

        Route::resource('feature', FeatureController::class)->except('show');
        Route::post('feature/destroy_multiple', [FeatureController::class, 'destroy_multiple'])->name('feature.destroy_multiple');
        
        Route::resource('series', SeriesController::class)->except('show');
        Route::post('series/update_multiple', [SeriesController::class, 'update_multiple'])->name('series.update_multiple');
        Route::post('series/destroy_multiple', [SeriesController::class, 'destroy_multiple'])->name('series.destroy_multiple');

        Route::resource('item', ItemController::class)->except('show');
        Route::post('item/update_multiple', [ItemController::class, 'update_multiple'])->name('item.update_multiple');
        Route::post('item/destroy_multiple', [ItemController::class, 'destroy_multiple'])->name('item.destroy_multiple');

        Route::resource('group', CableItemGroupController::class)->except('show');
        Route::post('group/update_multiple', [CableItemGroupController::class, 'update_multiple'])->name('group.update_multiple');
        Route::post('group/destroy_multiple', [CableItemGroupController::class, 'destroy_multiple'])->name('group.destroy_multiple');
        Route::post('group/{group}/add_item', [CableItemGroupController::class, 'add_item'])->name('group.add_item');
        Route::post('group/{group}/destroy_items', [CableItemGroupController::class, 'destroy_items'])->name('group.destroy_items');

        Route::get('csv', [CsvController::class, 'index'])->name('csv.index');
        Route::post('csv/upload', [CsvController::class, 'upload'])->name('csv.upload');
        Route::get('lend', [LendItemController::class, 'index'])->name('lend.index');
    });
});
