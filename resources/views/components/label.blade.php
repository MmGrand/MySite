@props([
	'for' => '',
	'value' => '',
	'classes' => '',
])

<label for="{{ $for }}" class="site-label {{ $classes }}">{{ __($value) }}</label>