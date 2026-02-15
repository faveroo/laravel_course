<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('HomeRoute');    
});

Route::get('/test', function () {
    return Inertia::render('TestRoute');
});

Route::get('/error', function () {
    abort([402, 404, 500][array_rand([402, 404, 500])]);
});
