<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'transaction.description' => 'required',
                'transaction.amount' => ['required', 'numeric', 'min:0.01'],
                'transaction.category_id' => 'required|exists:categories,id',
                'transaction.type' => 'required|in:income,expense',
            ],
            [
                'transaction.description.required' => 'A descrição é obrigatória',
                'transaction.amount.required' => 'O valor é obrigatório',
                'transaction.amount.numeric' => 'O valor deve ser um número',
                'transaction.amount.min' => 'O valor deve ser maior que 0',
                'transaction.category_id.required' => 'A categoria é obrigatória',
                'transaction.category_id.exists' => 'A categoria não existe',
                'transaction.type.required' => 'O tipo é obrigatório',
                'transaction.type.in' => 'O tipo deve ser income ou expense',
            ]
        );

        if (
            $request->transaction['type'] === 'expense' &&
            $request->transaction['category_id'] == 1
        ) {
            return back()->withErrors([
                'transaction.category_id' => 'Salary cannot be selected as an expense',
            ])->withInput();
        }

        Transaction::create([
            'description' => $request->transaction['description'],
            'amount' => $request->transaction['amount'],
            'category_id' => $request->transaction['category_id'],
            'type' => $request->transaction['type'],
            'date' => Carbon::now(),
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('dashboard')->with('success', 'Transaction created successfully');
    }

    public function show($id)
    {
        $transaction = Transaction::findOrFail($id);
        dd($transaction);
    }
}
