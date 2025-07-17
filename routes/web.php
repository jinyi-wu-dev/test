<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\IconController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\SeriesController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\CableItemGroupController;
use App\Http\Controllers\Admin\CsvController;
use App\Http\Controllers\Admin\LendItemController;

use App\Http\Controllers\Front\TopController;
use App\Http\Controllers\Front\SignupController;
use App\Http\Controllers\Front\SigninController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\NewsController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\PageController;

Route::get('/test', function () {
    return view('front/jp/test');
});


Route::get( '/',                [TopController::class, 'index'])            ->name('index');

Route::get( '/signup',          [SignupController::class, 'index'])         ->name('signup');
Route::post('/signup/confirm',  [SignupController::class, 'confirm'])       ->name('signup.confirm');
Route::post('/signup/complete', [SignupController::class, 'complete'])      ->name('signup.complete');

Route::get( '/signin',          [SigninController::class, 'index'])         ->name('signin');
Route::post('/signin',          [SigninController::class, 'authenticate'])  ->name('signin.do');
Route::get ('/signout',         [SigninController::class, 'logout'])        ->name('signout');

Route::get( '/contact',         [ContactController::class, 'index'])        ->name('contact');
Route::post('/contact',         [ContactController::class, 'do'])           ->name('contact.do');

Route::get( '/news',            [NewsController::class, 'index'])           ->name('news');

Route::get( '/search',          [ProductController::class, 'search'])       ->name('search');
Route::get( '/series/{id}',     [ProductController::class, 'series'])       ->name('series');
Route::get( '/item/{id}',       [ProductController::class, 'item'])         ->name('item');

Route::get( '/page/{page}',     [PageController::class, 'index'])           ->name('page');

Route::middleware('auth')->group(function() {
    Route::get( '/cart',        [ProductController::class, 'cart'])         ->name('cart');
    Route::post( '/cart',       [ProductController::class, 'cart_complete'])->name('cart.complete');

});



Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function() {
        Route::get(     '/login',                   [AdminAuthController::class, 'login'])          ->name('login');
        Route::post(    '/login',                   [AdminAuthController::class, 'authenticate']);
    });

    Route::middleware('auth:admin')->group(function() {
        Route::get(     '/top', function() { return view('/admin/top'); })                          ->name('top');

        Route::get(     '/logout',                  [AdminAuthController::class, 'logout'])         ->name('logout');

        Route::resource('user', UserController::class)->except(['create', 'store', 'show']);
        Route::post(    'user/csv',                 [UserController::class, 'csv'])                 ->name('user.csv');
        
        Route::get(     'lend',                     [LendItemController::class, 'index'])           ->name('lend.index');
        Route::post(    'lend/csv',                 [LendItemController::class, 'csv'])             ->name('lend.csv');

        Route::resource('icon',                     IconController::class)->except('show');
        Route::post(    'icon/destroy_multiple',    [IconController::class, 'destroy_multiple'])    ->name('icon.destroy_multiple');

        Route::resource('feature',                  FeatureController::class)->except('show');
        Route::post(    'feature/destroy_multiple', [FeatureController::class, 'destroy_multiple']) ->name('feature.destroy_multiple');
        
        Route::resource('series',                   SeriesController::class)->except('show');
        Route::post(    'series/update_multiple',   [SeriesController::class, 'update_multiple'])->name('series.update_multiple');
        Route::post(    'series/destroy_multiple',  [SeriesController::class, 'destroy_multiple'])->name('series.destroy_multiple');

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

    });
});
