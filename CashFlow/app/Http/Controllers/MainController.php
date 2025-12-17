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

        return view('dashboard', compact('transactions', 'categories'));
    }
}
