@extends('layouts.main')
@section('content')
<div class="max-w-7xl mx-auto px-6 pb-24">
    <header class="mb-16">
        <h1 class="text-3xl font-light text-slate-100 tracking-tight">
            Projetos
        </h1>
        <p class="text-slate-500 mt-2 text-sm uppercase tracking-widest font-medium">Lista de Projetos</p>
    </header>

        @foreach($projects as $project)
        <div class="bg-slate-950 p-8 hover:bg-slate-900 transition-colors group relative">
            <div class="flex justify-between items-start mb-6">
                <a href="{{ route('project.show', Crypt::encrypt($project->id)) }}" class="text-decoration-none">
                <h3 class="text-lg font-bold text-white group-hover:text-brand-accent transition-colors">{{ $project->name }}</h3>
                </a>
            </div>

            <p class="text-slate-500 text-sm leading-relaxed mb-8 h-10 line-clamp-2">{{ $project->description ?: 'Sem descrição.' }}</p>

            <div class="flex items-center justify-between border-t border-slate-900 pt-6">
                <div class="flex gap-1.5">
                    @foreach($project->users->take(4) as $u)
                    <div class="w-6 h-6 rounded-sm bg-slate-800 flex items-center justify-center text-[9px] font-bold text-slate-400" title="{{ $u->name }}">
                        {{ substr($u->name, 0, 1) }}
                    </div>
                    @endforeach
                </div>
                <span class="text-[10px] font-mono text-slate-600">{{ count($project->tasks) }} TASKS</span>
            </div> 
        </div>
        @endforeach
@endsection
