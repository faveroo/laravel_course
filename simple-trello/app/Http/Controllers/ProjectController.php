<?php

namespace App\Http\Controllers;

use App\Mail\ProjectInvitationMail;
use App\Models\Project;
use App\Models\ProjectInvitation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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
        $request->validate([
            'project_id' => ['required'],
            'email' => [
                'email', 
                'required', 
                Rule::exists('users', 'email'),
                Rule::notIn([Auth::user()->email])
            ]
        ]);

        $invitation = ProjectInvitation::create([
            'project_id' => $request->project_id,
            'invited_by' => Auth::user()->id,
            'email' => $request->email,
            'token' => Str::uuid()
        ]);

        Mail::to($request->email)
            ->send(new ProjectInvitationMail($invitation));

        return back()->with('success', 'Convite enviado com sucesso!');
    }

    public function accept(string $token)
    {
        $invitation = ProjectInvitation::where('token', $token)
            ->whereNull('accepted_at')
            ->firstOrFail();
        
        abort_if(Auth::user()->email !== $invitation->email, 403);

        $invitation->project->users()->attach(Auth::id());
        $invitation->update(['accepted_at' => Carbon::now()]);

        return redirect()->route('home')
            ->with('success', 'Você entrou no projeto!');
    }
}
