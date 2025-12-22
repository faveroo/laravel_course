<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Services\CountryService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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

        // store quiz in session
        session()->put([
            'quiz' => $quiz,
            'total_questions' => $total,
            'current_question' => 1,
            'correct_answers' => 0,
            'wrong_answers' => 0
        ]);

        return redirect()->route('game.game');
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
            $question['correct_answer'] = $this->country_data[$i]['capital'];

            $other_capitals = array_column($this->country_data, 'capital');

            // remove correct answer
            $other_capitals = array_diff($other_capitals, [$question['correct_answer']]);

            shuffle($other_capitals);

            $question['wrong_answers'] = array_slice($other_capitals, 0, 3);

            $question['correct'] = null;

            $questions[] = $question;
        }

        return $questions;
    }

    public function game(): View
    {
        $quiz = session('quiz');
        $total_questions = session('total_questions');
        $current_question = session()->get('current_question');
        $index = $current_question - 1;

        //prepare answer

        $answers = $quiz[$index]['wrong_answers'];
        $answers[] = $quiz[$index]['correct_answer'];
        shuffle($answers);

        return view('game')->with([
            'country' => $quiz[$index]['country'],
            'total_questions' => $total_questions,
            'current_question' => $current_question,
            'answers' => $answers
        ]);
    }

    public function answer($enc)
    {
        try {
            $decrypt = Crypt::decryptString($enc);
        } catch (Exception $e) {
            return redirect()->route('game');
        }

        $quiz = session()->get('quiz');
        $current_question = session()->get('current_question');
        $index = $current_question - 1;
        $correct_answer = $quiz[$index]['correct_answer'];
        $correct_answers = session()->get('correct_answers');
        $wrong_answers = session()->get('wrong_answers');

        if ($decrypt == $correct_answer) {
            $correct_answers++;
            $quiz[$index]['correct'] = true;
        } else {
            $wrong_answers++;
            $quiz[$index]['correct'] = false;
        }

        session()->put([
            'quiz' => $quiz,
            'correct_answers' => $correct_answers,
            'wrong_answers' => $wrong_answers,
            'current_question' => $current_question
        ]);

        $data = [
            'country' => $quiz[$index]['country'],
            'correct_answer' => $correct_answer,
            'choice_answer' => $decrypt,
            'current_question' => $current_question,
            'total_questions' => session()->get('total_questions')
        ];

        return view('result')->with($data);
    }

    public function next()
    {
        $current_question = session()->get('current_question');
        $total_questions = session()->get('total_questions');

        if ($current_question < $total_questions) {
            $current_question++;
            session()->put('current_question', $current_question);
            return redirect()->route('game.game');
        } else {
            return redirect()->route('game.show');
        }
    }

    public function showResults()
    {
        $total_questions = session()->get('total_questions');
        $correct_answers = session()->get('correct_answers');
        $wrong_answers = session()->get('wrong_answers');
        $percent = round($correct_answers / $total_questions * 100, 2);

        return view('final-result', compact("total_questions", "correct_answers", "wrong_answers", "percent"));
    }
}
