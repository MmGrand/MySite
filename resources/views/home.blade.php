@extends('layouts.main')

@section('title')
    Главная
@endsection

@section('content')
    <x-content-wrapper class="bg-gradient-to-r from-blue-200 via-purple-200 to-pink-200 text-gray-900 text-center pt-20">
        <h1 class="text-4xl md:text-6xl font-extrabold mb-4 animate-fade-in text-gray-900">
            {{ __('Добро пожаловать на мой персональный сайт') }}
        </h1>
        <p class="text-xl md:text-2xl mb-8 animate-fade-in text-gray-900">
            {{ __('Здесь вы найдете мои проекты, посты и подробности моего профессионального пути.') }}
        </p>
        <x-button :route="'about'" :text="__('Узнать больше')" :type="'link'" :classes="''" />
    </x-content-wrapper>

    <x-content-wrapper class="bg-white">
        <h2 class="text-3xl font-bold text-center mb-6">{{ __('Мои проекты') }}</h2>
        <x-project-list :projects="$projects" columns="grid-cols-1 sm:grid-cols-2 lg:grid-cols-3" gap="gap-6" />
        <div class="text-center mt-8">
            <x-button :route="'projects.index'" :text="__('Все проекты')" :type="'link'" :classes="''" />
        </div>
    </x-content-wrapper>

    <x-content-wrapper class="bg-gray-100">
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">{{ __('Мои посты') }}</h2>
        <x-post-list :posts="$posts" columns="grid-cols-1 sm:grid-cols-2 lg:grid-cols-3" gap="gap-6" />
        <div class="text-center mt-8">
            <x-button :route="'posts.index'" :text="__('Все посты')" :type="'link'" :classes="''" />
        </div>
    </x-content-wrapper>
@endsection
