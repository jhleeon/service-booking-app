<?php

use App\Http\Controllers\Api\v1\Admin\ServiceController;
use Illuminate\Support\Facades\Route;

Route::Post('/services', [ServiceController::class, 'store'])->name('services.store');
Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');