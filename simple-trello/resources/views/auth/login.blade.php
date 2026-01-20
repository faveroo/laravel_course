@extends('layouts.main')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-950 px-4">
    <div class="w-full max-w-md">
        <div class="bg-slate-900 border border-slate-800 rounded-lg p-8">
            <h1 class="text-2xl font-bold text-white text-center mb-8">Entrar</h1>

            <form action="{{ route('login') }}" method="post" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-slate-300 mb-2">E-mail</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-colors"
                        placeholder="seu@email.com"
                        required>
                    @error('email')
                    <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-300 mb-2">Senha</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="w-full bg-slate-800 border border-slate-700 rounded-lg px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-colors"
                        placeholder="••••••••"
                        required>
                    @error('password')
                    <p class="text-rose-400 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition-colors">
                    Entrar
                </button>
            </form>

            <p class="text-slate-400 text-center mt-6">
                Ainda não tem conta?
                <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 font-medium transition-colors">
                    Registre-se
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
