@extends('layouts.main')
@section('content')
<div class="max-w-7xl mx-auto px-6 pb-24">
    <header class="mb-8">
        <a href="{{ route('home') }}" class="text-blue-400 hover:text-blue-300 text-sm mb-4 inline-block">← Voltar</a>
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

            <div class="space-y-3">
                <div class="bg-slate-900 border border-slate-700 p-4 rounded-lg text-white hover:border-slate-600 transition-colors cursor-grab active:cursor-grabbing">
                    <p class="text-sm">Criar layout inicial</p>
                </div>

                <div class="bg-slate-900 border border-slate-700 p-4 rounded-lg text-white hover:border-slate-600 transition-colors cursor-grab active:cursor-grabbing">
                    <p class="text-sm">Definir regras do projeto</p>
                </div>
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

            <div class="space-y-3">
                <div class="bg-slate-900 border border-slate-700 p-4 rounded-lg text-white hover:border-slate-600 transition-colors cursor-grab active:cursor-grabbing">
                    <p class="text-sm">Implementar autenticação</p>
                </div>
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

            <div class="space-y-3">
                <div class="bg-slate-900 border border-slate-700 p-4 rounded-lg text-slate-400 line-through opacity-60 hover:border-slate-600 transition-colors cursor-grab active:cursor-grabbing">
                    <p class="text-sm">Criar banco de dados</p>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
