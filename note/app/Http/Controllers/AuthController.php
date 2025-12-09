<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }

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
            'text_password.min' => 'O campo senha deve ter no mínimo 6 caracteres',
            'text_password.max' => 'O campo senha deve ter no máximo 30 caracteres',
        ]);

        $username = $request->text_username;
        $password = $request->text_password;

        // DB test connection
        try {
            DB::connection()->getPdo();
            echo "Connection is OK!";
        } catch (\PDOException $e) {
            echo "Connection failed!";
        }
    }

    public function logout()
    {
        echo "logout";
    }
}
