<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'transaction.description' => 'required',
                'transaction.amount' => ['required', 'numeric', 'min:0.01'],
                'category_id' => 'required|exists:categories,id',
                'type' => 'required|in:income,expense',
            ],
            [
                'transaction.description.required' => 'A descrição é obrigatória',
                'transaction.amount.required' => 'O valor é obrigatório',
                'transaction.amount.numeric' => 'O valor deve ser um número',
                'transaction.amount.min' => 'O valor deve ser maior que 0',
                'category_id.required' => 'A categoria é obrigatória',
                'category_id.exists' => 'A categoria não existe',
                'type.required' => 'O tipo é obrigatório',
                'type.in' => 'O tipo deve ser income ou expense',
            ]
        );
    }
}
