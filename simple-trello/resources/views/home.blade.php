@extends('layouts.main')

@section('content')
<div class="max-w-7xl mx-auto px-6 pb-24" x-data>
    <!-- Header -->
    <header class="mb-16">
        <h1 class="text-3xl font-light text-slate-500 tracking-tight">
            Bem-vindo, <span class="font-bold border-b-2 border-brand-accent">{{ explode(' ', auth()->user()->name)[0] }}</span>.
        </h1>
        <p class="text-slate-500 mt-2 text-sm uppercase tracking-widest font-medium">Dashboard Overview</p>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">
        <!-- Main Area -->
        <div class="lg:col-span-3 space-y-16">

            <!-- Owned Projects -->
            <section>
                <div class="flex items-baseline justify-between mb-8 border-b border-slate-800 pb-4">
                    <h2 class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400">Meus Projetos</h2>
                    <span class="text-[10px] text-slate-600 font-mono">{{ count($ownedProjects) }} total</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-px bg-slate-800 border border-slate-800">
                    @forelse($ownedProjects as $project)
                    <div class="bg-slate-950 p-8 hover:bg-slate-900 transition-colors group relative">
                        <div class="flex justify-between items-start mb-6">
                            <a href="{{ route('project.show', Crypt::encrypt($project->id)) }}" class="text-decoration-none">
                            <h3 class="text-lg font-bold text-white group-hover:text-brand-accent transition-colors">{{ $project->name }}</h3>
                            </a>
                            <button type="button" class="text-slate-600 hover:text-white transition-colors" 
                                @click="$dispatch('open-modal', { projectId: {{ $project->id }}, id: 'inviteProjectModal' })">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
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
                    @empty
                    <div class="bg-slate-950 col-span-full py-16 text-center">
                        <p class="text-slate-600 text-sm italic">Nenhum projeto criado ainda.</p>
                        <button class="mt-4 text-xs font-bold text-brand-accent uppercase tracking-widest hover:underline" data-bs-target="#createProject" data-bs-toggle="modal">Criar Projeto</button>
                    </div>
                    @endforelse
                </div>
            </section>

            <!-- Participating Projects -->
            <section>
                <div class="flex items-baseline justify-between mb-8 border-b border-slate-800 pb-4">
                    <h2 class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400">Colaborando</h2>
                    <span class="text-[10px] text-slate-600 font-mono">{{ count($participatingProjects) }} total</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-px bg-slate-800 border border-slate-800">
                    @forelse($participatingProjects as $project)
                    <div class="bg-slate-950 p-8 hover:bg-slate-900 transition-colors group">
                        <h3 class="text-lg font-bold text-white group-hover:text-brand-accent transition-colors mb-2">{{ $project->name }}</h3>
                        <p class="text-slate-500 text-sm leading-relaxed mb-8 h-10 line-clamp-2">{{ $project->description ?: 'Sem descrição.' }}</p>

                        <div class="flex items-center justify-between border-t border-slate-900 pt-6">
                            <span class="text-[10px] text-slate-600 uppercase tracking-tighter">Dono: {{ explode(' ', $project->owner->name)[0] }}</span>
                            <span class="text-[10px] font-mono text-slate-600">{{ count($project->tasks) }} TASKS</span>
                        </div>
                    </div>
                    @empty
                    <div class="bg-slate-950 col-span-full py-12 text-center">
                        <p class="text-slate-600 text-sm italic">Nenhuma colaboração ativa.</p>
                    </div>
                    @endforelse
                </div>
            </section>
        </div>

        <!-- Sidebar -->
        <aside class="space-y-12">
            <section>
                <h2 class="text-xs uppercase tracking-[0.2em] font-bold text-slate-400 mb-8 border-b border-slate-800 pb-4">Pendentes</h2>
                <div class="space-y-6">
                    @forelse($pendingTasks as $task)
                    <div class="group border-l border-slate-800 hover:border-brand-accent pl-4 transition-all">
                        <p class="text-sm font-bold text-white group-hover:text-brand-accent transition-colors truncate">{{ $task->title }}</p>
                        <p class="text-[10px] text-slate-600 uppercase tracking-tight mt-1">{{ $task->project->name }}</p>
                        <div class="mt-2 text-[9px] font-bold px-1.5 py-0.5 inline-block {{ $task->status === 'em_andamento' ? 'bg-brand-accent/10 text-brand-accent' : 'bg-slate-900 text-slate-500' }} rounded-sm">
                            {{ $task->status === 'em_andamento' ? 'DOING' : 'TODO' }}
                        </div>
                    </div>
                    @empty
                    <p class="text-slate-600 text-xs italic">Sem tarefas pendentes.</p>
                    @endforelse
                </div>
            </section>

            <div class="p-8 bg-slate-900 border border-slate-800 rounded-sm">
                <h3 class="text-sm font-bold text-white mb-4">Equipe</h3>
                <p class="text-slate-500 text-xs leading-relaxed mb-6">Convide novos membros para seus projetos e colabore em tempo real.</p>
                <button type="button" class="w-full py-3 bg-white text-slate-950 text-[10px] font-bold uppercase tracking-widest hover:bg-slate-200 transition-colors"
                @click="$dispatch('open-modal', { id: 'inviteModal'})">
                    Convidar
                </button>
            </div>
        </aside>
    </div>
</div>
@endsection