@extends('layouts.main')
@section('content')
<div class="max-w-7xl mx-auto px-6 pb-24">
    <header class="mb-16">
        <h1 class="text-4xl font-bold text-white tracking-tight">
            Meus Projetos
        </h1>
        <p class="text-slate-400 mt-3 text-sm">Todos os projetos em que você trabalha</p>
    </header>

    @if($projects->isEmpty())
    <div class="bg-slate-900 border border-slate-800 rounded-lg p-12 text-center">
        <p class="text-slate-400">Você não tem nenhum projeto ainda.</p>
    </div>
    @else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($projects as $project)
        <a href="{{ route('project.show', Crypt::encrypt($project->id)) }}" class="group">
            <div class="bg-slate-950 border border-slate-800 hover:border-slate-700 rounded-lg p-6 transition-all hover:shadow-lg h-full flex flex-col">
                <h3 class="text-lg font-bold text-white group-hover:text-blue-400 transition-colors mb-2">
                    {{ $project->name }}
                </h3>

                <p class="text-slate-400 text-sm leading-relaxed mb-6 flex-grow line-clamp-2">
                    {{ $project->description ?: 'Sem descrição.' }}
                </p>

                <div class="flex items-center justify-between pt-6 border-t border-slate-800">
                    <div class="flex gap-2">
                        @forelse($project->users->take(4) as $u)
                        <div class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center text-xs font-bold text-slate-300 border border-slate-700" title="{{ $u->name }}">
                            {{ substr($u->name, 0, 1) }}
                        </div>
                        @empty
                        @endforelse
                        @if($project->users->count() > 4)
                        <div class="w-8 h-8 rounded-lg bg-slate-800 flex items-center justify-center text-xs font-bold text-slate-300 border border-slate-700">
                            +{{ $project->users->count() - 4 }}
                        </div>
                        @endif
                    </div>
                    <span class="text-xs font-mono text-slate-500">{{ $project->tasks->count() }} TAREFAS</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    @endif
</div>
@endsection
