<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HaravanAuthController;
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

Route::get('/', function () {
    return view('login.index');
});

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/login', [HaravanAuthController::class, 'redirectToProvider']);
Route::get('/login_callback', [HaravanAuthController::class, 'handleProviderCallback']);
