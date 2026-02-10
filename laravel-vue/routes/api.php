<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get("/test-me", function () {
    return Str::random(10);
});
