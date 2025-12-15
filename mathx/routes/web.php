<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

Route::get('/', [MainController::class, 'home'])->name('home');
Route::post('/generate', [MainController::class, 'generateExercises'])->name('generate');
Route::get('/print', [MainController::class, 'printExercises'])->name('print');
Route::get('/export', [MainController::class, 'exportExercises'])->name('export');
