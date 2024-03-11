<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GrenadeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/maps/list', [MapController::class, 'index'])->name('maps.index')->middleware('auth');
Route::get('/users/list', [UserController::class, 'index'])->name('users.index')->middleware('auth');
Route::get('/maps/{map}', [MapController::class, 'show'])->name('maps.show')->middleware('auth');
Route::get('/maps/grenades/{map}/create', [GrenadeController::class, 'create'])->name('maps.create')->middleware('auth');
Route::post('/maps/grenades/store', [GrenadeController::class, 'store'])->name('grenade.store')->middleware('auth');



