<?php

use App\Http\Controllers\Menu\MenuGroupController;
use App\Http\Controllers\Menu\MenuItemController;
use Illuminate\Support\Facades\Route;

Route::resource('menu-group', MenuGroupController::class);
Route::resource('menu-item', MenuItemController::class);
