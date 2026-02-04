<?php

namespace App\Http\Controllers;

use App\Mail\NewUserConfirmation;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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
        $credentials = $request->validate(
            [
                'username' => [
                    'required',
                    'min:3',
                    'max:30',
                ],
                'password' => [
                    'required',
                    Password::min(6)
                        ->letters()
                        ->numbers()
                        ->symbols()
                        ->uncompromised(3)
                ]
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

        if (!$user) {
            return back()->withInput()->withErrors([
                'invalid_login' => 'Login inválido.'
            ]);
        }

        if (!password_verify($credentials['password'], $user->password)) {
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
                'password' => [
                    'required',
                    Password::min(6)
                        ->letters()
                        ->numbers()
                        ->symbols()
                        ->uncompromised(3),
                    'confirmed'
                ],
            ],
            [
                'username.required' => 'O usuário é obrigatório.',
                'username.min' => 'O usuário deve ter no mínimo :min caracteres.',
                'username.max' => 'O usuário deve ter no máximo :max caracteres.',
                'username.unique' => 'O usuário já existe.',
                'email.required' => 'O email é obrigatório.',
                'email.email' => 'O email é inválido.',
                'email.unique' => 'O email já existe.',
                'password.required' => 'A senha é obrigatória.',
                'password.confirmed' => 'As senhas não coincidem.',
            ]
        );

        $user = new User();
        $user->username = $credentials['username'];
        $user->email = $credentials['email'];
        $user->password = $credentials['password'];
        $user->token = Str::random(64);

        $result = Mail::to($user->email)->send(new NewUserConfirmation($user->username, route('confirm', $user->token)));

        if (!$result) {
            return back()->withInput()->withErrors([
                'email_error' => 'Erro ao enviar email de confirmação.'
            ]);
        }

        $user->save();
        return view('auth.email-sent', [
            'email' => $user->email
        ]);
    }

    public function confirm(string $token): RedirectResponse
    {
        $user = User::where('token', $token)->first();

        if (!$user) {
            return redirect()->route('login');
        }

        $user->verified_at = now();
        $user->token = null;
        $user->save();

        return redirect()->route('login')->with('success', 'Cadastro confirmado com sucesso!');
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
