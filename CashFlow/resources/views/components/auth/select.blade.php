@props([
'form',
'name',
'label',
'options' => [],
'valueKey' => 'id',
'labelKey' => 'name',
])

<div class="form-group mb-3">
    <div class="form-outline" data-mdb-input-init>
        <select
            id="{{ $name }}"
            name="{{ $form }}[{{ $name }}]"
            class="form-select text-light bg-dark @error($form . '.' . $name) is-invalid @enderror">

            <option value="" class="text-secondary">Select {{ $label }}</option>

            @foreach ($options as $option)
            <option
                value="{{ $option->{$valueKey} }}"
                {{ old($form . '.' . $name) == $option->{$valueKey} ? 'selected' : '' }}>
                {{ $option->{$labelKey} }}
            </option>
            @endforeach
        </select>
    </div>
    @error($form . '.' . $name)
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>