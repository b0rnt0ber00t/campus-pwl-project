<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\Option\OptionController;
use App\Http\Controllers\Parking\ParkingController;
use App\Http\Controllers\Parking\ParkingFloorController;
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

Route::redirect('/', '/login');

Route::group(['middleware' => ['auth', 'verified']], function () {
    // Dashbaord
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Invoice
    Route::resource('invoice', InvoiceController::class)->only('index', 'update', 'destroy');
    Route::resource('parking.invoice', InvoiceController::class)->only('store');

    // Option
    Route::resource('option', OptionController::class)->only('index', 'store', 'update', 'destroy');

    // Parking
    Route::resource('parking', ParkingController::class)->only('index');
    Route::prefix('parking')->group(function () {
        Route::resource('floor.parking', ParkingController::class)->only('create', 'store', 'edit', 'update', 'destroy');
    });
    Route::prefix('parking')->name('parking-')->group(function () {
        Route::resource('floor', ParkingFloorController::class)->only('index', 'create', 'store', 'update', 'destroy');
    });
});
