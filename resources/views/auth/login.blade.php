@extends('layouts.main')

@section('title')
    Авторизация
@endsection

@section('content')
    <x-content-wrapper class="bg-white">
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="max-w-md mx-auto bg-gray-100 shadow-lg rounded-lg p-6">
                    <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">{{ __('Авторизация') }}</h2>

                    <x-errors />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <x-label for="email" :value="__('Почта')" />
                            <x-input type="email" id="email" name="email" :value="old('email')" required />
                        </div>
                        <div class="mb-4">
                            <x-label for="password" :value="__('Пароль')" />
                            <x-input type="password" id="password" name="password" required />
                        </div>
                        <div class="flex items-center justify-between mb-4">
                            <x-checkbox-label for="remember_me" name="remember" id="remember_me" :label="__('Запомнить меня')" />
                            <x-link :href="route('password.request.form')" :text="__('Забыли пароль?')" classes="text-sm"/>
                        </div>
                        <div class="text-center">
                            <x-button :route="''" :text="__('Войти')" :type="'button'" :buttonType="'submit'"
                                classes="w-full" />
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-gray-600">
                            {{ __('Еще нет аккаунта?') }}
                            <x-link :href="route('register')" :text="__('Зарегистрироваться')" />
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </x-content-wrapper>
@endsection
