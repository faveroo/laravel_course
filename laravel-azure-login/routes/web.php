<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->middleware('auth')->name('logout');

Route::middleware('guest')->group(function () {
    Route::get('/api/login', [AuthController::class, 'auth'])->name('auth.microsoft');
    Route::get('/api/auth', [AuthController::class, 'callback']);
    Route::get('/', function () {
        return view('welcome');
    })->name('login');
});
