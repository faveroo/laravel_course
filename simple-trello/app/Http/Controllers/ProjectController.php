<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Extension\DescriptionList\Node\Description;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'min:6', 'max:100'],
            'description' => ['required']
        ]);

        $owner_id = Auth::user()->id;

        $data["owner_id"] = $owner_id;

        Project::create($data);
        return redirect()
            ->route('home')
            ->with('success', 'Projeto Criado');
    }

    public function invite(Request $request)
    {
        $data = $request->validate([
            'email' => ['email']
        ]);
    }
}
