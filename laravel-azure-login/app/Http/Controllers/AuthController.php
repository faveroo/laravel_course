<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function auth()
    {
        return Socialite::driver('microsoft')->redirect();
    }

    public function callback()
    {
        $microsoftUser = Socialite::driver('microsoft')->stateless()->user();

        $graphUser = $microsoftUser->user;
        $email = $graphUser['mail'] ?? $graphUser['userPrincipalName'];

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $graphUser['displayName'],
                'microsoft_id' => $graphUser['id'],
                'email_verified_at' => now(),
                'password' => Hash::make(Str::random(32)),
            ]
        );

        // Atualiza dados corporativos a cada login
        logger($graphUser);
        $user->update([
            'department' => $graphUser['department'] ?? null,
            'job_title' => $graphUser['jobTitle'] ?? null,
        ]);


        $user->syncRoles(
            $user->department === 'Tecnologia da Informação' ? ['admin'] : ['user']
        );

        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
