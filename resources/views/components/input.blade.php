@props([
	'type' => 'text',
	'name' => '',
	'id' => '',
	'required' => false,
	'value' => '',
	'classes' => ''
])

<input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" value="{{ $value }}"
    {{ $required ? 'required' : '' }}
    class="site-input mt-1 {{ $classes }}">