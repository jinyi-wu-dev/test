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
        Route::resource('feature', FeatureController::class)->except('show');
        Route::resource('icon', IconController::class)->except('show');

        Route::resource('series', SeriesController::class)->except('show');
        Route::post('series/m_update', [SeriesController::class, 'multi_update'])->name('series.multi_update');
        Route::post('series/m_destroy', [SeriesController::class, 'multi_destroy'])->name('series.multi_destroy');

        Route::resource('item', ItemController::class)->except('show');
        Route::post('item/m_update', [ItemController::class, 'multi_update'])->name('item.multi_update');
        Route::post('item/m_destroy', [ItemController::class, 'multi_destroy'])->name('item.multi_destroy');

        Route::resource('group', CableItemGroupController::class)->except('show');
        Route::post('group/update_groups', [CableItemGroupController::class, 'update_groups'])->name('group.update_groups');
        Route::post('group/destroy_groups', [CableItemGroupController::class, 'destroy_groups'])->name('group.destroy_groups');
        Route::post('group/{group}/add_Item', [CableItemGroupController::class, 'add_item'])->name('group.add_item');
        Route::post('group/{group}/destroy_items', [CableItemGroupController::class, 'destroy_items'])->name('group.destroy_items');

        Route::get('csv', [CsvController::class, 'index'])->name('csv.index');
        Route::post('csv/upload', [CsvController::class, 'upload'])->name('csv.upload');
        Route::get('lend', [LendItemController::class, 'index'])->name('lend.index');
    });
});
