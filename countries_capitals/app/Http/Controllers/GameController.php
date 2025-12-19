<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use App\Models\Country;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function game(): View
    {
        $country = Country::all()->random();

        session([
            'correct' => $country->capital
        ]);

        return view('game.index', compact('country'));
    }

    public function check(Request $request)
    {
        $correct = session('correct');
        $user = $request->capital;

        // dd($correct, $user);

        if ($correct === $user) {
            return redirect()->route('game.index')->with('success', 'Correct!');
        }

        return redirect()->route('game.index')->with('error', 'Wrong! The correct answer is ' . $correct);
    }
}
