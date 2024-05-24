@extends('layouts.main')

@section('title')
    Регистрация
@endsection

@section('content')
    <x-content-wrapper class="bg-white">
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="max-w-md mx-auto bg-gray-100 shadow-lg rounded-lg p-6">
                    <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">{{ __('Регистрация') }}</h2>

                    <x-errors />

                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">{{ __('Имя') }}</label>
                            <input type="text" name="name" id="name"
                                class="w-full p-3 border border-gray-300 rounded mt-1 focus:outline-none focus:border-blue-500"
                                value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email"
                                class="w-full p-3 border border-gray-300 rounded mt-1 focus:outline-none focus:border-blue-500"
                                value="{{ old('email') }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="password" class="block text-gray-700">{{ __('Пароль') }}</label>
                            <input type="password" name="password" id="password"
                                class="w-full p-3 border border-gray-300 rounded mt-1 focus:outline-none focus:border-blue-500"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation"
                                class="block text-gray-700">{{ __('Подтвердите пароль') }}</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full p-3 border border-gray-300 rounded mt-1 focus:outline-none focus:border-blue-500"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="avatar" class="block text-gray-700">{{ __('Аватар') }}</label>
                            <input type="file" name="avatar" id="avatar" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="text-center">
                            <button type="submit"
                                class="w-full bg-blue-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-600 transition duration-300">
                                {{ __('Зарегистрироваться') }}
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-4">
                        <p class="text-gray-600">{{ __('Уже есть аккаунт?') }} <a href="{{ route('login') }}"
                                class="text-blue-600 hover:underline">{{ __('Войти') }}</a></p>
                    </div>
                </div>
            </div>
        </section>
    </x-content-wrapper>
@endsection
