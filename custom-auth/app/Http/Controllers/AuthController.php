<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'min:3', 'max:30', 'exists:users,email'],
            'password' => ['min:6', 'max:255', 'required']
        ]);

        dd($credentials);
    }

    public function register()
    {
        return "ok";
    }
}
