@extends('layouts.main')

@section('title')
    Главная
@endsection

@section('content')
    <x-content-wrapper class="bg-blue-500 text-white text-center pt-20">
        <h1 class="text-3xl md:text-5xl font-bold mb-4">Добро пожаловать на мой персональный сайт</h1>
        <p class="text-xl mb-8">Здесь вы найдете мои проекты, посты и подробности моего профессионального пути.</p>
        <a href="{{ route('about') }}"
            class="inline-block bg-white text-blue-500 rounded-full px-8 py-3 text-lg font-semibold transition-colors duration-300 hover:bg-blue-200">Узнать
            больше</a>
    </x-content-wrapper>

    <x-content-wrapper class="bg-white">
        <h2 class="text-3xl font-bold text-center mb-6">Мои проекты</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($projects as $project)
                <div
                    class="overflow-hidden shadow-lg border border-slate-100 rounded-3xl hover:shadow-2xl transition-shadow duration-300 relative">
                    <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ $project->preview_image }}" alt="{{ $project->title }}"
                            class="w-full h-48 object-cover">
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
                Все проекты
            </a>
        </div>
    </x-content-wrapper>
    <x-content-wrapper class="bg-gray-100">
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Мои посты</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <div
                    class="overflow-hidden shadow-lg border border-slate-100 rounded-3xl hover:shadow-2xl transition-shadow duration-300 relative">
                    <a href="{{ url('/posts/' . $post->slug) }}" target="_blank" rel="noopener noreferrer">
                        <img src="{{ $post->preview_image }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
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
                            <div class="flex items-center text-gray-500 text-sm mt-2 absolute bottom-3 right-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-3-7a9 9 0 00-9 9 9 9 0 0018 0 9 9 0 00-9-9z" />
                                </svg>
                                <span>{{ $post->views_count }} просмотров</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-8">
            <a href="{{ route('posts.index') }}"
                class="bg-gradient-to-r from-green-400 to-blue-500 text-white font-bold text-lg py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:-translate-y-2 hover:scale-105">
                Все посты
            </a>
        </div>
    </x-content-wrapper>
@endsection
