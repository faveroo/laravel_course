@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="row bg-black text-white">
        <div class="col align-content-center">
            <p class="display-6">{{ config('app.name') }}</p>
        </div>
        <div class="col d-flex justify-content-end align-items-center gap-5 p-3">
            <span>Usuário: <strong class="text-info">
                    {{ auth()->user()->name }}
                    <span class="ms-3 opacity-50">{{ auth()->user()->email }}</span>
                </strong></span>

            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col text-center">

            <span class="display-3">PÁGINA INICIAL</span>

            <hr>

            <a href="{{ route('contacts') }}">PÁGINA CONTATOS</a>

        </div>
    </div>
</div>
@endsection