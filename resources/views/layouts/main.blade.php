<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    @stack('css')
</head>
<body class="flex flex-col min-h-screen">
    <header class="bg-white bg-opacity-90 fixed top-0 left-0 w-full z-20 shadow-sm">
        <div class="container mx-auto px-4 flex justify-between items-center py-2">
            <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800 no-underline">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button id="menu-btn" class="block lg:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            <nav class="hidden lg:block">
                <ul class="flex items-center">
                    <li><a href="{{ route('home') }}" class="px-4 py-2 {{ active_link('home', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600 hover:text-gray-800' }} hover:underline transition-colors">{{ __('Главная') }}</a></li>
                    <li><a href="{{ route('about') }}" class="px-4 py-2 {{ active_link('about', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600 hover:text-gray-800' }} hover:underline transition-colors">{{ __('Обо мне') }}</a></li>
                    <li><a href="{{ route('projects') }}" class="px-4 py-2 {{ active_link('projects', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600 hover:text-gray-800' }} hover:underline transition-colors">{{ __('Проекты') }}</a></li>
                    <li><a href="{{ route('posts') }}" class="px-4 py-2 {{ active_link('posts', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600 hover:text-gray-800' }} hover:underline transition-colors">{{ __('Посты') }}</a></li>
                    <li><a href="{{ route('contacts') }}" class="px-4 py-2 {{ active_link('contacts', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600 hover:text-gray-800' }} hover:underline transition-colors">{{ __('Контакты') }}</a></li>
                </ul>
            </nav>
        </div>
        <nav class="lg:hidden">
            <ul id="menu" class="hidden absolute w-full bg-white shadow-md">
                <li><a href="{{ route('home') }}" class="block px-4 py-2 {{ active_link('home', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors">{{ __('Главная') }}</a></li>
                <li><a href="{{ route('about') }}" class="block px-4 py-2 {{ active_link('about', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors">{{ __('Обо мне') }}</a></li>
                <li><a href="{{ route('projects') }}" class="block px-4 py-2 {{ active_link('projects', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors">{{ __('Проекты') }}</a></li>
                <li><a href="{{ route('posts') }}" class="block px-4 py-2 {{ active_link('posts', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors">{{ __('Посты') }}</a></li>
                <li><a href="{{ route('contacts') }}" class="block px-4 py-2 {{ active_link('contacts', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors">{{ __('Контакты') }}</a></li>
            </ul>
        </nav>
    </header>
    <main class="flex-grow">
        @yield('content')
    </main>
    <footer class="bg-gray-800 text-white mt-auto">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <p>&copy; 2024 MmGrand. Все права защищены.</p>
                <div class="flex flex-col md:flex-row md:gap-4 gap-2">
                    <a href="https://vk.com/maksimzarubin" class="hover:text-gray-400" target="_blank" rel="noopener noreferrer">Вконтакте</a>
                    <a href="https://t.me/MmGranddd" class="hover:text-gray-400" target="_blank" rel="noopener noreferrer">Телеграмм</a>
                </div>
            </div>
        </div>
    </footer>

    <button id="scrollTopBtn" class="hidden fixed bottom-4 right-4 z-1000 bg-blue-500 hover:bg-blue-700 text-white text-xl py-2 px-4 rounded-full z-50" style="transition: opacity 0.3s; opacity: 0;">
        🠕 {{ __('Наверх') }}
    </button>

    @vite('resources/js/menu.js')
    @stack('js')
</body>
</html>