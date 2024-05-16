@extends('layouts.main')

@section('title')
    Контакты
@endsection

@section('content')
    <x-breadcrumbs :breadcrumbs="$breadcrumbs" />

    <x-content-wrapper class="bg-white">
        <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">{{ __('Контакты') }}</h2>

        <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden p-6">
            <div class="flex items-center mb-6">
                <i class="fas fa-envelope text-blue-500 text-2xl mr-4"></i>
                <div>
                    <h4 class="text-xl font-semibold text-gray-800">{{ __('Почта') }}</h4>
                    <p class="text-gray-600"><a href="mailto:maksimzarubin20002000@gmail.com"
                            class="text-blue-500 hover:underline">maksimzarubin20002000@gmail.com</a></p>
                </div>
            </div>

            <div class="flex items-center mb-6">
                <i class="fab fa-vk text-blue-500 text-2xl mr-4"></i>
                <div>
                    <h4 class="text-xl font-semibold text-gray-800">{{ __('VK') }}</h4>
                    <p class="text-gray-600"><a href="https://vk.com/maksimzarubin"
                            class="text-blue-500 hover:underline">https://vk.com/maksimzarubin</a></p>
                </div>
            </div>

            <div class="flex items-center mb-6">
                <i class="fab fa-telegram-plane text-blue-500 text-2xl mr-4"></i>
                <div>
                    <h4 class="text-xl font-semibold text-gray-800">{{ __('Telegram') }}</h4>
                    <p class="text-gray-600"><a href="https://t.me/MmGranddd"
                            class="text-blue-500 hover:underline">https://t.me/MmGranddd</a></p>
                </div>
            </div>

            <div class="flex items-center mb-6">
                <i class="fas fa-phone text-blue-500 text-2xl mr-4"></i>
                <div>
                    <h4 class="text-xl font-semibold text-gray-800">{{ __('Телефон') }}</h4>
                    <p class="text-gray-600"><a href="tel:+79235641698" class="text-blue-500 hover:underline">+7 (923)
                            564-1698</a></p>
                </div>
            </div>
        </div>
    </x-content-wrapper>
@endsection
