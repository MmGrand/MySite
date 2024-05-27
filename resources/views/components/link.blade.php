@props([
    'href' => '#',
    'text' => '',
    'type' => 'link', // 'link' or 'button'
    'buttonType' => 'button',
    'classes' => '',
    'defaultClasses' => 'text-blue-600 hover:underline transition duration-300 ease-in-out',
])

@if($type === 'link')
    <a href="{{ $href }}" class="{{ $defaultClasses }} {{ $classes }}">
        {{ $text }}
    </a>
@else
    <button type="{{ $buttonType }}" class="{{ $defaultClasses }} {{ $classes }}">
        {{ $text }}
    </button>
@endif