<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Korfball\TeamController;
use App\Http\Controllers\Korfball\PlayerController;

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

Route::get('/info', function () {
    phpinfo();
});
Route::get('/', function () {
    if (Auth::viaRemember()) {
        return Redirect::route('home')->with('success', 'Access granted to Anthalys');
    } else {
        return view('home');
    }
})->name('home');

Route::get('/korfball/players', [PlayerController::class, 'index'])->name('korfball.players');

Route::get('/korfball/teams', [TeamController::class, 'index'])->name('korfball.teams');
