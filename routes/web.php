<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\RegisterController;

Route::get('', [UserController::class, 'index'])->name('index');
Route::prefix('register')->group(function () {
    Route::get('', [RegisterController::class, 'index'])->name('register.index');
    Route::post('', [RegisterController::class, 'register'])->name('register');
});
Route::prefix('verify')->group(function () {
    Route::get('', [VerifyController::class, 'index'])->name('verify.index');
    Route::post('reverify', [VerifyController::class, 'reverify'])->name('reverify');
    Route::get('{verify_token}', [VerifyController::class, 'verify'])->name('verify');
});
Route::get('verified', [VerifyController::class, 'verified'])->name('verified');