<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GrenadeController;
use App\Http\Controllers\CalloutController;


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



Auth::routes();

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/{map}', [MapController::class, 'show'])->name('maps.show');

Route::middleware(['auth'])->group(function() {
    Route::get('/{map}/grenade/create', [GrenadeController::class, 'create'])->name('grenade.create');
    Route::post('/{map}/grenade/store', [GrenadeController::class, 'store'])->name('grenade.store');
    Route::get('/{map}/grenade/edit/{grenade}', [GrenadeController::class, 'edit'])->name('grenade.edit');

    Route::middleware(['can:isAdmin'])->group(function() {
        Route::get('/users/list', [UserController::class, 'index'])->name('users.index');
        Route::get('/maps/list', [MapController::class, 'index'])->name('maps.index');
        Route::get('/maps/create', [MapController::class, 'create'])->name('maps.create');
        Route::post('/maps/store', [MapController::class, 'store'])->name('maps.store');
        Route::get('/{map}/edit', [MapController::class, 'edit'])->name('maps.edit');
        Route::post('/{map}/update', [MapController::class, 'update'])->name('maps.update');
        Route::get('/{map}/settings', [MapController::class, 'settings'])->name('maps.settings');
        Route::get('/grenades/list', [GrenadeController::class, 'index'])->name('grenade.index');
        Route::put('/callouts/update', [CalloutController::class, 'update'])->name('callout.update');
        Route::post('/callouts/store', [CalloutController::class, 'store'])->name('callout.store');
        Route::delete('/callouts/{callout}', [CalloutController::class, 'destroy'])->name('callout.destroy');
    });
});

Route::get('/maps/grenades/show/{grenade}', [GrenadeController::class, 'show'])->name('grenade.show')->middleware('auth');
Route::post('/maps/grenades/update', [GrenadeController::class, 'update'])->name('grenade.update')->middleware('auth');

/* AJAX */
Route::get('/fetch-callouts/{areaId}', [GrenadeController::class, 'fetchCallouts']);
Route::get('/fetch_callouts/{area}', [MapController::class, 'fetchCallouts']);



