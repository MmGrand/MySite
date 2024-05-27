@extends('layouts.main')

@section('title')
    Сброс пароля
@endsection

@section('content')
    <x-content-wrapper class="bg-white">
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="max-w-md mx-auto bg-gray-100 shadow-lg rounded-lg p-6">
                    <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">{{ __('Сброс пароля') }}</h2>

                    <x-errors />

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

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
                        <div class="text-center">
                            <x-button :route="''" :text="__('Сбросить пароль')" :type="'button'" :buttonType="'submit'"
                                classes="w-full" />
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </x-content-wrapper>
@endsection
