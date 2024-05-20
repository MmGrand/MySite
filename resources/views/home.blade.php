@extends('layouts.main')

@section('title')
    Главная
@endsection

@section('content')
    <x-content-wrapper class="bg-blue-500 text-white text-center pt-20">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4 animate-fade-in">
            {{ __('Добро пожаловать на мой персональный сайт') }}
        </h1>
        <p class="text-xl md:text-2xl mb-8 animate-fade-in delay-200">
            {{ __('Здесь вы найдете мои проекты, посты и подробности моего профессионального пути.') }}
        </p>
        <a href="{{ route('about') }}"
            class="inline-block bg-white text-blue-500 rounded-full px-8 py-3 text-lg font-semibold transition-colors duration-300 hover:bg-blue-200 animate-bounce">
            {{ __('Узнать больше') }}
        </a>
    </x-content-wrapper>

    <x-content-wrapper class="bg-white">
        <h2 class="text-3xl font-bold text-center mb-6">{{ __('Мои проекты') }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($projects as $project)
                <div
                    class="card-hover-effect overflow-hidden shadow-lg border border-slate-100 rounded-3xl transition-shadow duration-300 relative">
                    <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ $project->preview_image }}" alt="{{ $project->title }}"
                            class="img-hover-effect w-full h-48 object-cover transition-transform duration-500">
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
        <div class="text-center mt-8">
            <a href="{{ route('projects.index') }}"
                class="bg-gradient-to-r from-green-400 to-blue-500 text-white font-bold text-lg py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:-translate-y-2 hover:scale-105">
                {{ __('Все проекты') }}
            </a>
        </div>
    </x-content-wrapper>

    <x-content-wrapper class="bg-gray-100">
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">{{ __('Мои посты') }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <div
                    class="overflow-hidden shadow-lg border border-slate-100 rounded-3xl transition-shadow duration-300 relative">
                    <a href="{{ url('/posts/' . $post->slug) }}">
                        <img src="{{ $post->preview_image }}" alt="{{ $post->title }}" class="img-hover-effect w-full h-48 object-cover transition-transform duration-500">
                        <div
                            class="absolute top-0 left-0 bg-gradient-to-r from-green-500 to-blue-500 text-white text-sm px-3 py-1.5 rounded-br-2xl shadow">
                            <i class="fas fa-layer-group mr-1"></i>
                            {{ $post->category->name }}
                        </div>
                        <div class="p-5">
                            <h3 class="text-xl text-gray-800 font-semibold">{{ $post->title }}</h3>
                            <p class="text-gray-600 mb-2">{{ $post->preview_content }}</p>
                            <div class="flex flex-wrap gap-2 mt-2 mb-6">
                                @foreach ($post->tags as $tag)
                                    <span
                                        class="bg-green-200 hover:bg-green-300 text-green-800 hover:text-white text-xs font-medium px-2 py-1 rounded-full transition-colors duration-300">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                            <div class="flex items-center gap-3 text-gray-500 text-sm mt-2 absolute bottom-3 right-3">
                                <i class="fas fa-eye"></i>
                                <span>{{ $post->views_count }} {{ __('просмотров') }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('posts.index') }}"
                class="bg-gradient-to-r from-green-400 to-blue-500 text-white font-bold text-lg py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:-translate-y-2 hover:scale-105">
                {{ __('Все посты') }}
            </a>
        </div>
    </x-content-wrapper>


@endsection
