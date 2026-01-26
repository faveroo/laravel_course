@extends('layouts.main')
@section('content')
<div class="max-w-7xl mx-auto px-6 pb-24">
    <header class="mb-8">
        <div class="flex justify-between">
            <a href="{{ route('home') }}" class="text-blue-400 hover:text-blue-300 text-sm mb-4 inline-block">← Voltar</a>
            <button type="button" class="bg-sky-400 w-1/5 rounded-xl border border-slate-700 hover:bg-sky-300 hover:cursor-pointer">Criar Tarefa</button>
            <!-- <button class="flex-1">Botão</button> -->
        </div>
        <h1 class="text-4xl font-bold text-white tracking-tight">
            Kanban Board
        </h1>
        <p class="text-slate-400 mt-3 text-sm">Organize suas tarefas em colunas</p>
    </header>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- TO DO -->
        <div class="bg-slate-950 border border-slate-800 rounded-lg p-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-3 h-3 rounded-full bg-blue-500"></div>
                <h2 class="text-lg font-bold text-white">
                    A Fazer
                </h2>
            </div>
            <div class="space-y-3 min-h-[80px]" data-status="pendente">
                @forelse ($pending as $p)
                <div class="kanban-item bg-slate-900 border border-slate-700 p-4 rounded-lg text-white hover:border-slate-600 transition-colors cursor-grab active:cursor-grabbing" data-id="{{ $p->id }}">
                    <div class="flex items-center gap-3">
                        <p class="text-sm flex-1">
                            {{ $p->description }}
                        </p>

                        <div class="w-6 h-6 rounded-sm bg-slate-800 flex items-center justify-center text-[9px] font-bold text-slate-400" title="{{ $p->assignedTo->name }}">
                            {{ substr($p->assignedTo->name, 0, 1) }}
                        </div>
                    </div>
                </div>
                @empty
                <div class="space-y-3">
                    <div data-empty class=" kanban-empty border border-slate-700 p-4 flex justify-center rounded-lg hover:border-slate-600 transition-colors cursor-grab active:cursor-grabbing text-slate-400">
                        <p class="text-sm">Não há tarefas pendentes</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>

        <!-- PENDING -->
        <div class="bg-slate-950 border border-slate-800 rounded-lg p-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-3 h-3 rounded-full bg-yellow-500"></div>
                <h2 class="text-lg font-bold text-white">
                    Em Progresso
                </h2>
            </div>

            <div class="space-y-3 min-h-[80px]" data-status="em_andamento">
                @forelse($going as $g)
                <div class="kanban-item bg-slate-900 border border-slate-700 p-4 rounded-lg text-white hover:border-slate-600 transition-colors cursor-grab active:cursor-grabbing" data-id="{{ $g->id }}">
                    <div class="flex items-center gap-3">
                        <p class="text-sm flex-1">
                            {{ $g->description }}
                        </p>

                        <div class="w-6 h-6 rounded-sm bg-slate-800 flex items-center justify-center text-[9px] font-bold text-slate-400" title="{{ $g->assignedTo->name }}">
                            {{ substr($g->assignedTo->name, 0, 1) }}
                        </div>
                    </div>
                </div>
                @empty
                <div class="space-y-3">
                    <div data-empty class="kanban-empty border border-slate-700 p-4 flex justify-center rounded-lg hover:border-slate-600 transition-colors cursor-grab active:cursor-grabbing text-slate-400">
                        <p class="text-sm">Não há tarefas em andamento</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>

        <!-- FINISHED -->
        <div class="bg-slate-950 border border-slate-800 rounded-lg p-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-3 h-3 rounded-full bg-emerald-500"></div>
                <h2 class="text-lg font-bold text-white">
                    Concluído
                </h2>
            </div>
            <div class="space-y-3 min-h-[80px]" data-status="concluida">
                @forelse ($finished as $f)
                <div class="kanban-item bg-slate-900 border border-slate-700 p-4 rounded-lg text-slate-400 line-through opacity-60 hover:border-slate-600 transition-colors cursor-grab active:cursor-grabbing" data-id="{{ $f->id }}">
                    <div class="flex items-center gap-3">
                        <p class="text-sm flex-1">{{ $f->description }}</p>

                        <div class="w-6 h-6 rounded-sm bg-slate-800 flex items-center justify-center text-[9px] font-bold text-slate-400" title="{{ $f->assignedTo->name }}">
                            {{ substr($f->assignedTo->name, 0, 1) }}
                        </div>
                    </div>
                </div>
                @empty
                <div class="space-y-3">
                    <div data-empty class="kanban-empty border border-slate-700 p-4 flex justify-center rounded-lg hover:border-slate-600 transition-colors cursor-grab active:cursor-grabbing text-slate-400">
                        <p class="text-sm">Não há tarefas concluídas</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>

    </div>
</div>


@endsection