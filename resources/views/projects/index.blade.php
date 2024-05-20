@extends('layouts.main')

@section('title')
    Мои проекты
@endsection

@section('content')
    <x-breadcrumbs :breadcrumbs="$breadcrumbs" />

    <x-content-wrapper>
        <h2 class="text-3xl font-bold text-center mb-6">{{ __('Мои проекты') }}</h2>
        <div class="flex justify-center mb-8">
            <div class="relative inline-block w-full sm:w-auto">
                <select onchange="location = this.value;"
                    class="block w-full appearance-none bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 transition-colors duration-300 shadow-md hover:shadow-lg cursor-pointer">
                    <option value="{{ route('projects.index') }}" {{ request('tag') ? '' : 'selected' }}>{{ __('Все теги') }}
                    </option>
                    @foreach ($tags as $tag)
                        <option value="{{ route('projects.index', ['tag' => $tag->slug]) }}"
                            {{ request('tag') == $tag->slug ? 'selected' : '' }} class="cursor-pointer">
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
        @if ($projects->isNotEmpty())
            <x-project-list :projects="$projects" />
        @else
            <div class="text-center py-16">
                <h3 class="text-2xl font-semibold text-gray-800">{{ __('Проекты не найдены') }}</h3>
                <p class="text-gray-600">{{ __('Попробуйте изменить фильтры или сбросить их.') }}</p>
            </div>
        @endif

    </x-content-wrapper>
@endsection
