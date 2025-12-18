<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
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
        $credentials = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O campo email deve ser um email válido.',
                'password.required' => 'O campo senha é obrigatório.',
            ]
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('game.index');
        }

        return back()->withErrors([
            'email' => 'Credenciais inválidas.',
        ])->onlyInput('email');
    }

    public function register(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): View|RedirectResponse
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'name.required' => 'O campo nome é obrigatório.',
                'email.required' => 'O campo email é obrigatório.',
                'email.email' => 'O campo email deve ser um email válido.',
                'email.unique' => 'O email já está cadastrado.',
                'password.required' => 'O campo senha é obrigatório.',
            ]
        );

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return view('game.index');
    }
}
