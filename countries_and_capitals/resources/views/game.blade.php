<x-main-layout title="Game">
    <div class="container">

        <x-question
            currentQuestion="{{ $current_question }}"
            totalQuestions="{{ $total_questions }}"
            country="{{ $country }}" />

        <div class="row">
            @foreach($answers as $capital)
            <x-answer capital={{$capital}} />
            @endforeach
        </div>

    </div>

    <!-- cancel game -->
    <div class="text-center mt-5">
        <a href="{{ route('game.start') }}" class="btn btn-outline-danger mt-3 px-5">CANCELAR JOGO</a>
    </div>
</x-main-layout>