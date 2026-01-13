@extends('layouts.main')

@section('content')
<div class="container mt-5" data-bs-theme="dark">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card p-4 text-white">
                <h1 class="text-center mb-4">Login</h1>

                <form action="{{ route('login') }}" method="post">
                    @csrf

                    <div class="input-group mb-3">
                        <span class="input-group-text">@</span>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            class="form-control"
                            placeholder="E-mail"
                            aria-describedby="email">
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text">*</span>
                        <input
                            type="password"
                            name="password"
                            id="password"
                            class="form-control"
                            aria-describedby="password">
                    </div>

                    <div class="input-group mt-5 mb-2">
                        <button type="submit" class="form-control btn btn-primary">Logar</button>
                    </div>
                </form>
                <a href="{{ route('register') }}" class="text-white text-center mt-2">Ainda não tem conta?</a>
            </div>
        </div>
    </div>
</div>
@endsection