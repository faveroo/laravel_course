<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MainController extends Controller
{
    public function home(): View
    {
        $user = Auth::user();

        // Projects owned by the user
        $ownedProjects = $user->ownedProjects()->with(['tasks', 'users'])->get();

        // Projects the user is participating in (excluding those they own)
        $participatingProjects = $user->projects()
            ->where('owner_id', '!=', $user->id)
            ->with(['owner', 'tasks']) // Eager load owner and tasks
            ->get();

        // Pending tasks assigned to the user
        $pendingTasks = $user->assignedTasks()
            ->whereIn('status', ['pendente', 'em_andamento'])
            ->with('project')
            ->orderBy('status', 'desc') // Show 'em_andamento' first
            ->get();

        return view('home', compact('ownedProjects', 'participatingProjects', 'pendingTasks'));
    }
}
