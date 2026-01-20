<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('auth.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'username' => ['required', 
                            'min:3', 
                            'max:30', ],
            'password' => ['required', 
                            Password::min(6)
                                    ->letters()
                                    ->numbers()]
        ],
        [
            'username.required' => 'O usuário é obrigatório.',
            'username.min' => 'O usuário deve ter no mínimo :min caracteres.',
            'username.max' => 'O usuário deve ter no máximo :max caracteres.',
            'password.required' => 'A senha é obrigatória.',
        ]
        );

        $user = User::where('username', $credentials['username'])
                    ->active()
                    ->verified()
                    ->notBlocked()
                    ->first();

        if(!$user) {
            return back()->withInput()->withErrors([
                'invalid_login' => 'Login inválido.'
            ]);
        }

        if(!password_verify($credentials['password'], $user->password)) {
            return back()->withInput()->withErrors([
                'invalid_login' => 'Login inválido'
            ]);
        }

        $user->last_login = now();
        $user->blocked_until = null;
        $user->save();

        $request->session()->regenerate();
        Auth::login($user);

        return redirect()->intended(route('home'));
    }

    public function register(): View
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate(
            [
                'username' => ['required', 'min:3', 'max:30', 'unique:users'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required', Password::min(6)
                                                   ->letters()
                                                   ->numbers()
                                                   ->symbols(), 
                                                   'confirmed']
            ]
        );

        dd($credentials);
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
