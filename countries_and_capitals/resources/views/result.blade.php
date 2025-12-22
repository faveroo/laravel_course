<x-main-layout title="Result">
    <x-question
        currentQuestion="{{ $current_question }}"
        totalQuestions="{{ $total_questions }}"
        country="{{ $country }}" />

    <div class="text-center fs-3 mb-3">
        Resposta correta: <span class="text-info">{{ $correct_answer }} </span>
    </div>

    <div class="text-center fs-3 mb-3">
        A sua resposta: <span class="[conditional]">{{ $choice_answer }}</span>
    </div>

    <div class="text-center mt-5">
        <a href="{{ route('game.next') }}" class="btn btn-primary mt-3 px-5">AVANÇAR</a>
    </div>
</x-main-layout>