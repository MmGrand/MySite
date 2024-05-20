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
        <x-project-list :projects="$projects" columns="grid-cols-1 sm:grid-cols-2 lg:grid-cols-3" gap="gap-6" />
        <div class="text-center mt-8">
            <a href="{{ route('projects.index') }}"
                class="bg-gradient-to-r from-green-400 to-blue-500 text-white font-bold text-lg py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:-translate-y-2 hover:scale-105">
                {{ __('Все проекты') }}
            </a>
        </div>
    </x-content-wrapper>

    <x-content-wrapper class="bg-gray-100">
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">{{ __('Мои посты') }}</h2>
        <x-post-list :posts="$posts" columns="grid-cols-1 sm:grid-cols-2 lg:grid-cols-3" gap="gap-6" />
        <div class="text-center mt-8">
            <a href="{{ route('posts.index') }}"
                class="bg-gradient-to-r from-green-400 to-blue-500 text-white font-bold text-lg py-3 px-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:-translate-y-2 hover:scale-105">
                {{ __('Все посты') }}
            </a>
        </div>
    </x-content-wrapper>


@endsection
