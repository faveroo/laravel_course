<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @auth
    <x-layout.header username="{{ auth()->user()->name }}" />
    @endauth

    @if (session('success'))
    <div class="fixed top-4 right-4 z-50 bg-emerald-900 border border-emerald-700 px-6 py-4 rounded-sm text-emerald-300 text-sm font-medium shadow-lg">
        {{ session('success') }}
    </div>
    @endif

    @yield('content')

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.2/Sortable.min.js"></script>

    

@can('tasks.move')
    <script>
document.querySelectorAll('[data-status]').forEach(column => {
    new Sortable(column, {
    group: 'kanban',
    animation: 150,
    ghostClass: 'opacity-40',
    draggable: '.kanban-item',

    filter: '.kanban-empty',
    preventOnFilter: false,

    onEnd(evt) {
        const taskId = evt.item.dataset.id;
        if (!taskId) return;

        const newStatus = evt.to.dataset.status;

        fetch(`/tasks/${taskId}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(()=> {
            const emptyMessage = evt.to.querySelector('[data-empty]');
            console.log(emptyMessage)
            if (emptyMessage) {
                location.reload();
            }

        });
        

    }
});

});


</script>
@endcan
</body>

</html>