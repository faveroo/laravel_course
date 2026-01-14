<h2>Você foi convidado para um projeto</h2>

<p>
    {{ $invitation->inviter->name }}
    convidou você para participar do projeto
    <strong>{{ $invitation->project->name }}</strong>.
</p>

<a href="{{ route('invitation.accept', $invitation->token) }}">
    Aceitar convite
</a>
