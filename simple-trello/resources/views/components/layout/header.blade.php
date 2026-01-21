<nav class="sticky top-0 z-50 bg-slate-950 border-b border-slate-800 mb-12" x-data>
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between h-20 items-center">
            <!-- Logo + Actions -->
            <div class="flex items-center gap-12">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-white rounded flex items-center justify-center">
                        <svg class="w-5 h-5 text-slate-950" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5z" />
                        </svg>
                    </div>
                    <span class="text-lg font-bold text-white">Trello</span>
                </a>
                <div class="hidden md:flex items-center gap-6">
                    <button
                        @click="$dispatch('open-modal', { id: 'createProject' })"
                        class="text-sm font-medium text-slate-400 hover:text-white">
                        Novo Projeto
                    </button>

                    <button
                        @click="$dispatch('open-modal', { id: 'inviteModal' })"
                        class="text-sm font-medium text-slate-400 hover:text-white">
                        Convidar
                    </button>

                    <a href="{{ route('user.myinvites') }}"
                       class="text-sm font-medium {{ request()->routeIs('user.myinvites') ? 'text-white' : 'text-slate-400 hover:text-white' }}">
                        Meus Convites
                    </a>
                </div>
            </div>

            <!-- User Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center gap-3">
                    <span class="text-sm text-slate-400">{{ auth()->user()->name }}</span>
                    <div class="w-10 h-10 bg-slate-800 border border-slate-700 flex items-center justify-center text-white font-bold">
                        {{ substr(auth()->user()->name,0,1) }}
                    </div>
                </button>

                <div x-show="open" @click.outside="open=false"
                     x-transition
                     class="absolute right-0 mt-3 w-44 bg-slate-900 border border-slate-800 shadow-2xl">
                    <a href="#" class="block px-4 py-2 text-sm text-slate-300 hover:bg-slate-800 hover:text-white">
                        Perfil
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="w-full text-left px-4 py-2 text-sm text-rose-400 hover:bg-rose-500/10">
                            Sair
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</nav>

{{-- ================= MODALS ================= --}}

{{-- CREATE PROJECT COMPONENT --}}
<x-modal.create-project />


{{-- INVITE MODAL --}}
<div
    x-data="{ open: false }"
    x-on:open-modal.window="if ($event.detail.id === 'inviteModal') open = true"
    x-show="open"
    x-transition
    class="fixed inset-0 z-[999] flex items-center justify-center bg-black/60"
>
    <div @click.outside="open=false"
         class="bg-slate-950 border border-slate-800 w-full max-w-lg shadow-2xl">

        <form method="POST" action="{{ route('project.invite') }}">
            @csrf

            <div class="px-8 py-6 border-b border-slate-800 flex justify-between">
                <h2 class="text-xs font-bold uppercase tracking-widest text-white">
                    Convidar Colaborador
                </h2>
                <button type="button" @click="open=false" class="text-slate-400 hover:text-white">✕</button>
            </div>

            <div class="px-8 py-8 space-y-6">
                <select name="project_id"
                    class="w-full bg-slate-900 border border-slate-800 px-4 py-3 text-sm text-white">
                    <option value="">Selecione o projeto</option>
                    @foreach(auth()->user()->ownedProjects as $project)
                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                    @endforeach
                </select>

                <input type="hidden" name="invite_type" value="manual">
                
                <x-form.input type="email" name="email" placeholder="email@exemplo.com"/>
            </div>

            <div class="px-8 py-6 border-t border-slate-800 flex justify-end">
                <button class="px-8 py-3 bg-white text-slate-950 text-xs font-bold uppercase">
                    Enviar Convite
                </button>
            </div>
        </form>
    </div>
</div>

<!-- InviteAutoModal -->
<div
    x-data="{ open: false, projectId: null }"
    x-on:open-modal.window="
        if ($event.detail.id === 'inviteProjectModal') open = true
    "
    x-show="open"
    x-cloak
    x-transition
    class="fixed inset-0 z-[999] flex items-center justify-center bg-black/60"
>
    <div @click.outside="open=false"
         class="bg-slate-950 border border-slate-800 w-full max-w-lg shadow-2xl">
        <form method="POST" action="{{ route('project.invite') }}">
            @csrf

            <div class="px-8 py-6 border-b border-slate-800 flex justify-between">
                <h2 class="text-xs font-bold uppercase tracking-widest text-white">
                    Convidar Colaborador
                </h2>
                <button type="button" @click="open=false" class="text-slate-400 hover:text-white">✕</button>
            </div>

            <div class="px-8 py-8 space-y-6">
                <input type="hidden" name="project_id" :value="projectId">
                <input type="hidden" name="invite_type" value="auto">
                <x-form.input type="email" name="email" placeholder="email@exemplo.com"/>
            </div>

            <div class="px-8 py-6 border-t border-slate-800 flex justify-end">
                <button class="px-8 py-3 bg-white text-slate-950 text-xs font-bold uppercase">
                    Enviar Convite
                </button>
            </div>
    </div>
</div>

@if (session('open_modal'))
<script>
    document.addEventListener('DOMContentLoaded', () => {
        Alpine.nextTick(()=> {
            window.dispatchEvent(
                new CustomEvent('open-modal', {
                    detail: { id: @json(session('open_modal')) }
                })
            );
        })
    });
</script>
@endif