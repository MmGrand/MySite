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
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach ($projects as $project)
                <div
                    class="overflow-hidden shadow-lg border border-slate-100 rounded-3xl hover:shadow-2xl transition-shadow duration-300 relative">
                    <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ $project->preview_image }}" alt="{{ $project->title }}"
                            class="w-full h-48 object-cover transition-transform duration-300 hover:scale-105">
                        <div class="p-5">
                            <h3 class="text-xl font-semibold">{{ $project->title }}</h3>
                            <p class="text-gray-600">{{ $project->preview_content }}</p>
                            <div class="flex flex-wrap gap-2 mt-2 mb-6">
                                @foreach ($project->tags as $tag)
                                    <span
                                        class="bg-green-200 hover:bg-green-300 text-green-800 hover:text-white text-xs font-medium px-2 py-1 rounded-full transition-colors duration-300">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $projects->links('vendor.pagination.tailwind') }}
        </div>
        @else
            <div class="text-center py-16">
                <h3 class="text-2xl font-semibold text-gray-800">{{ __('Проекты не найдены') }}</h3>
                <p class="text-gray-600">{{ __('Попробуйте изменить фильтры или сбросить их.') }}</p>
            </div>
        @endif
    </x-content-wrapper>
@endsection
