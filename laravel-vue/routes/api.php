<?php

use Illuminate\Support\Facades\Route;
use Random\RandomError;
use Random\RandomException;

Route::get("/test-me", function () {
    return abort([402, 404, 500][array_rand([402, 404, 500])]);
});
