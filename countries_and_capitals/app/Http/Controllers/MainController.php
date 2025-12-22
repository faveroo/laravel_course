<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Services\CountryService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function startGame(): View
    {
        return view('home');
    }
}
