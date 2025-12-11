<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'text_username' => 'required|email|max:50',
            'text_password' => 'required|min:6|max:30',
        ], [
            'text_username.required' => 'O campo username é obrigatório',
            'text_username.email' => 'O campo username deve ser um email',
            'text_username.max' => 'O campo username deve ter no máximo :max caracteres',
            'text_password.required' => 'O campo senha é obrigatório',
            'text_password.min' => 'O campo senha deve ter no mínimo :min caracteres',
            'text_password.max' => 'O campo senha deve ter no máximo :max caracteres',
        ]);

        $username = $request->text_username;
        $password = $request->text_password;

        $user = User::where('username', $username)
            ->where('deleted_at', NULL)
            ->first();

        if (!$user) {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'login_error' => 'Usuário ou senha inválidos',
                ]);
        }

        // checking password

        if (!password_verify($password, $user->password)) {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'login_error' => 'Usuário ou senha inválidos',
                ]);
        }

        // update last_login 
        $user->last_login = now();
        $user->save();

        //user login
        session()->put('user', (object)[
            'id' => $user->id,
            'username' => $user->username,
        ]);

        return redirect()->route('home');
    }

    public function index()
    {
        return view('login');
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->to('/login')->with([
            'logout_success' => 'Logout efetuado com sucesso',
        ]);
    }
}
