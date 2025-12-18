@props([
'action',
'categories',
])

<form action="{{ $action }}" method="POST" class="space-y-4">
    @csrf

    <x-auth.input
        form="transaction"
        type="text"
        name="description"
        label="Description" />

    <x-auth.input
        form="transaction"
        type="text"
        name="amount"
        label="Amount" />

    <x-auth.select
        form="transaction"
        name="category_id"
        label="Category"
        :options="$categories"
        valueKey="id"
        labelKey="name" />

    <x-auth.select
        form="transaction"
        name="type"
        label="Type"
        :options="[
                            (object)['id' => 'income', 'name' => 'Income'],
                            (object)['id' => 'expense', 'name' => 'Expense'],
                        ]"
        valueKey="id"
        labelKey="name" />

    <div class="pt-2">
        <button type="submit" class="w-full py-3 px-4 bg-primary hover:bg-primary-hover text-white rounded-lg transition-colors font-medium shadow-md">
            Submit Transaction
        </button>
    </div>
</form>