<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get("/test-me", function () {
    return fake()->unique()->email();
})->middleware('throttle:email-generator');
