<?php

use App\Http\Controllers\Api\v1\User\BookingController;
use App\Http\Controllers\Api\v1\User\ServiceController;
use Illuminate\Support\Facades\Route;


Route::get('/services', [ServiceController::class, 'index'])->name('services.index');

Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');