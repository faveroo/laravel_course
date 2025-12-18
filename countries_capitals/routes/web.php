<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('game.index') : redirect()->route('login.form');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register.form');
    Route::post('/register', [AuthController::class, 'store'])->name('register');
});

Route::middleware('auth')->group(function () {
    Route::get('/game', [GameController::class, 'game'])->name('game.index');
});
