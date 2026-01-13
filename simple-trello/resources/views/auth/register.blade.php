@extends('layouts.main')

@section('content')
<div class="container mt-5" data-bs-theme="dark">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card p-4 text-white">
                <h1 class="text-center mb-4">Registro</h1>

                <form action="{{ route('login') }}" method="post">
                    @csrf

                    <div class="input-group mb-3">
                        <span class="input-group-text">Name</span>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control"
                            placeholder="Name"
                            aria-describedby="name">
                    </div>

                    <div class="input-group mt-3">
                        <span class="input-group-text">@</span>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control"
                            placeholder="E-mail"
                            aria-describedby="email">
                    </div>

                    @error('email')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                    @enderror

                    <div class="input-group mt-3">
                        <span class="input-group-text">*</span>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            placeholder="Senha"
                            aria-describedby="password">
                    </div>

                    <div class="input-group mt-3">
                        <span class="input-group-text">*</span>
                        <input
                            type="password"
                            name="password_confirmation"
                            id="password"
                            class="form-control"
                            placeholder="Confirme a senha"
                            aria-describedby="password">
                    </div>

                    <div class="input-group mt-5 mb-2">
                        <button type="submit" class="form-control btn btn-primary">Registrar</button>
                    </div>
                </form>
                <a href="{{ route('login') }}" class="text-white text-center mt-2">Já tem conta?</a>
            </div>
        </div>
    </div>
</div>
@endsection