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


    private function prepareQuiz(int $total)
    {
        $questions = [];
        $countries_t = count($this->country_data);

        $idx = range(0, $countries_t - 1);
        shuffle($idx);
        $idx = array_slice($idx, 0, $total);

        $number = 1;
        foreach ($idx as $i) {
            $question['number'] = $number++;
            $question['country'] = $this->country_data[$i]['country'];
            $question['answer'] = $this->country_data[$i]['capital'];

            $other_capitals = array_column($this->country_data, 'capital');

            // remove correct answer
            $other_capitals = array_diff($other_capitals, [$question['answer']]);

            shuffle($other_capitals);

            $question['wrong'] = array_slice($other_capitals, 0, 3);

            $question['correct'] = null;

            $questions[] = $question;
        }

        return $questions;
    }
}
