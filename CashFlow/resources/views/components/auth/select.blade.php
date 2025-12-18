@props([
'form',
'name',
'label',
'options' => [],
'valueKey' => 'id',
'labelKey' => 'name',
])

<div class="mb-4">
    <label for="{{ $name }}" class="block text-sm font-medium text-text-secondary mb-1 ml-1">
        {{ $label }}
    </label>

    <div class="relative">
        <select
            name="{{ $form }}[{{ $name }}]"
            id="{{ $name }}"
            class="block w-full rounded-lg border-dark-border bg-dark-bg/50 text-white shadow-sm focus:border-primary focus:ring-primary sm:text-sm px-4 py-2.5 outline-none transition-all duration-200 border appearance-none @error($form . '.' . $name) border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">
            <option value="" class="text-gray-500">Select {{ $label }}</option>

            @foreach ($options as $option)
            <option
                value="{{ $option->{$valueKey} }}"
                class="bg-dark-surface text-white"
                @selected(old($form . '.' . $name)==$option->{$valueKey})
                >
                {{ $option->{$labelKey} }}
            </option>
            @endforeach
        </select>

        <!-- Custom Chevron -->
        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-text-secondary">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </div>

    @error($form . '.' . $name)
    <p class="mt-1 text-sm text-red-500 ml-1">{{ $message }}</p>
    @enderror
</div>