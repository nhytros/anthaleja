<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\FrontierController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['guest']], function () {
    Route::view('frontier', 'user.frontier.index')->name('frontier');
    Route::post('frontier/login', [FrontierController::class, 'login'])->name('frontier.login');
    Route::post('frontier/register', [FrontierController::class, 'register'])->name('frontier.register');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('frontier/logout', [FrontierController::class, 'logout'])->name('frontier.logout');

    Route::get('user/{username}/edit', [UserController::class, 'edit'])->name('user.edit');
});
