<?php

use App\Http\Controllers\Api\{AuthController, ScheduleController, AppointmentController, PublicController};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/login', [AuthController::class, 'login']);

// Public - no auth, powers the homepage preview
Route::get('/public/availability', [PublicController::class, 'upcomingAvailability']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', fn (Request $r) => $r->user());

    Route::get('/schedules', [ScheduleController::class, 'index']);
    Route::get('/schedules/{schedule}/availability', [ScheduleController::class, 'Api\ScheduleController@availability']);

    Route::get('/appointments', [AppointmentController::class, 'index']);
    Route::get('/appointments', [AppointmentController::class, 'store']);
    Route::delete('/appointments/{appointment}', [AppointmentController::class, 'destroy']);
});
