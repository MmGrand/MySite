<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    @vite('resources/css/app.css')
    @stack('css')
</head>
<body class="flex flex-col min-h-screen">
    <header class="bg-white shadow">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-xl font-semibold text-gray-700 no-underline">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button id="menu-btn" class="block lg:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            <nav class="hidden lg:block">
                <ul class="flex items-center">
                    <li><a href="{{ route('home') }}" class="px-4 py-2 text-sm {{ active_link('home', 'text-gray-900') != '' ? 'text-gray-900' : 'text-gray-500' }} hover:text-gray-900 hover:underline">{{ __('Главная') }}</a></li>
                    <li><a href="{{ route('about') }}" class="px-4 py-2 text-gray-500 text-sm {{ active_link('about', 'text-gray-900') != '' ? 'text-gray-900' : 'text-gray-500' }} hover:text-gray-900 hover:underline">{{ __('Обо мне') }}</a></li>
                    <li><a href="{{ route('projects') }}" class="px-4 py-2 text-gray-500 text-sm {{ active_link('projects', 'text-gray-900') != '' ? 'text-gray-900' : 'text-gray-500' }} hover:text-gray-900 hover:underline">{{ __('Проекты') }}</a></li>
                    <li><a href="" class="px-4 py-2 text-gray-500 text-sm {{ active_link('posts', 'text-gray-900') != '' ? 'text-gray-900' : 'text-gray-500' }} hover:text-gray-900 hover:underline">{{ __('Посты') }}</a></li>
                    <li><a href="" class="px-4 py-2 text-gray-500 text-sm {{ active_link('contacts', 'text-gray-900') != '' ? 'text-gray-900' : 'text-gray-500' }} hover:text-gray-900 hover:underline">{{ __('Контакты') }}</a></li>
                </ul>
            </nav>
        </div>
        <nav class="lg:hidden">
            <ul id="menu" class="hidden absolute w-full bg-white shadow-md">
                <li><a href="{{ route('home') }}" class="block px-4 py-2 text-sm {{ active_link('home', 'text-gray-900') != '' ? 'text-gray-900' : 'text-gray-500' }} hover:text-gray-900 hover:underline">{{ __('Главная') }}</a></li>
                <li><a href="{{ route('about') }}" class="block px-4 py-2 text-gray-500 text-sm {{ active_link('about', 'text-gray-900') != '' ? 'text-gray-900' : 'text-gray-500' }} hover:text-gray-900 hover:underline">{{ __('Обо мне') }}</a></li>
                <li><a href="{{ route('projects') }}" class="block px-4 py-2 text-gray-500 text-sm {{ active_link('projects', 'text-gray-900') != '' ? 'text-gray-900' : 'text-gray-500' }} hover:text-gray-900 hover:underline">{{ __('Проекты') }}</a></li>
                <li><a href="" class="block px-4 py-2 text-gray-500 text-sm {{ active_link('posts', 'text-gray-900') != '' ? 'text-gray-900' : 'text-gray-500' }} hover:text-gray-900 hover:underline">{{ __('Посты') }}</a></li>
                <li><a href="" class="block px-4 py-2 text-gray-500 text-sm {{ active_link('contacts', 'text-gray-900') != '' ? 'text-gray-900' : 'text-gray-500' }} hover:text-gray-900 hover:underline">{{ __('Контакты') }}</a></li>
            </ul>
        </nav>
    </header>
    <main class="flex-grow">
        @yield('content')
    </main>
    <footer class="bg-white shadow mt-auto">
        <div class="container mx-auto px-6 py-4">
            <p class="text-gray-700 text-center text-sm">
                &copy; {{ now()->year }} {{ config('app.name', 'Laravel') }}. All rights reserved.
            </p>
        </div>
    </footer>

    @vite('resources/js/menu.js')
    @stack('js')
</body>
</html>