<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/admin', function () {
        return "Admin";
    })->name('admin')->middleware('role:admin');
});

Route::middleware('guest')->group(function () {
    Route::get('/api/login', [AuthController::class, 'auth'])->name('auth.microsoft');
    Route::get('/api/auth', [AuthController::class, 'callback']);
    Route::get('/', function () {
        return view('welcome');
    })->name('login');
});
