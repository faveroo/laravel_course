@extends('layouts.main')

@section('content')

@include('layouts.navbar')

<div class="card">
    <div class="card-body">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#transactionModal">
            Make a Transaction
        </button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="transactionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-light">
                <h5 class="modal-title" id="transactionModalLabel">Make a Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-dark text-light">
                <form action="" method="POST">
                    @csrf

                    <x-auth.input
                        form="transaction"
                        type="text"
                        name="description"
                        label="Description"
                        required />

                    <x-auth.input
                        form="transaction"
                        type="text"
                        name="amount"
                        label="Amount"
                        required />

                    <x-auth.select
                        form="transaction"
                        name="category"
                        label="Category"
                        :options="$categories"
                        valueKey="id"
                        labelKey="name"
                        required />

                    <x-auth.select
                        form="transaction"
                        name="type"
                        label="Type"
                        :options="[
                            (object)['id' => 'income', 'name' => 'Income'],
                            (object)['id' => 'expense', 'name' => 'Expense'],
                        ]"
                        valueKey="id"
                        labelKey="name"
                        required />

                    <button type="submit" class="btn btn-primary w-100">
                        Submit
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection