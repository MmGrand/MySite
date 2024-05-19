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
                <li><a href="{{ route('projects.index') }}" class="px-4 py-2 {{ active_link('projects', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600 hover:text-gray-800' }} hover:underline transition-colors">{{ __('Проекты') }}</a></li>
                <li><a href="{{ route('posts.index') }}" class="px-4 py-2 {{ active_link('posts', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600 hover:text-gray-800' }} hover:underline transition-colors">{{ __('Посты') }}</a></li>
                <li><a href="{{ route('contacts') }}" class="px-4 py-2 {{ active_link('contacts', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600 hover:text-gray-800' }} hover:underline transition-colors">{{ __('Контакты') }}</a></li>
            </ul>
        </nav>
    </div>
    <nav class="lg:hidden">
        <ul id="menu" class="hidden absolute w-full bg-white shadow-md">
            <li><a href="{{ route('home') }}" class="block px-4 py-2 {{ active_link('home', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors">{{ __('Главная') }}</a></li>
            <li><a href="{{ route('about') }}" class="block px-4 py-2 {{ active_link('about', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors">{{ __('Обо мне') }}</a></li>
            <li><a href="{{ route('projects.index') }}" class="block px-4 py-2 {{ active_link('projects', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors">{{ __('Проекты') }}</a></li>
            <li><a href="{{ route('posts.index') }}" class="block px-4 py-2 {{ active_link('posts', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors">{{ __('Посты') }}</a></li>
            <li><a href="{{ route('contacts') }}" class="block px-4 py-2 {{ active_link('contacts', 'text-gray-800') != '' ? 'text-gray-800' : 'text-gray-600' }} hover:text-gray-800 hover:underline transition-colors">{{ __('Контакты') }}</a></li>
        </ul>
    </nav>
</header>
