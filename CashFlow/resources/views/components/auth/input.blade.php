@props([
'label'
])

<div class="form-outline mb-4" data-mdb-input-init>
    <input
        {{ $attributes->merge([
            'class' => 'form-control bg-dark text-light'
        ]) }}
        value="{{ old($attributes->get('name')) }}">

    <label class="form-label text-secondary">
        {{ $label }}
    </label>

    @error($attributes->get('name'))
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>