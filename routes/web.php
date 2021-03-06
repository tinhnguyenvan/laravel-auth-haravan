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

Route::get('/', [HaravanAuthController::class, 'index'])->name('index');

Route::get('/login', [HaravanAuthController::class, 'redirectToProvider'])->name('login');
Route::post('/login_callback', [HaravanAuthController::class, 'handleProviderCallback']);

Route::middleware(['auth'])->group(
    function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::get('/logout', [HaravanAuthController::class, 'logout']);
    }
);

