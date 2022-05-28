<?php

use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\Option\OptionController;
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
    Route::get('dashboard', fn () => view('home'))->name('dashboard');

    // Invoice
    Route::resource('invoice', InvoiceController::class)->only('index', 'store', 'update', 'destroy');

    // Option
    Route::resource('option', OptionController::class)->only('index', 'store', 'update', 'destroy');
});
