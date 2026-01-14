<nav class="sticky top-0 z-50 minimal-glass mb-12">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between h-20 items-center">
            <!-- Logo area -->
            <div class="flex items-center gap-12">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-white rounded flex items-center justify-center">
                        <svg class="w-5 h-5 text-slate-950" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-8 14H7v-2h4v2zm4-4H7v-2h8v2zm0-4H7V7h8v2z" />
                        </svg>
                    </div>
                    <span class="text-lg font-bold tracking-tight text-white">Trello</span>
                </a>

                <div class="hidden md:flex items-center gap-6">
                    <button type="button"
                        class="text-sm font-medium text-slate-400 hover:text-white transition-all flex items-center gap-2"
                        data-bs-target="#createProject"
                        data-bs-toggle="modal">
                        Novo Projeto
                    </button>
                    <button type="button"
                        class="text-sm font-medium text-slate-400 hover:text-white transition-all flex items-center gap-2"
                        data-bs-target="#inviteModal"
                        data-bs-toggle="modal">
                        Convidar
                    </button>
                </div>
            </div>

            <!-- User area -->
            <div class="flex items-center gap-6">
                <div class="dropdown">
                    <button class="flex items-center gap-3 text-white dropdown-toggle border-none bg-transparent"
                        type="button"
                        data-bs-toggle="dropdown">
                        <span class="text-sm font-medium text-slate-400">{{ auth()->user()->name }}</span>
                        <div class="w-10 h-10 rounded bg-slate-800 border border-slate-700 flex items-center justify-center text-sm font-bold">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end bg-slate-900 border border-slate-800 mt-2 p-1 shadow-2xl">
                        <li>
                            <a class="dropdown-item py-2 px-4 text-slate-300 hover:text-white hover:bg-slate-800 rounded-sm text-sm" href="#">
                                Perfil
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider border-slate-800">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 px-4 text-rose-400 hover:bg-rose-500/10 rounded-sm text-sm">
                                    Sair
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Modals -->
<div class="modal fade" id="createProject" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-slate-950 border border-slate-800 rounded-none shadow-2xl">
            <div class="modal-header border-slate-800 px-8 py-6">
                <h2 class="text-xs uppercase tracking-widest font-bold text-white">Novo Projeto</h2>
                <button type="button" class="btn-close btn-close-white scale-75" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('project.store') }}" method="post">
                @csrf
                <div class="modal-body px-8 py-8 space-y-8">
                    <div class="space-y-3">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-slate-500">Nome do Projeto</label>
                        <input type="text" name="name"
                            class="w-full bg-slate-900 border border-slate-800 rounded-none px-4 py-3 text-sm text-white focus:border-brand-accent transition-all outline-none"
                            placeholder="Ex: Redesign">
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-slate-500">Descrição</label>
                        <textarea name="description" rows="3"
                            class="w-full bg-slate-900 border border-slate-800 rounded-none px-4 py-3 text-sm text-white focus:border-brand-accent transition-all outline-none"
                            placeholder="Opcional"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-slate-800 px-8 py-6 flex justify-between items-center">
                    <button type="button" class="text-[10px] uppercase tracking-widest font-bold text-slate-500 hover:text-white transition-colors" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="px-8 py-3 bg-white text-slate-950 text-[10px] font-bold uppercase tracking-widest hover:bg-slate-200 transition-all">
                        Criar Projeto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="inviteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-slate-950 border border-slate-800 rounded-none shadow-2xl">
            <div class="modal-header border-slate-800 px-8 py-6">
                <h2 class="text-xs uppercase tracking-widest font-bold text-white">Convidar Colaborador</h2>
                <button type="button" class="btn-close btn-close-white scale-75" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('project.invite') }}" method="post">
                @csrf
                <div class="modal-body px-8 py-8 space-y-8">
                    <div class="space-y-3">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-slate-500">Escolha o Projeto</label>
                        <select name="project_id" class="w-full bg-slate-900 border border-slate-800 rounded-none px-4 py-3 text-sm text-white focus:border-brand-accent outline-none">
                            <option value="">Selecione...</option>
                            @foreach(auth()->user()->ownedProjects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="space-y-3">
                        <label class="text-[10px] uppercase tracking-widest font-bold text-slate-500">E-mail do Usuário</label>
                        <input type="email" name="email"
                            class="w-full bg-slate-900 border border-slate-800 rounded-none px-4 py-3 text-sm text-white focus:border-brand-accent transition-all outline-none"
                            placeholder="colaborador@exemplo.com">
                    </div>
                </div>
                <div class="modal-footer border-slate-800 px-8 py-6 flex justify-between items-center">
                    <button type="button" class="text-[10px] uppercase tracking-widest font-bold text-slate-500 hover:text-white transition-colors" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="px-8 py-3 bg-white text-slate-950 text-[10px] font-bold uppercase tracking-widest hover:bg-slate-200 transition-all">
                        Enviar Convite
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@php
$modalId = null;

if ($errors->has('name')) {
$modalId = 'createProject';
} elseif ($errors->has('email')) {
$modalId = 'inviteModal';
}
@endphp

@if ($modalId)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        new bootstrap.Modal(
            document.getElementById(@json($modalId))
        ).show();
    });
</script>
@endif