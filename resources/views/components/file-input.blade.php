@props([
    'name' => 'file',
    'id' => 'file',
    'displayText' => 'Нажмите, чтобы выбрать фото',
    'classes' => '',
])

<div class="site-file-input cursor-pointer {{ $classes }}">
    <input type="file" name="{{ $name }}" id="{{ $id }}" class="absolute inset-0 h-full w-full cursor-pointer opacity-0" onchange="displayFileName(this)">
    <span id="file-name-{{ $id }}">{{ __($displayText) }}</span>
</div>
