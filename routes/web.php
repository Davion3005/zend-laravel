<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\SliderController;
use App\Http\Controllers\DashboardController;

$prefixAdmin = config('zvn.url.prefix_admin');
$prefixSlider = config('zvn.url.prefix_slider');

Route::get('/', function () {
    return view('home');
});

Route::group([
    'prefix' => $prefixAdmin,
], function () use ($prefixSlider) {

    Route::get('/', function () {
        return view('admin.main');
    });

    //====================SLIDER===============//
    Route::group([
        'prefix' => 'dashboard',
    ], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    });

    //====================SLIDER===============//
    Route::group([
        'prefix' => $prefixSlider,
    ], function () {
       Route::get('/', [SliderController::class, 'index'])->name('slider');

       Route::get('form/{id?}', [SliderController::class, 'form'])->where('id', '[0-9]+')->name('slider/form');

        Route::post('save', [SliderController::class, 'save'])->name('slider/save');

        Route::get('delete/{id}', [SliderController::class, 'delete'])->where('id', '[0-9]+')->name('slider/delete');

        Route::get('change-status-{status}/{id}', [SliderController::class, 'status'])->where('id', '[0-9]+')->name('slider/status');
    });

});
