<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::middleware('validate.uuid')->prefix('dashboard/{uuid}')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/generate', [DashboardController::class, 'generateNewLink'])->name('dashboard.generate');
    Route::post('/deactivate', [DashboardController::class, 'deactivateLink'])->name('dashboard.deactivate');
    Route::post('/lucky', [DashboardController::class, 'imFeelingLucky'])->name('dashboard.lucky');
    Route::get('/history', [DashboardController::class, 'history'])->name('dashboard.history');
});
