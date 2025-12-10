<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\User;

class MainController extends Controller
{
    public function home()
    {
        $id = session('user')->id;
        $notes = User::find($id)->notes()->get()->toArray();

        return view('home', compact('notes'));
    }

    public function createNote() {}
}
