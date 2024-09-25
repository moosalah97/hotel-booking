<?php

use App\Http\Controllers\BookingController;
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
    return view('welcome');
});

Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');

// Route to show the form
Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');

// Route to store the booking
Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');

// Route for showing revenue
Route::get('revenue', [BookingController::class, 'getRevenue'])->name('revenue');

// Route for cancelling a booking
Route::post('bookings/{booking}/cancel', [BookingController::class, 'destroy'])->name('bookings.cancel');
