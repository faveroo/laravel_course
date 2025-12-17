@props([
'label',
'form' => null
])

@php
$oldKey = $form
? $form . '.' . $attributes->get('name')
: $attributes->get('name');
@endphp

<div class="form-group mb-3">
    <div class="form-outline" data-mdb-input-init>
        <input
            {{ $attributes->merge([
                'class' => 'form-control bg-dark text-light',
                'name' => $oldKey
            ]) }}
            value="{{ old($oldKey) }}">

        <label class="form-label text-secondary">
            {{ $label }}
        </label>
    </div>

    @error($oldKey)
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>