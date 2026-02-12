<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return Inertia::render('Home');
})->middleware('guest');

Route::get('/cookie', function () {
    return Inertia::render('Cookie');
});
