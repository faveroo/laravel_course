<x-layouts.main-layout :pageTitle="'Email Enviado'">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card p-5">
                    <h2 class="text-center mb-4">Email Enviado</h2>
                    <p class="text-center">Um email foi enviado para <strong>{{ $email }}</strong> com um link para confirmar o seu cadastro.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary mt-4">Voltar para o login</a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main-layout>