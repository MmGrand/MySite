@props([
    'href' => '#',
    'text' => '',
    'type' => 'link', // 'link' or 'button'
    'buttonType' => 'button',
    'classes' => '',
    'defaultClasses' => 'site-link',
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