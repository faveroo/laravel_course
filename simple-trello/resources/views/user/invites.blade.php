@extends('layouts.main')

@section('content')
<section>
    <div class="max-w-7xl mx-auto px-6 pb-24">
        <header class="mb-16">
            <h1 class="text-3xl font-light text-slate-100 tracking-tight">
                Convites
            </h1>
            <p class="text-slate-500 mt-2 text-sm uppercase tracking-widest font-medium">
                Convites recebidos para participar de projetos
            </p>
        </header>

        <div class="bg-slate-950 p-8 rounded-sm">
            @if($invites->isEmpty())
                <p class="text-slate-600 italic">
                    Você não recebeu nenhum convite.
                </p>
            @else
                <ul class="space-y-6">
                    @foreach($invites as $invite)
                        @php
                            $accepted = !is_null($invite->accepted_at);
                        @endphp

                        <li class="border border-slate-800 p-6 rounded-sm transition-colors">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h2 class="text-lg font-semibold text-white">
                                        {{ $invite->project->name ?? 'Projeto removido' }}
                                    </h2>

                                    <p class="text-slate-500 text-sm">
                                        Convidado por {{ $invite->inviter->name ?? 'Sistema' }}
                                    </p>

                                    <p class="text-xs mt-1">
                                        <span class="px-2 py-1 rounded-sm
                                            {{ $accepted ? 'bg-emerald-900 text-emerald-300' : 'bg-yellow-900 text-yellow-300' }}">
                                            {{ $accepted ? 'Aceito' : 'Pendente' }}
                                        </span>
                                    </p>
                                </div>

                                {{-- Ações --}}
                                <div>
                                    @if(!$accepted)
                                        <a
                                            href="{{ route('invitation.accept', $invite->token) }}"
                                            class="inline-flex items-center px-4 py-2 text-sm font-medium text-decoration-none
                                                   bg-emerald-600 hover:bg-emerald-500
                                                   text-white rounded-sm transition-colors">
                                            Aceitar convite
                                        </a>
                                    @else
                                        <span class="text-slate-500 text-sm italic">
                                            Convite já aceito
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</section>
@endsection
