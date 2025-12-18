@props([
'label',
'form',
'name',
'type' => 'text',
])

<div class="mb-4">
    <div class="relative">
        <label for="{{ $name }}" class="block text-sm font-medium text-text-secondary mb-1 ml-1">
            {{ $label }}
        </label>
        <input
            type="{{ $type }}"
            name="{{ $form }}[{{ $name }}]"
            id="{{ $name }}"
            value="{{ old($form . '.' . $name) }}"
            class="block w-full rounded-lg border-dark-border bg-dark-bg/50 text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm px-4 py-2.5 outline-none transition-all duration-200 border @error($form . '.' . $name) border-red-500 focus:border-red-500 focus:ring-red-500 @enderror"
            placeholder=" ">
        @error($form . '.' . $name)
        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none top-6">
            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
        </div>
        @enderror
    </div>
    @error($form . '.' . $name)
    <p class="mt-1 text-sm text-red-500 ml-1">{{ $message }}</p>
    @enderror
</div>