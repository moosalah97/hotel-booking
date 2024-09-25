<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\RateplanController;
use App\Http\Controllers\RoomController;
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

Route::apiResource('rooms', RoomController::class);
Route::apiResource('rateplans', RateplanController::class);
Route::apiResource('calendars', CalendarController::class);
Route::apiResource('bookings', BookingController::class);

Route::post('bookings/{booking}/cancel', [BookingController::class, 'destroy']);
Route::get('revenue', [BookingController::class, 'getRevenue']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
