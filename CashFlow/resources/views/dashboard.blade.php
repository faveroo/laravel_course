@extends('layouts.main')

@section('content')

@include('layouts.navbar')

<main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-white">Dashboard</h1>
        <p class="mt-2 text-text-secondary">Manage your finances and track your cash flow.</p>
    </div>

    <!-- Actions Card -->
    <div class="bg-dark-surface rounded-xl shadow-lg border border-dark-border p-6">
        <div class="flex items-center justify-center">
            <div class="mr-4">
                <h3 class="text-lg font-medium text-white">Quick Actions</h3>
                <p class="text-sm text-text-secondary">Register a new transaction to your history.</p>
            </div>

            <button onclick="openModal()" class="inline-flex items-center px-4 py-2 bg-primary hover:bg-primary-hover text-white text-sm font-medium rounded-lg transition-colors shadow-lg hover:shadow-primary/50">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                New Transaction
            </button>
        </div>
    </div>

</main>

<!-- Modal Overlay -->
<div
    id="transactionModal"
    class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50"
    onclick="closeModal()">

    <!-- Modal Content -->
    <div
        class="bg-dark-surface rounded-xl text-left overflow-hidden shadow-xl sm:max-w-lg sm:w-full border border-dark-border"
        onclick="event.stopPropagation()">

        <!-- Header -->
        <div class="px-6 py-4 border-b border-dark-border">
            <h3 class="text-lg font-medium text-white">
                Register Transaction
            </h3>
        </div>

        <!-- Body -->
        <div class="px-6 py-4">
            <x-util.modal
                action="{{ route('transaction.store') }}"
                :categories="$categories" />
        </div>

        <!-- Footer -->
        <div class="px-6 py-3 border-t border-dark-border flex justify-end">
            <button
                type="button"
                class="px-4 py-2 bg-dark-border rounded-md text-white hover:bg-dark-border/70"
                onclick="closeModal()">
                Cancel
            </button>
        </div>

    </div>
</div>

@if($errors->any())
<script>
    document.addEventListener('DOMContentLoaded', function() {
        openModal();
    });
</script>
@endif

<script>
    const modal = document.getElementById('transactionModal');

    function openModal() {
        modal.classList.remove('hidden');
        // Prevent body scroll? Optional.
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close on Escape
    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            closeModal();
        }
    });
</script>

@endsection