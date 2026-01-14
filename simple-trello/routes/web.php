<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/', [MainController::class, 'home'])->name('home');
    Route::post('/project/store', [ProjectController::class, 'store'])->name('project.store');
});
