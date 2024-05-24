@extends('layouts.main')

@section('title')
    Профиль
@endsection

@section('content')
    @if (session('success'))
        <div class="bg-green-500 text-white text-center pt-20 pb-5 px-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <x-content-wrapper class="bg-white">
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto bg-gray-100 shadow-lg rounded-lg p-6">
                    <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">{{ __('Личный кабинет') }}</h2>
                    <div class="text-center mb-6">
                        @if ($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}"
                                class="w-24 h-24 rounded-full mx-auto">
                        @else
                            <img src="{{ asset('images/default-avatar.png') }}" alt="{{ $user->name }}"
                                class="w-24 h-24 rounded-full mx-auto">
                        @endif
                        <h3 class="text-xl font-semibold text-gray-800 mt-4">{{ $user->name }}</h3>

                        <form method="POST" action="{{ route('profile.update_avatar') }}" enctype="multipart/form-data"
                            class="mt-4">
                            @csrf
                            <div class="mb-4">
                                <label for="avatar" class="block text-gray-700">{{ __('Обновить фото') }}</label>
                                <input type="file" name="avatar" id="avatar"
                                    class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <button type="submit"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition duration-300">{{ __('Обновить') }}</button>
                            </div>
                        </form>
                    </div>

                    <div class="text-center mb-6">
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="px-4 py-2 bg-red-500 text-white rounded-lg shadow hover:bg-red-600 transition duration-300">{{ __('Выход') }}</button>
                        </form>
                    </div>

                    <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6 mb-8" id="comments-container">
                        <h3 class="text-2xl font-bold mb-4 text-gray-900">{{ __('Мои комментарии') }}</h3>
                        @include('profile.comments', ['comments' => $comments])
                    </div>
                </div>
            </div>
        </section>
    </x-content-wrapper>
@endsection
