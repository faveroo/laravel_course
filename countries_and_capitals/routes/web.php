<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

// game
Route::get('/', [MainController::class, 'startGame'])->name('game.start');
Route::post('/', [MainController::class, 'prepareGame'])->name('game.prepare');
