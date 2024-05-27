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
    class="w-full p-3 border border-gray-300 rounded mt-1 focus:outline-none focus:border-blue-500 {{ $classes }}">