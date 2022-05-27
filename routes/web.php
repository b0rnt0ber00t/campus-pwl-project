<?php

use App\Http\Controllers\Invoice\InvoiceController;
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
    Route::get('/dashboard', fn () => view('home'))->name('dashboard');

    Route::resource('invoice', InvoiceController::class)->only('index', 'store', 'destroy');
});
