<x-main-layout title="Countries & Capitals Quiz">
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-4 text-center">
                <form action="{{ route('game.prepare') }}" method="post">
                    @csrf
                    <div class="mt-3 mb-5">
                        <label for="total_questions" class="form-label display-6 mb-3">Número de perguntas:</label>
                        <input type="number" name="total_questions" id="total_questions" class="form-control form-control-lg text-center" min="3" max="30" value="10" required>
                        @error('total_questions')
                        <div class="text-danger text-center">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-5">INICIAR QUESTIONÁRIO</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-main-layout>