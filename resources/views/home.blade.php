@extends('layouts.main')

@section('title')
    Главная
@endsection

@section('content')
    <x-content-wrapper class="site-hero pt-28 pb-20 md:pt-36 md:pb-28">
        <div class="site-hero-content max-w-4xl">
            <p class="site-kicker mb-5">{{ __('Портфолио · Fullstack-разработчик') }}</p>
            <h1 class="max-w-3xl text-4xl font-bold leading-tight tracking-tight text-white sm:text-5xl md:text-7xl">
                {{ __('Добро пожаловать на мой персональный сайт') }}
            </h1>
            <p class="site-muted mt-6 max-w-2xl text-lg leading-relaxed md:text-xl">
                {{ __('Здесь вы найдете мои проекты, посты и подробности моего профессионального пути.') }}
            </p>
            <div class="mt-9 flex flex-wrap items-center gap-4">
                <x-button :route="'about'" :text="__('Узнать больше')" :type="'link'" :classes="''" />
                <a href="{{ route('projects.index') }}" class="site-link inline-flex items-center gap-2 font-semibold">
                    {{ __('Смотреть проекты') }} <span aria-hidden="true">→</span>
                </a>
            </div>
        </div>
    </x-content-wrapper>

    <x-content-wrapper class="pt-12">
        <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="site-kicker mb-2">{{ __('Избранное') }}</p>
                <h2 class="text-3xl font-bold tracking-tight text-white md:text-4xl">{{ __('Мои проекты') }}</h2>
            </div>
            <a href="{{ route('projects.index') }}" class="site-link font-semibold">{{ __('Все проекты') }} <span aria-hidden="true">→</span></a>
        </div>
        <x-project-list :projects="$projects" columns="grid-cols-1 sm:grid-cols-2 lg:grid-cols-3" gap="gap-6" />
    </x-content-wrapper>

    <x-content-wrapper class="pt-8 pb-20">
        <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
            <div>
                <p class="site-kicker mb-2">{{ __('Заметки и идеи') }}</p>
                <h2 class="text-3xl font-bold tracking-tight text-white md:text-4xl">{{ __('Мои посты') }}</h2>
            </div>
            <a href="{{ route('posts.index') }}" class="site-link font-semibold">{{ __('Все посты') }} <span aria-hidden="true">→</span></a>
        </div>
        <x-post-list :posts="$posts" columns="grid-cols-1 sm:grid-cols-2 lg:grid-cols-3" gap="gap-6" />
    </x-content-wrapper>
@endsection
