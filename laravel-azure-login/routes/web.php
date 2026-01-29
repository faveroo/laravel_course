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

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/auth/github/callback', function () {
    $user = Socialite::driver('github')->user();
    dd($user);
    return redirect('/dashboard');
});

Route::get('/api/auth/microsoft', function () {
    return Socialite::driver('microsoft')->redirect();
})->name('auth.microsoft');

Route::get('/api/auth', function () {
    $user = Socialite::driver('microsoft')->stateless()->user();
    dd($user);
    return redirect('/dashboard');
});
