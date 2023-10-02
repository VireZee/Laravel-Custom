<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('', [UserController::class, 'index'])->name('index');
Route::get('register', [RegisterController::class, 'index'])->name('register.view');
Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::get('verify', [VerifyController::class, 'index'])->name('verify.view');
Route::post('verify', [VerifyController::class, 'reverify'])->name('reverify');
Route::get('verify/{token}', [VerifyController::class, 'verify'])->name('verify');
Route::get('verified', [VerifyController::class, 'verified'])->name('verified');