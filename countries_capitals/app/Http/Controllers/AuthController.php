<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class AuthController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }


    public function index(): View
    {
        return view('auth.index');
    }

    public function login(Request $request): RedirectResponse|View
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|min:8',
            ],
            [
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O campo email deve ser um email válido.',
                'password.required' => 'O campo senha é obrigatório.',
                'password.min' => 'O campo senha deve ter pelo menos 8 caracteres.',
            ]
        );

        if (User::where('email', $request->email)->exists()) {
            return view('game.index');
        }

        return back()->withErrors([
            'email' => 'Email not found.',
        ])->onlyInput('email');
    }

    public function register(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): View
    {


        return view('game.index');
    }
}
