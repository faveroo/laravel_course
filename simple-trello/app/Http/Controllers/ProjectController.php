<?php

namespace App\Http\Controllers;

use App\Mail\ProjectInvitationMail;
use App\Models\Project;
use App\Models\ProjectInvitation;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use League\CommonMark\Extension\DescriptionList\Node\Description;

class ProjectController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => ['required', 'min:5', 'max:100'],
                'description' => ['required']
            ]
        );

        if($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('open_modal', 'createProject');
        }

        $owner_id = Auth::user()->id;

        $data["owner_id"] = $owner_id;

        Project::create($data);
        return redirect()
            ->route('home')
            ->with('success', 'Projeto Criado');
    }

    public function list()
    {
        $projects = User::find(Auth::id())->projects;
        
        return view('projects', compact('projects'));
    }

    public function index(string $hash)
    {
        try {
            $id = Crypt::decrypt($hash);
        } catch (\Exception $e) {
            abort(403, 'ID inválido');
        }

        $pending = Task::with('assignedTo')
            ->where('project_id', $id)
            ->pendentes()
            ->get();
        
        $going = Task::with('assignedTo')
            ->where('project_id', $id)
            ->emAndamento()
            ->get();

        $finished = Task::with('assignedTo')
            ->where('project_id', $id)
            ->concluidas()
            ->get();

        return view('project.project', compact('pending', 'going', 'finished'));
    }
}
