<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/github', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.github');

Route::get('/auth/github/callback', function () {
    $user = Socialite::driver('github')->user();
    dd($user);
});
