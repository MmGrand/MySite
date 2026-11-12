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
	<input type="checkbox" name="{{ $name }}" id="{{ $id }}" {{ $checked ? 'checked' : '' }} class="h-5 w-5 cursor-pointer accent-cyan-400 {{ $checkboxClasses }}">
	<span class="{{ $labelClasses }} site-muted">{{ __($label) }}</span>
</label>
