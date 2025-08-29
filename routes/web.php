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


Route::get( '/',                    [TopController::class, 'index'])            ->name('index');
Route::get( '/lang/{lang}',         [TopController::class, 'lang'])             ->name('lang');

Route::get( '/signup',              [SignupController::class, 'index'])         ->name('signup');
Route::post('/signup/confirm',      [SignupController::class, 'confirm'])       ->name('signup.confirm');
Route::post('/signup/complete',     [SignupController::class, 'complete'])      ->name('signup.complete');

Route::get( '/signin',              [SigninController::class, 'index'])         ->name('signin');
Route::post('/signin',              [SigninController::class, 'authenticate'])  ->name('signin.do');
Route::get ('/signout',             [SigninController::class, 'logout'])        ->name('signout');

Route::get( '/contact',             [ContactController::class, 'index'])        ->name('contact');
Route::post('/contact/confirm',     [ContactController::class, 'confirm'])      ->name('contact.confirm');
Route::post('/contact/complete',    [ContactController::class, 'complete'])     ->name('contact.complete');

Route::get( '/news',                [NewsController::class, 'index'])           ->name('news');

Route::get( '/search',              [ProductController::class, 'search'])       ->name('search');
Route::get( '/series/{id}',         [ProductController::class, 'series'])       ->name('series');
Route::get( '/item/{id}',           [ProductController::class, 'item'])         ->name('item');

Route::get( '/page/{page}',         [PageController::class, 'index'])           ->name('page');

Route::middleware('auth')->group(function() {
    Route::get( '/cart',            [ProductController::class, 'cart'])         ->name('cart');
    Route::post( '/cart',           [ProductController::class, 'cart_complete'])->name('cart.complete');

});



Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest:admin')->group(function() {
        Route::get(     '/login',                   [AdminAuthController::class, 'login'])          ->name('login');
        Route::post(    '/login',                   [AdminAuthController::class, 'authenticate']);
    });

    Route::middleware('auth:admin')->group(function() {
        Route::get(     '/top', function() { return view('/admin/top'); })                          ->name('top');

        Route::get(     '/logout',                  [AdminAuthController::class, 'logout'])         ->name('logout');

        Route::resource('user',                     UserController::class)->except(['create', 'store', 'show']);
        Route::post(    'user/csv',                 [UserController::class, 'csv'])                 ->name('user.csv');
        
        Route::get(     'lend',                     [LendItemController::class, 'index'])           ->name('lend.index');
        Route::post(    'lend/csv',                 [LendItemController::class, 'csv'])             ->name('lend.csv');

        Route::resource('icon',                     IconController::class)->except('show');
        Route::post(    'icon/destroy_multiple',    [IconController::class, 'destroy_multiple'])    ->name('icon.destroy_multiple');

        Route::resource('feature',                  FeatureController::class)->except('show');
        Route::post(    'feature/destroy_multiple', [FeatureController::class, 'destroy_multiple']) ->name('feature.destroy_multiple');
        
        Route::resource('series',                   SeriesController::class)->except('show');
        Route::post(    'series/update_multiple',   [SeriesController::class, 'update_multiple'])   ->name('series.update_multiple');
        Route::post(    'series/destroy_multiple',  [SeriesController::class, 'destroy_multiple'])  ->name('series.destroy_multiple');
        Route::post(    'series/export_csv',        [SeriesController::class, 'export_csv'])        ->name('series.export_csv');
        Route::post(    'series/import_csv',        [SeriesController::class, 'import_csv'])        ->name('series.import_csv');

        Route::resource('item',                         ItemController::class)->except('show');
        Route::post(    'item/update_multiple',         [ItemController::class, 'update_multiple'])             ->name('item.update_multiple');
        Route::post(    'item/destroy_multiple',        [ItemController::class, 'destroy_multiple'])            ->name('item.destroy_multiple');
        Route::post(    'item/export_lighting_csv',     [ItemController::class, 'export_lighting_csv'])         ->name('item.export_lighting_csv');
        Route::post(    'item/export_controller_csv',   [ItemController::class, 'export_controller_csv'])       ->name('item.export_controller_csv');
        Route::post(    'item/export_option_csv',       [ItemController::class, 'export_option_csv'])           ->name('item.export_option_csv');
        Route::post(    'item/import_lighting_csv',     [ItemController::class, 'import_lighting_csv'])         ->name('item.import_lighting_csv');
        Route::post(    'item/import_controller_csv',   [ItemController::class, 'import_controller_csv'])       ->name('item.import_controller_csv');
        Route::post(    'item/import_option_csv',       [ItemController::class, 'import_option_csv'])           ->name('item.import_option_csv');

        Route::resource('cable',                        CableItemGroupController::class)->except('show');
        Route::post(    'cable/update_multiple',        [CableItemGroupController::class, 'update_multiple'])   ->name('cable.update_multiple');
        Route::post(    'cable/destroy_multiple',       [CableItemGroupController::class, 'destroy_multiple'])  ->name('cable.destroy_multiple');
        Route::post(    'cable/{group}/add_item',       [CableItemGroupController::class, 'add_item'])          ->name('cable.add_item');
        Route::post(    'cable/{group}/destroy_items',  [CableItemGroupController::class, 'destroy_items'])     ->name('cable.destroy_items');
        Route::post(    'cable/import_csv',             [CableItemGroupController::class, 'import_csv'])        ->name('cable.import_csv');
        Route::post(    'cable/export_csv',             [CableItemGroupController::class, 'export_csv'])        ->name('cable.export_csv');

        Route::get(     'csv',                          [CsvController::class, 'index'])                        ->name('csv');

    });
});
