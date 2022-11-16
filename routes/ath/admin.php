<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CharacterController;
use App\Http\Controllers\Admin\PermissionController;

Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Roles
    Route::get('roles', [RoleController::class, 'index'])->name('roles');
    Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('role/{slug}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::post('role/{slug}/update', [RoleController::class, 'update'])->name('role.update');
    Route::get('role/{slug}/delete', [RoleController::class, 'delete'])->name('role.delete');
    Route::get('role/{slug}/restore', [RoleController::class, 'restore'])->name('role.restore');
    Route::get('role/{slug}/destroy', [RoleController::class, 'destroy'])->name('role.destroy');
    Route::post('role/{slug}/permission', [RoleController::class, 'givePermission'])->name('role.permission.give');
    Route::post('role/{rslug}/permission/{pslug}/revoke', [RoleController::class, 'revokePermission'])->name('role.permission.revoke');

    // Permissions
    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions');
    Route::post('permission/store', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('permission/{slug}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::post('permission/{slug}/update', [PermissionController::class, 'update'])->name('permission.update');
    Route::get('permission/{slug}/delete', [PermissionController::class, 'delete'])->name('permission.delete');
    Route::get('permission/{slug}/restore', [PermissionController::class, 'restore'])->name('permission.restore');
    Route::get('permission/{slug}/destroy', [PermissionController::class, 'destroy'])->name('permission.destroy');
    Route::post('permission/{slug}/role', [PermissionController::class, 'assignRole'])->name('permission.role.assignRole');
    Route::post('permission/{pslug}/role/{rslug}/remove', [PermissionController::class, 'removeRole'])->name('permission.role.remove');

    // Users
    Route::get('users', [UserController::class, 'index'])->name('users');
    Route::get('users/filterby/{role}', [UserController::class, 'filterByRole'])->name('users.filterByRole');
    Route::get('user/{username}', [UserController::class, 'show'])->name('user.show');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user/{username}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('user/{username}/update', [UserController::class, 'update'])->name('user.update');
    Route::get('user/{username}/delete', [UserController::class, 'delete'])->name('user.delete');
    Route::get('user/{username}/restore', [UserController::class, 'restore'])->name('user.restore');
    Route::get('user/{username}/destroy', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('user/{username}/role/assign', [UserController::class, 'assignRole'])->name('user.role.assign');
    Route::post('user/{username}/role/remove', [UserController::class, 'removeRole'])->name('user.role.remove');
    Route::post('user/{username}/give/permission', [UserController::class, 'givePermission'])->name('user.permission.give');
    Route::post('user/{username}/remove/permission', [UserController::class, 'removePermission'])->name('user.permission.remove');

    // Characters
    Route::get('characters', [CharacterController::class, 'index'])->name('characters');
    Route::get('character/create', [CharacterController::class, 'create'])->name('character.create');
    Route::post('character/store', [CharacterController::class, 'store'])->name('character.store');
    Route::get('character/{username}', [CharacterController::class, 'show'])->name('character.show');
    Route::get('character/{username}/edit', [CharacterController::class, 'edit'])->name('character.edit');
    Route::post('character/{username}/update', [CharacterController::class, 'update'])->name('character.update');
    Route::get('character/{username}/delete', [CharacterController::class, 'delete'])->name('character.delete');
    Route::get('character/{username}/restore', [CharacterController::class, 'restore'])->name('character.restore');
    Route::get('character/{username}/destroy', [CharacterController::class, 'destroy'])->name('character.destroy');
});
