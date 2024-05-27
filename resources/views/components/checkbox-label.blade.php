@props([
    'for' => '',
    'name' => '',
    'id' => '',
    'label' => '',
    'checked' => false,
    'classes' => '',
    'checkboxClasses' => '',
    'labelClasses' => 'text-sm text-gray-600',
])

<label for="{{ $for }}" class="flex items-center space-x-2 cursor-pointer {{ $classes }}">
	<input type="checkbox" name="{{ $name }}" id="{{ $id }}" {{ $checked ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-blue-600 transition duration-150 ease-in-out cursor-pointer {{ $checkboxClasses }}">
	<span class="{{ $labelClasses }}">{{ __($label) }}</span>
</label>
