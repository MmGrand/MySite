@props([
    'route' => null,
    'text' => '',
    'type' => 'link', // 'link' or 'button'
    'buttonType' => 'button', // 'button', 'submit', etc.
    'classes' => '',
    'defaultClasses' => 'site-button'
])

@if ($type === 'link')
    <a href="{{ route($route) }}"
       class="{{ $defaultClasses }} {{ $classes }}">
        {{ $text }}
    </a>
@else
    <button type="{{ $buttonType }}"
       class="{{ $defaultClasses }} {{ $classes }}">
        {{ $text }}
    </button>
@endif