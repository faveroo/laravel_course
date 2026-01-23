<?php

namespace App\Http\Controllers;

use App\Mail\ProjectInvitationMail;
use App\Models\Project;
use App\Models\ProjectInvitation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class InviteController extends Controller
{
    public function invite(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'invite_type' => ['required', Rule::in(['auto', 'manual'])],
                'project_id'  => ['required', 'exists:projects,id'],
                'email'       => [
                    'required',
                    'email',
                    Rule::exists('users', 'email'),
                    Rule::notIn([Auth::user()->email]),
                    Rule::unique('project_invitations')
                        ->where('project_id', $request->project_id),
                ],
            ]
        );

        if ($validator->fails()) {
            $modal = $request->invite_type === 'auto' ? 'inviteProjectModal' : 'inviteModal';

            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('open_modal', $modal);
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
