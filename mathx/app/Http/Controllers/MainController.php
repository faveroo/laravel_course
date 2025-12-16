<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function home(): View
    {
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

            $exercises[] = [
                'exercise_number' => $i,
                'exercise' => $exercise,
                'sollution' => "$exercise = $sollution",
            ];
        }

        return view('operations', compact('exercises'));
    }

    public function printExercises() {}

    public function exportExercises() {}
}
