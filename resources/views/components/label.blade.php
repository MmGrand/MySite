@props([
	'for' => '',
	'value' => '',
	'classes' => '',
])

<label for="{{ $for }}" class="block text-gray-700 {{ $classes }}">{{ __($value) }}</label>