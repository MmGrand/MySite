@extends('layouts.main')

@section('title')
    {{ __('Мои посты') }}
@endsection

@section('content')
    <x-breadcrumbs :breadcrumbs="$breadcrumbs" />

    <x-content-wrapper>
        <div class="mb-8 text-center">
            <p class="site-kicker mb-2">{{ __('Заметки и идеи') }}</p>
            <h1 class="text-3xl font-bold tracking-tight text-white md:text-4xl">{{ __('Мои посты') }}</h1>
        </div>
        <div class="mb-8 flex flex-col justify-center gap-3 sm:flex-row">
            <div class="relative inline-block w-full sm:w-auto">
                <select onchange="updateFilter('category', this.value);"
                    aria-label="{{ __('Фильтр по категории') }}"
                    class="site-select w-full appearance-none pr-10 sm:w-auto">
                    <option value="" {{ request('category') ? '' : 'selected' }}>{{ __('Все категории') }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}
                            class="cursor-pointer">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <div class="site-muted pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M7 10l5 5 5-5H7z" />
                    </svg>
                </div>
            </div>
            <div class="relative inline-block w-full sm:w-auto">
                <select onchange="updateFilter('tag', this.value);"
                    aria-label="{{ __('Фильтр по тегу') }}"
                    class="site-select w-full appearance-none pr-10 sm:w-auto">
                    <option value="" {{ request('tag') ? '' : 'selected' }}>{{ __('Все теги') }}</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->slug }}" {{ request('tag') == $tag->slug ? 'selected' : '' }}
                            class="cursor-pointer">
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
                <div class="site-muted pointer-events-none absolute inset-y-0 right-0 flex items-center px-3">
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
                <h3 class="text-2xl font-semibold text-white">{{ __('Посты не найдены') }}</h3>
                <p class="site-muted">{{ __('Попробуйте изменить фильтры или сбросить их.') }}</p>
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

                // Сбрасываем параметр страницы
                if (params.has('page')) {
                    params.delete('page');
                }

                window.location.search = params.toString();
            }
        </script>
    @endpush
@endonce
