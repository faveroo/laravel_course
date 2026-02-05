<x-layouts.main-layout :pageTitle="'Bem-vindo'">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card p-5">
                    <h2 class="text-center mb-4">Bem-vindo, {{ $username }}!</h2>
                    <p class="text-center">Seu cadastro foi confirmado com sucesso!</p>
                    <a href="{{ route('home') }}" class="btn btn-primary mt-4">OK</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main-layout>