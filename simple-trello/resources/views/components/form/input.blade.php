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
                'class' => 'w-full bg-slate-900 border border-slate-800 rounded-none px-4 py-3 text-sm text-white focus:border-brand-accent transition-all outline-none'
            ]) }}>

        @if ($hasError)
        <span class="text-red-500 text-sm mt-1 block">
            {{ $errors->first($name) }}
        </span>
        @endif
    </div>
</div>