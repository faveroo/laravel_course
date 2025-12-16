<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use SplFileObject;

class MainController extends Controller
{
    public function home(): View
    {
        if (session()->has('exercises')) {
            session()->forget('exercises');
        }
        return view('home');
    }

    public function generateExercises(Request $request)
    {
        $request->validate([
            'check_sum' => 'required_without_all:check_subtraction,check_multiplication,check_division',
            'check_subtraction' => 'required_without_all:check_sum,check_multiplication,check_division',
            'check_multiplication' => 'required_without_all:check_sum,check_subtraction,check_division',
            'check_division' => 'required_without_all:check_sum,check_subtraction,check_multiplication',
            'number_one' => 'required|integer|min:0|max:999|lt:number_two',
            'number_two' => 'required|integer|min:0|max:999|gt:number_one',
            'number_exercises' => 'required|integer|min:5|max:50',
        ]);

        $operations = [];
        $operations[] = $request->check_sum ? 'sum' : null;
        $operations[] = $request->check_subtraction ? 'subtraction' : null;
        $operations[] = $request->check_multiplication ? 'multiplication' : null;
        $operations[] = $request->check_division ? 'division' : null;
        $operations = array_filter($operations);

        $min = $request->number_one;
        $max = $request->number_two;

        $numberExercises = $request->number_exercises;

        //generetion of exercises
        $exercises = [];
        for ($i = 1; $i <= $numberExercises; $i++) {
            $exercises[] = $this->generateExercise($i, $operations, $min, $max);
        }

        session()->put('exercises', $exercises);

        return view('operations', compact('exercises'));
    }

    public function printExercises()
    {
        if (!session()->has('exercises')) {
            return redirect()->route('home');
        }

        $exercises = session()->get('exercises');

        echo '<pre>';
        echo '<h1>Exercícios de matemática (' . env('APP_NAME') . ')</h1>';
        echo '<hr>';

        foreach ($exercises as $exercise) {
            echo '<h2><small>' . $exercise['exercise_number'] . ' >> </small> ' . $exercise['exercise'] . '</h2>';
        }

        echo "<hr>";
        echo "<h2>Respostas</h2>";

        foreach ($exercises as $exercise) {
            echo '<small>' . $exercise['exercise_number'] . ' >> ' . $exercise['sollution'] . '</small><br>';
        }
    }

    public function exportExercises()
    {
        if (!session()->has('exercises')) {
            return redirect()->route('home');
        }

        $exercises = session()->get('exercises');

        // create download file
        $filename = 'exercises_' . env('APP_NAME') . '_' . date('YmdHis') . '.txt';

        $content = '';
        foreach ($exercises as $exercise) {
            $content .= $exercise['exercise_number'] . ' >> ' . $exercise['exercise'] . "\n";
        }

        $content .= "\n";
        $content .= "Respostas\n" . str_repeat('=', 30) . "\n";
        $content .= "\n";

        foreach ($exercises as $exercise) {
            $content .= $exercise['exercise_number'] . ' >> ' . $exercise['sollution'] . "\n";
        }

        return response($content)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    private function generateExercise($i, $operations, $min, $max)
    {
        $operation = $operations[\array_rand($operations)];
        $numberOne = \random_int($min, $max);
        $numberTwo = \random_int($min, $max);

        $exercise = '';
        $sollution = '';

        switch ($operation) {
            case 'sum':
                $exercise = $numberOne . ' + ' . $numberTwo;
                $sollution = $numberOne + $numberTwo;
                break;
            case 'subtraction':
                $exercise = $numberOne . ' - ' . $numberTwo;
                $sollution = $numberOne - $numberTwo;
                break;
            case 'multiplication':
                $exercise = $numberOne . ' x ' . $numberTwo;
                $sollution = $numberOne * $numberTwo;
                break;
            case 'division':

                if ($numberTwo == 0) {
                    $numberTwo = 1;
                }

                $exercise = $numberOne . ' ÷ ' . $numberTwo;
                $sollution = $numberOne / $numberTwo;
                break;
        }

        if (is_float($sollution)) {
            $sollution = number_format($sollution, 2);
        }

        return [
            'exercise_number' => str_pad($i, 2, '0', STR_PAD_LEFT),
            'exercise' => $exercise,
            'sollution' => "$exercise = $sollution",
        ];
    }
}
