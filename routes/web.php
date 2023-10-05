<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\RegisterController;

Route::get('', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('index');
Route::prefix('register')->group(function () {
    Route::get('', [RegisterController::class, 'index'])->name('register.index');
    Route::post('', [RegisterController::class, 'register'])->name('register');
});
Route::get('verify', [VerifyController::class, 'index'])->middleware('auth')->name('verification.notice');
Route::post('reverify', [VerifyController::class, 'reverify'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::get('verify/{id}/{hash}', [VerifyController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::get('verified', [VerifyController::class, 'verified'])->name('verified');