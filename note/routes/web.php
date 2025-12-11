<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;

Route::middleware([CheckIsNotLogged::class])->group(function () {
    Route::get('/login', [AuthController::class, 'index']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/', [MainController::class, 'home'])->name('home');

    Route::get('/note/create', [MainController::class, 'createNote'])->name('note.new');
    Route::post('/note/store', [MainController::class, 'storeNote'])->name('note.store');

    Route::get('/note/edit/{id}', [MainController::class, 'editNote'])->name('note.edit');
    Route::put('/note/update', [MainController::class, 'updateNote'])->name('note.update');

    Route::get('/note/delete/{id}', [MainController::class, 'deleteNote'])->name('note.delete');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
