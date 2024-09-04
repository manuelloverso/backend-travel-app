<?php

use App\Http\Controllers\Api\DayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Api\TripController;
use App\Http\Controllers\Api\StopController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('api')
    ->name('login');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('api')
    ->name('register');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('trips', [TripController::class, 'index']);
Route::get('trips/{trip}', [TripController::class, 'show']);

Route::post('trip', [TripController::class, 'store']);
Route::delete('delete/trip/{id}', [TripController::class, 'destroy']);
Route::put('trip/{id}', [TripController::class, 'update']);


Route::post('day', [DayController::class, 'store']);

Route::post('stop', [StopController::class, 'store']);
Route::delete('delete/stop/{id}', [StopController::class, 'destroy']);
