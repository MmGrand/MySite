@extends('layouts.main')

@section('title')
    Авторизация
@endsection

@section('content')
    <x-content-wrapper>
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="site-card mx-auto max-w-md p-6 md:p-8">
                    <p class="site-kicker mb-2 text-center">{{ __('Добро пожаловать') }}</p>
                    <h1 class="mb-6 text-center text-3xl font-bold tracking-tight text-white">{{ __('Авторизация') }}</h1>

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
                        <p class="site-muted">
                            {{ __('Еще нет аккаунта?') }}
                            <x-link :href="route('register')" :text="__('Зарегистрироваться')" />
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </x-content-wrapper>
@endsection
