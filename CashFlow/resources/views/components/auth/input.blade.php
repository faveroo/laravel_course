@props([
'label',
'form',
'name',
'type',
])

<div class="form-group mb-3">
    <div class="form-outline" data-mdb-input-init>
        <input
            type="{{ $type }}"
            name="{{ $form }}[{{ $name }}]"
            value="{{ old($form . '.' . $name) }}"
            class="form-control bg-dark text-light @error($form . '.' . $name) is-invalid @enderror">
        <label class="form-label text-secondary">
            {{ $label }}
        </label>
    </div>
    @error($form . '.' . $name)
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>