<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class GameController extends Controller
{
    public function game(): View
    {
        return view('game.index');
    }
}
