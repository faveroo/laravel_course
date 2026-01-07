<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function auth()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function callback()
    {
        $azureUser = Socialite::driver('microsoft')->user();

        $user = User::firstOrCreate(
            [
                'email' => $azureUser->getEmail()
            ],
            [
                'name' => $azureUser->getName()
            ]
        );

        Auth::login($user);

        return redirect('/dashboard');
    }
}
