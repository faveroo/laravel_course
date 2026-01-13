@php
$hasError = $errors->has($name)
@endphp

<div class="mb-3">
    <div class="input-group">
        @if($label)
        <span class="input-group-text">{{ $label }}</span>
        @endif

        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ old($name) }}"
            placeholder="{{ $placeholder }}"
            {{ $attributes->merge([
                'class' => 'form-control' . ($hasError ? ' is-invalid' : '')
            ]) }}>

        @if ($hasError)
        <span class="invalid-feedback">
            {{ $errors->first($name) }}
        </span>
        @endif
    </div>
</div>