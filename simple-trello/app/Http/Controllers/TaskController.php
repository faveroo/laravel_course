<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function updateStatus(Request $request, Task $task)
    {   
        $request->validate([
            'status' => 'required|in:pendente,em_andamento,concluida',
        ]);

        $task->status = $request->status;
        $task->save();

        return response()->json(['success' => true]);
    }
}
