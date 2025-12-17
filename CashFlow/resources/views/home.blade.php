@extends('layouts.main')

@section('content')
<section class="bg-dark min-vh-100 d-flex align-items-center">
    <div class="container">
        <div class="auth-container {{ old('form_type') == 'register' ? 'active' : '' }}">

            <div class="form-wrapper login">
                <x-auth.login-form />
            </div>

            <div class="form-wrapper register">
                <x-auth.register-form />
            </div>

            <div class="overlay-container">
                <div class="overlay">
                    <x-auth.panel />
                </div>
            </div>

        </div>
    </div>
</section>
<script>
    const container = document.querySelector('.auth-container');

    function showRegister() {
        container.classList.add('active');
    }

    function showLogin() {
        container.classList.remove('active');
    }
</script>
@endsection