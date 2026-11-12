@extends('layouts.main')

@section('title')
    Контакты
@endsection

@section('content')
    <x-breadcrumbs :breadcrumbs="$breadcrumbs" />

    <x-content-wrapper>
        <div class="mb-8 text-center">
            <p class="site-kicker mb-2">{{ __('Остаемся на связи') }}</p>
            <h1 class="text-3xl font-bold tracking-tight text-white md:text-4xl">{{ __('Контакты') }}</h1>
        </div>

        <div class="site-card mx-auto max-w-3xl p-6 md:p-8">
            <div class="flex items-center mb-6">
                <i class="fas fa-envelope site-accent mr-4 text-2xl"></i>
                <div>
                    <h4 class="text-lg font-semibold text-white">{{ __('Почта') }}</h4>
                    <p class="site-muted">
                        <a href="mailto:maksimzarubin20002000@gmail.com" class="site-link break-all">
                            maksimzarubin20002000@gmail.com
                        </a>
                    </p>
                </div>
            </div>

            <div class="flex items-center mb-6">
                <i class="fab fa-vk site-accent mr-4 text-2xl"></i>
                <div>
                    <h4 class="text-lg font-semibold text-white">{{ __('VK') }}</h4>
                    <p class="site-muted">
                        <a href="https://vk.com/maksimzarubin" class="site-link break-all">
                            https://vk.com/maksimzarubin
                        </a>
                    </p>
                </div>
            </div>

            <div class="flex items-center mb-6">
                <i class="fab fa-telegram-plane site-accent mr-4 text-2xl"></i>
                <div>
                    <h4 class="text-lg font-semibold text-white">{{ __('Telegram') }}</h4>
                    <p class="site-muted">
                        <a href="https://t.me/MmGranddd" class="site-link break-all">
                            https://t.me/MmGranddd
                        </a>
                    </p>
                </div>
            </div>

            <div class="flex items-center mb-6">
                <i class="fas fa-phone site-accent mr-4 text-2xl"></i>
                <div>
                    <h4 class="text-lg font-semibold text-white">{{ __('Телефон') }}</h4>
                    <p class="site-muted">
                        <a href="tel:+79235641698" class="site-link">
                            +7 (923) 564-1698
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </x-content-wrapper>

@endsection
