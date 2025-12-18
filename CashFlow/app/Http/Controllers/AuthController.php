<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login.email' => ['required', 'email'],
            'login.password' => ['required'],
        ], [
            'login.email.required' => 'The email field is required.',
            'login.email.email' => 'The email must be a valid email address.',
            'login.password.required' => 'The password field is required.',
        ]);

        $user = [
            'email' => $request->login['email'],
            'password' => $request->login['password'],
        ];

        if (Auth::attempt($user, $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'login.email' => 'The provided credentials do not match our records.',
        ])->onlyInput('login.email');
    }

    public function register(Request $request)
    {
        $request->validate([
            'register.name' => ['required', 'string', 'max:255'],
            'register.email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'register.password' => ['required', 'confirmed', 'min:8'],
            'register.password_confirmation' => ['required'],
        ], [
            'register.name.required' => 'The name field is required.',
            'register.email.required' => 'The email field is required.',
            'register.email.email' => 'The email must be a valid email address.',
            'register.email.unique' => 'The email has already been taken.',
            'register.password.required' => 'The password field is required.',
            'register.password.confirmed' => 'The password confirmation does not match.',
            'register.password.min' => 'The password must be at least :min characters.',
            'register.password_confirmation.required' => 'The password confirmation field is required.',
        ]);

        $user = User::create([
            'name' => $request->register['name'],
            'email' => $request->register['email'],
            'password' => Hash::make($request->register['password']),
        ]);

        Auth::login($user);

        return redirect()->intended('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
