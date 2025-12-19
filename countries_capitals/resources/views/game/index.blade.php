@extends('../layouts.main_layout')

@section('content')
<div class="bg-white rounded-xl p-5 shadow-md max-w-md mx-auto mt-10">
    <h1 class="text-2xl font-bold mb-4">Jogo</h1>
    <form action="{{ route('game.check') }}" method="POST">
        @csrf
        <div>
            <img src="{{ asset('assets/flags/' . $country->flag) }}" alt="">
            <input class="w-full px-4 py-2 rounded-lg bg-gray-200 text-gray-700 focus:outline-none" type="text" name="capital" id="capital" placeholder="Capital">


            <div class="flex justify-center">
                <button type="submit" class="bg-blue-600 text-center text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Enviar</button>
            </div>

            @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif
        </div>
    </form>
</div>
@endsection