<header class="site-header fixed top-0 left-0 w-full z-20 backdrop-blur-xl transition-all duration-300 ease-in-out">
    <div class="container mx-auto px-4 flex justify-between items-center py-3">
        <a href="{{ route('home') }}" class="site-brand text-xl font-bold no-underline transition-transform duration-300 hover:scale-105">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button id="menu-btn" type="button" aria-label="{{ __('Открыть меню') }}" data-open-label="{{ __('Открыть меню') }}" data-close-label="{{ __('Закрыть меню') }}" aria-controls="mobile-menu" aria-expanded="false" class="site-menu-button block lg:hidden focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>
        <nav class="hidden lg:block">
            <ul class="flex items-center space-x-1">
                <li><a href="{{ route('home') }}" @if (active_link('home')) aria-current="page" @endif class="site-nav-link {{ active_link('home') ? 'is-active' : '' }}">{{ __('Главная') }}</a></li>
                <li><a href="{{ route('about') }}" @if (active_link('about')) aria-current="page" @endif class="site-nav-link {{ active_link('about') ? 'is-active' : '' }}">{{ __('Обо мне') }}</a></li>
                <li><a href="{{ route('projects.index') }}" @if (active_link('projects')) aria-current="page" @endif class="site-nav-link {{ active_link('projects') ? 'is-active' : '' }}">{{ __('Проекты') }}</a></li>
                <li><a href="{{ route('posts.index') }}" @if (active_link('posts')) aria-current="page" @endif class="site-nav-link {{ active_link('posts') ? 'is-active' : '' }}">{{ __('Посты') }}</a></li>
                <li><a href="{{ route('contacts') }}" @if (active_link('contacts')) aria-current="page" @endif class="site-nav-link {{ active_link('contacts') ? 'is-active' : '' }}">{{ __('Контакты') }}</a></li>
                @auth
                    <li>
                        <a href="{{ route('profile') }}" @if (active_link('profile')) aria-current="page" @endif class="site-nav-link {{ active_link('profile') ? 'is-active' : '' }}">{{ __('Профиль') }}</a>
                    </li>
                @else
                    <li><a href="{{ route('login') }}" @if (active_link('login')) aria-current="page" @endif class="site-nav-link {{ active_link('login') ? 'is-active' : '' }}">{{ __('Вход') }}</a></li>
                @endauth
            </ul>
        </nav>
    </div>
</header>
<nav class="site-mobile-menu lg:hidden fixed top-0 left-0 w-full z-10 pt-16 pb-3 backdrop-blur-xl transition-transform duration-300 ease-in-out transform -translate-y-full" id="mobile-menu" aria-label="{{ __('Основная навигация') }}" aria-hidden="true" inert>
    <ul class="flex flex-col px-4">
        <li><a href="{{ route('home') }}" @if (active_link('home')) aria-current="page" @endif class="site-nav-link block {{ active_link('home') ? 'is-active' : '' }}">{{ __('Главная') }}</a></li>
        <li><a href="{{ route('about') }}" @if (active_link('about')) aria-current="page" @endif class="site-nav-link block {{ active_link('about') ? 'is-active' : '' }}">{{ __('Обо мне') }}</a></li>
        <li><a href="{{ route('projects.index') }}" @if (active_link('projects')) aria-current="page" @endif class="site-nav-link block {{ active_link('projects') ? 'is-active' : '' }}">{{ __('Проекты') }}</a></li>
        <li><a href="{{ route('posts.index') }}" @if (active_link('posts')) aria-current="page" @endif class="site-nav-link block {{ active_link('posts') ? 'is-active' : '' }}">{{ __('Посты') }}</a></li>
        <li><a href="{{ route('contacts') }}" @if (active_link('contacts')) aria-current="page" @endif class="site-nav-link block {{ active_link('contacts') ? 'is-active' : '' }}">{{ __('Контакты') }}</a></li>
        @auth
            <li>
                <a href="{{ route('profile') }}" @if (active_link('profile')) aria-current="page" @endif class="site-nav-link block {{ active_link('profile') ? 'is-active' : '' }}">{{ __('Профиль') }}</a>
            </li>
        @else
            <li><a href="{{ route('login') }}" @if (active_link('login')) aria-current="page" @endif class="site-nav-link block {{ active_link('login') ? 'is-active' : '' }}">{{ __('Вход') }}</a></li>
        @endauth
    </ul>
</nav>