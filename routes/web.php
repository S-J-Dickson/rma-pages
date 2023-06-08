<?php

use App\Http\Controllers\RMAController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', fn() => Inertia::render('Welcome', [
    'canLogin' => true,
    'canRegister' => true,
    'laravelVersion' => Application::VERSION,
    'phpVersion' => PHP_VERSION,
]))->middleware('guest');

Route::middleware(['auth:sanctum', config('jetstream.auth_session')])->group(function () {
    Route::get('/dashboard', fn() => Inertia::render('Dashboard', config('tasks')))->name('dashboard');

    Route::resource('rma', RMAController::class)->only(['index', 'create', 'store', 'show']);
});
