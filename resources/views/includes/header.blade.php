<header class="bg-white bg-opacity-90 fixed top-0 left-0 w-full z-20 shadow-md backdrop-blur-md transition-all duration-300 ease-in-out">
    <div class="container mx-auto px-4 flex justify-between items-center py-3">
        <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800 no-underline transition-transform duration-500 transform hover:scale-105">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button id="menu-btn" class="block lg:hidden focus:outline-none">
            <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <nav class="hidden lg:block">
            <ul class="flex items-center space-x-4">
                <li><a href="{{ route('home') }}" class="px-2 py-1 text-sm {{ active_link('home', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Главная') }}</a></li>
                <li><a href="{{ route('about') }}" class="px-2 py-1 text-sm {{ active_link('about', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Обо мне') }}</a></li>
                <li><a href="{{ route('projects.index') }}" class="px-2 py-1 text-sm {{ active_link('projects', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Проекты') }}</a></li>
                <li><a href="{{ route('posts.index') }}" class="px-2 py-1 text-sm {{ active_link('posts', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Посты') }}</a></li>
                <li><a href="{{ route('contacts') }}" class="px-2 py-1 text-sm {{ active_link('contacts', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Контакты') }}</a></li>
                @auth
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="px-2 py-1 text-sm text-gray-600 hover:text-gray-800 hover:underline transition-colors duration-300">
                            {{ __('Выход') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" class="px-2 py-1 text-sm {{ active_link('login', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-600 hover:underline transition-colors duration-300">{{ __('Вход') }}</a></li>
                @endauth
            </ul>
        </nav>
    </div>
</header>
<nav class="lg:hidden fixed top-0 left-0 w-full z-10 bg-white shadow-md backdrop-blur-md transition-transform duration-300 ease-in-out transform -translate-y-full" id="mobile-menu">
    <ul class="flex flex-col mt-16">
        <li><a href="{{ route('home') }}" class="block px-4 py-2 text-sm {{ active_link('home', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Главная') }}</a></li>
        <li><a href="{{ route('about') }}" class="block px-4 py-2 text-sm {{ active_link('about', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Обо мне') }}</a></li>
        <li><a href="{{ route('projects.index') }}" class="block px-4 py-2 text-sm {{ active_link('projects', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Проекты') }}</a></li>
        <li><a href="{{ route('posts.index') }}" class="block px-4 py-2 text-sm {{ active_link('posts', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Посты') }}</a></li>
        <li><a href="{{ route('contacts') }}" class="block px-4 py-2 text-sm {{ active_link('contacts', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors duration-300">{{ __('Контакты') }}</a></li>
        @auth
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();" class="block px-4 py-2 text-sm text-gray-600 hover:text-gray-800 hover:underline transition-colors duration-300">
                    {{ __('Выход') }}
                </a>
                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </li>
        @else
            <li><a href="{{ route('login') }}" class="block px-4 py-2 text-sm {{ active_link('login', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-600 hover:underline transition-colors duration-300">{{ __('Вход') }}</a></li>
        @endauth
    </ul>
</nav>