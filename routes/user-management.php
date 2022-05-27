<?php

use App\Http\Controllers\DemoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// user list
Route::resource('user', UserController::class);
Route::post('import', [UserController::class, 'import'])->name('user.import');
Route::get('export', [UserController::class, 'export'])->name('user.export');
Route::get('demo', DemoController::class)->name('user.demo');
