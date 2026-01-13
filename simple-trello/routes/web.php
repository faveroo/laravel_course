<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;


Route::get('/', [MainController::class, 'home'])->middleware(['auth'])->name('home');
