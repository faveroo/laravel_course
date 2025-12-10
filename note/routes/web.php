<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;

Route::get('/login', function () {
    return view('login');
})->name('index');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::post('/create-note', [MainController::class, 'createNote'])->name('create-note');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
