@extends('layouts.main')

@section('title')
    Сброс пароля
@endsection

@section('content')
    <x-content-wrapper>
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="site-card mx-auto max-w-md p-6 md:p-8">
                    <h1 class="mb-6 text-center text-3xl font-bold tracking-tight text-white">{{ __('Сброс пароля') }}</h1>

                    @if (session('status'))
                        <div class="mb-4 text-lime-300">
                            {{ session('status') }}
                        </div>
                    @endif

                    <x-errors />

                    <form method="POST" action="{{ route('password.update.form') }}">
                        @csrf
                        <div class="mb-4">
                            <x-label for="email" :value="__('Почта')" />
                            <x-input type="email" id="email" name="email" :value="old('email')" required />
                        </div>
                        <div class="mb-4">
                            <x-label for="password" :value="__('Пароль')" />
                            <x-input type="password" id="password" name="password" required />
                        </div>
                        <div class="mb-4">
                            <x-label for="password_confirmation" :value="__('Подтвердите пароль')" />
                            <x-input type="password" id="password_confirmation" name="password_confirmation" required />
                        </div>
												<div class="mb-4 flex justify-end">
													<x-link :href="route('login')" :text="__('Вернуться назад')" classes="text-sm ml-auto"/>
												</div>
                        <div class="text-center">
                            <x-button :route="''" :text="__('Сбросить пароль')" :type="'button'" :buttonType="'submit'"
                                :classes="'w-full'" />
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </x-content-wrapper>
@endsection
