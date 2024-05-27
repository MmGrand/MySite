@props([
    'route' => null,
    'text' => '',
    'type' => 'link', // 'link' or 'button'
    'buttonType' => 'button', // 'button', 'submit', etc.
    'classes' => '',
    'defaultClasses' => 'inline-block bg-gradient-to-r from-green-400 to-blue-500 text-white font-bold text-lg py-3 px-6 rounded-lg shadow-lg transition-all duration-300 ease-in-out hover:bg-gradient-to-l hover:from-blue-500 hover:to-green-400 hover:shadow-2xl'
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