@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5 card p-5">
            <form action="{{ route('password.email') }}" method="post">
                @csrf
                <p class="display-6 text-center">RECUPERAR A SENHA</p>
                <div class="mb-3">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control">
                </div>

                <div class="mt-4 d-flex justify-content-between">
                    <div>
                        <a href="{{ route('login') }}">Já sei a minha senha</a>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-secondary px-5">RECUPERAR SENHA</button>
                    </div>
                </div>
            </form>
            @if($errors->any())
            <div class="alert alert-danger mt-4">
                <ul class="m-0">
                    @foreach($errors->all() as $err)
                    <li>
                        {{ $err }}
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection