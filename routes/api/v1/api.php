<?php

use App\Http\Controllers\Api\v1\Auth\LoginController;
use App\Http\Controllers\Api\v1\Auth\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::Post('/register',[RegistrationController::class, 'registration'])->name('registration');
    Route::Post('/login',[LoginController::class, 'login'])->name('login');
});