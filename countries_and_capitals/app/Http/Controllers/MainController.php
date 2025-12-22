<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Services\CountryService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    private $country_data;

    public function __construct(
        CountryService $country
    ) {
        $this->country_data = $country->all();
    }

    public function startGame(): View
    {
        return view('home');
    }

    public function prepareGame(Request $request)
    {
        $request->validate([
            'total_questions' => ['required', 'min:3', 'max:30', 'integer']
        ], [
            'total_questions.required' => 'A quantidade de perguntas é obrigatória',
            'total_questions.min' => 'A quantia mínima de perguntas é :min',
            'total_questions.max' => 'A quantia máxima de perguntas é :max',
            'total_questions.integer' => 'A quantia deve ser um número inteiro'
        ]);

        $total = intval($request->total_questions);

        //quiz structure - prepare
        $quiz = $this->prepareQuiz($total);

        dd($quiz);
    }


    private function prepareQuiz(int $total) {}
}
