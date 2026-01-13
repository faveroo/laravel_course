@extends('layouts.main')

@section('content')
<div class="container mt-5" data-bs-theme="dark">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card p-4 text-white">
                <h1 class="text-center mb-4">Registro</h1>

                <form action="{{ route('register') }}" method="post">
                    @csrf

                    <x-form.input
                        name="name"
                        label="Name"
                        placeholder="Type your name" />

                    <x-form.input
                        name="email"
                        type="email"
                        label="E-mail"
                        placeholder="Type your E-mail" />

                    <x-form.input
                        name="password"
                        type="password"
                        label="*"
                        placeholder="Password" />

                    <x-form.input
                        name="password_confirmation"
                        type="password"
                        label="*"
                        placeholder="Confirm your password" />

                    <div class="input-group mt-4">
                        <button type="submit" class="form-control btn btn-primary">Registrar</button>
                    </div>
                </form>
                <a href="{{ route('login') }}" class="text-white text-center mt-2">Já tem conta?</a>
            </div>
        </div>
    </div>
</div>
@endsection