{{-- CREATE PROJECT --}}
<div
    x-data="{ open: false }"
    x-on:open-modal.window="if ($event.detail.id === 'createProject') open = true"
    x-show="open"
    x-cloak
    x-transition
    class="fixed inset-0 z-[999] flex items-center justify-center bg-black/60"
>
    <div @click.outside="open=false"
         class="bg-slate-950 border border-slate-800 w-full max-w-lg shadow-2xl">
        <div class="px-8 py-6 border-b border-slate-800 flex justify-between">
                <h2 class="text-xs font-bold uppercase tracking-widest text-white">
                    Novo Projeto
                </h2>
                <button type="button" @click="open=false" class="text-slate-400 hover:text-white">✕</button>
            </div>

        <form method="POST" action="{{ route('project.store') }}">
            @csrf

            <input type="hidden" name="invite_type" value="none">
            <div class="px-8 py-8 space-y-6">
                <x-form.input name="name" placeholder="Ex: Redesign"/>
                <textarea name="description"
                    class="w-full bg-slate-900 border border-slate-800 px-4 py-3 text-sm text-white"
                    placeholder="Descrição opcional"></textarea>
            </div>

            <div class="px-8 py-6 border-t border-slate-800 flex justify-end">
                <button type="submit" class="px-8 py-3 bg-white text-slate-950 text-xs font-bold uppercase">
                    Criar Projeto
                </button>
            </div>
        </form>
    </div>
</div>