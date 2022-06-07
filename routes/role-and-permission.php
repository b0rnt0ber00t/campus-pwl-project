<?php

use App\Http\Controllers\RoleAndPermission\AssignPermissionController;
use App\Http\Controllers\RoleAndPermission\AssignUserToRoleController;
use App\Http\Controllers\RoleAndPermission\ExportPermissionController;
use App\Http\Controllers\RoleAndPermission\ExportRoleController;
use App\Http\Controllers\RoleAndPermission\ImportPermissionController;
use App\Http\Controllers\RoleAndPermission\ImportRoleController;
use App\Http\Controllers\RoleAndPermission\PermissionController;
use App\Http\Controllers\RoleAndPermission\RoleController;
use Illuminate\Support\Facades\Route;

//role
Route::resource('role', RoleController::class);
Route::get('role/export', ExportRoleController::class)->name('role.export');
Route::post('role/import', ImportRoleController::class)->name('role.import');

//permission
Route::resource('permission', PermissionController::class);
Route::get('permission/export', ExportPermissionController::class)->name('permission.export');
Route::post('permission/import', ImportPermissionController::class)->name('permission.import');

//assign permission
Route::get('assign', [AssignPermissionController::class, 'index'])->name('assign.index');
Route::get('assign/create', [AssignPermissionController::class, 'create'])->name('assign.create');
Route::get('assign/{role}/edit', [AssignPermissionController::class, 'edit'])->name('assign.edit');
Route::put('assign/{role}', [AssignPermissionController::class, 'update'])->name('assign.update');
Route::post('assign', [AssignPermissionController::class, 'store'])->name('assign.store');

//assign user to role
Route::get('assign-user', [AssignUserToRoleController::class, 'index'])->name('assign.user.index');
Route::get('assign-user/create', [AssignUserToRoleController::class, 'create'])->name('assign.user.create');
Route::post('assign-user', [AssignUserToRoleController::class, 'store'])->name('assign.user.store');
Route::get('assing-user/{user}/edit', [AssignUserToRoleController::class, 'edit'])->name('assign.user.edit');
Route::put('assign-user/{user}', [AssignUserToRoleController::class, 'update'])->name('assign.user.update');
