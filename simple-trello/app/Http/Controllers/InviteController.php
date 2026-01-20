<?php

namespace App\Http\Controllers;

use App\Mail\ProjectInvitationMail;
use App\Models\Project;
use App\Models\ProjectInvitation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class InviteController extends Controller
{
    public function invite(Request $request)
    {
        $request->validate([
            'project_id' => ['required'],
            'email' => [
                'email', 
                'required', 
                Rule::exists('users', 'email'),
                Rule::notIn([Auth::user()->email]),
                Rule::unique('project_invitations')
                    ->where('project_id', $request->project_id)
            ]
        ],
        [
            'email.unique' => 'This Email has already been invited'
        ]);

        if(Project::where('users.id', Auth::id())->exists()) {

        }

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

        return back()
            ->with('success', 'Você entrou no projeto!');
    }
}
