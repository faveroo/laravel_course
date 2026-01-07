<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MainController extends Controller
{
    public function newPage(): View
    {
        return view('new-page');
    }

    public function tests(Request $request)
    {
        // auth user data
        // $id = auth()->user()->id;
        //or
        // $id2 = $request->user()->id;

        // name
        // echo auth()->user()->name;
    }

    public function publicPage()
    {
        return view('public-page');
    }
}
