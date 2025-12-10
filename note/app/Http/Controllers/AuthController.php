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
            'text_username' => 'required|email|max:255',
            'text_password' => 'required|min:6|max:30',
        ], [
            'text_username.required' => 'O campo username é obrigatório',
            'text_username.email' => 'O campo username deve ser um email',
            'text_username.max' => 'O campo username deve ter no máximo 255 caracteres',
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
        session()->put('user', [
            'id' => $user->id,
            'username' => $user->username,
        ]);

        echo "Login efetuado com sucesso";
        // return redirect()->route('home');
    }

    public function logout()
    {
        session()->forget('user');
        return redirect()->route('index');
    }
}
