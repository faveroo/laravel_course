@extends('../layouts.main_layout')

@section('content')
<div class="bg-dark-surface border border-dark-border rounded-xl p-5 shadow-md max-w-md mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-4">Login</h1>
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="relative mb-4">
            <input
                type="email"
                name="email"
                id="email"
                placeholder="  "
                class="peer w-full px-4 py-2 rounded-lg bg-gray-200 text-gray-700
               focus:outline-none"
                required>

            <label
                for="email"
                class="absolute left-4 top-2 text-gray-500 text-sm
               transition-all
               peer-placeholder-shown:top-2
               peer-placeholder-shown:text-base
               peer-placeholder-shown:text-gray-400
               peer-focus:-top-3
               peer-focus:text-sm
               peer-focus:text-gray-600
               peer-not-placeholder-shown:-top-3
               peer-not-placeholder-shown:text-sm
               peer-not-placeholder-shown:text-gray-600
               ">
                Email
            </label>
            @error('email')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>
        <div class="relative mb-4">
            <input
                type="password"
                name="password"
                id="password"
                placeholder="  "
                class="peer w-full px-4 py-2 rounded-lg bg-gray-200 text-gray-700
               focus:outline-none"
                required>

            <label
                for="password"
                class="absolute left-4 top-2 text-gray-500 text-sm
               transition-all
               peer-placeholder-shown:top-2
               peer-placeholder-shown:text-base
               peer-placeholder-shown:text-gray-400
               peer-focus:-top-3
               peer-focus:text-sm
               peer-focus:text-gray-600
               peer-not-placeholder-shown:-top-3
               peer-not-placeholder-shown:text-sm
               peer-not-placeholder-shown:text-gray-600">
                Password
            </label>
            @error('password')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>



        <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Login</button>

        <div class="flex justify-center mt-3">
            <span>Don't have an account? </span>
            <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-700 ml-2"> Register</a>
        </div>
    </form>
</div>
@endsection