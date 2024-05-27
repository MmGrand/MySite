@props([
    'name' => 'file',
    'id' => 'file',
    'displayText' => 'Нажмите, чтобы выбрать фото',
    'classes' => '',
])

<div class="relative flex items-center justify-center cursor-pointer bg-blue-100 border-2 border-dashed border-blue-300 rounded-lg p-4 hover:bg-blue-200 transition duration-300 {{ $classes }}">
    <input type="file" name="{{ $name }}" id="{{ $id }}" class="absolute inset-0 opacity-0 cursor-pointer" onchange="displayFileName(this)">
    <span id="file-name-{{ $id }}" class="text-blue-500">{{ __($displayText) }}</span>
</div>
