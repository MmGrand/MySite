<header class="bg-white bg-opacity-90 fixed top-0 left-0 w-full z-20 shadow-md backdrop-blur-md transition-all duration-300 ease-in-out">
    <div class="container mx-auto px-4 flex justify-between items-center py-4">
        <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800 no-underline transition-transform duration-500 transform hover:scale-105">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button id="menu-btn" class="block lg:hidden focus:outline-none">
            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <nav class="hidden lg:block">
            <ul class="flex items-center space-x-6">
                <li><a href="{{ route('home') }}" class="px-4 py-2 {{ active_link('home', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Главная') }}</a></li>
                <li><a href="{{ route('about') }}" class="px-4 py-2 {{ active_link('about', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Обо мне') }}</a></li>
                <li><a href="{{ route('projects.index') }}" class="px-4 py-2 {{ active_link('projects', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Проекты') }}</a></li>
                <li><a href="{{ route('posts.index') }}" class="px-4 py-2 {{ active_link('posts', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Посты') }}</a></li>
                <li><a href="{{ route('contacts') }}" class="px-4 py-2 {{ active_link('contacts', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Контакты') }}</a></li>
            </ul>
        </nav>
    </div>
</header>
<nav class="lg:hidden fixed top-16 left-0 w-full z-10 bg-white shadow-md backdrop-blur-md transition-transform duration-300 ease-in-out transform -translate-y-full" id="mobile-menu">
    <ul class="flex flex-col">
        <li><a href="{{ route('home') }}" class="block px-4 py-2 {{ active_link('home', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Главная') }}</a></li>
        <li><a href="{{ route('about') }}" class="block px-4 py-2 {{ active_link('about', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Обо мне') }}</a></li>
        <li><a href="{{ route('projects.index') }}" class="block px-4 py-2 {{ active_link('projects', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Проекты') }}</a></li>
        <li><a href="{{ route('posts.index') }}" class="block px-4 py-2 {{ active_link('posts', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Посты') }}</a></li>
        <li><a href="{{ route('contacts') }}" class="block px-4 py-2 {{ active_link('contacts', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Контакты') }}</a></li>
    </ul>
</nav>