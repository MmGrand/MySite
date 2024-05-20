@extends('layouts.main')

@section('title')
    {{ __('Мои посты') }}
@endsection

@section('content')
    <x-breadcrumbs :breadcrumbs="$breadcrumbs" />

    <x-content-wrapper class="bg-white">
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">{{ __('Мои посты') }}</h2>
        <div class="flex justify-center mb-8">
            <div class="relative inline-block w-full sm:w-auto mr-4">
                <select onchange="updateFilter('category', this.value);"
                    class="block w-full appearance-none bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 transition-colors duration-300 shadow-md hover:shadow-lg cursor-pointer">
                    <option value="" {{ request('category') ? '' : 'selected' }}>{{ __('Все категории') }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}
                            class="cursor-pointer">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M7 10l5 5 5-5H7z" />
                    </svg>
                </div>
            </div>
            <div class="relative inline-block w-full sm:w-auto">
                <select onchange="updateFilter('tag', this.value);"
                    class="block w-full appearance-none bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 transition-colors duration-300 shadow-md hover:shadow-lg cursor-pointer">
                    <option value="" {{ request('tag') ? '' : 'selected' }}>{{ __('Все теги') }}</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->slug }}" {{ request('tag') == $tag->slug ? 'selected' : '' }}
                            class="cursor-pointer">
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M7 10l5 5 5-5H7z" />
                    </svg>
                </div>
            </div>
        </div>
        @if ($posts->isNotEmpty())
            <x-post-list :posts="$posts" />
        @else
            <div class="text-center py-16">
                <h3 class="text-2xl font-semibold text-gray-800">{{ __('Посты не найдены') }}</h3>
                <p class="text-gray-600">{{ __('Попробуйте изменить фильтры или сбросить их.') }}</p>
            </div>
        @endif

    </x-content-wrapper>
@endsection

@once
    @push('js')
        <script>
            function updateFilter(type, value) {
                const params = new URLSearchParams(window.location.search);
                if (value) {
                    params.set(type, value);
                } else {
                    params.delete(type);
                }
                window.location.search = params.toString();
            }
        </script>
    @endpush
@endonce
