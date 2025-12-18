<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function dashboard()
    {
        $transactions = Transaction::all();
        $categories = Category::all();
        $recents = Transaction::orderBy('created_at', 'desc')->take(5)->get();

        return view('dashboard', compact('transactions', 'categories', 'recents'));
    }
}
