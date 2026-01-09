@extends('layouts.main')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col">
            <p class="display-6 text-info">Está página está acessível para usuários logados e não logados</p>

            <hr>

            @auth
            <p class="display-6 text-success">Este texto só vai ser apresentado a usuários logados</p>
            @else
            <p class="display-6 text-warning">Este texto só vai ser apresentado a usuários visitantes</p>
            @endauth

        </div>
    </div>
</div>

@endsection