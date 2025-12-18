@extends('layouts.main')

@section('content')
<section class="flex items-center justify-center min-h-[calc(100vh-4rem)] py-12 px-4 sm:px-6 lg:px-8">

    <!-- Auth Container -->
    <div class="auth-container relative bg-dark-surface rounded-2xl shadow-2xl overflow-hidden w-full max-w-[900px] min-h-[600px] group {{ old('form_type') == 'register' ? 'active' : '' }}">

        <!-- Login Form Wrapper -->
        <div class="absolute top-0 h-full w-1/2 p-12 transition-all duration-700 ease-in-out left-0 z-20 opacity-100 [.active_&]:translate-x-full [.active_&]:opacity-0 [.active_&]:z-10 bg-dark-surface">
            <x-auth.login-form />
        </div>

        <!-- Register Form Wrapper -->
        <div class="absolute top-0 h-full w-1/2 p-12 transition-all duration-700 ease-in-out left-0 opacity-0 z-10 translate-x-full [.active_&]:translate-x-full [.active_&]:opacity-100 [.active_&]:z-50 bg-dark-surface">
            <x-auth.register-form />
        </div>

        <!-- Overlay Container -->
        <div class="absolute top-0 left-1/2 w-1/2 h-full overflow-hidden transition-transform duration-700 ease-in-out z-[100] [.active_&]:translate-x-[-100%]">

            <!-- Overlay Background -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white relative -left-full h-full w-[200%] translate-x-0 transition-transform duration-700 ease-in-out [.active_&]:translate-x-1/2 bg-blue-600">

                <x-auth.panel />

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