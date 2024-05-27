@extends('layouts.main')

@section('title')
    Профиль
@endsection

@section('content')
    <x-content-wrapper class="bg-white">
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto bg-gray-100 shadow-lg rounded-lg p-6">
                    <h2 class="text-3xl font-bold text-center mb-6 text-gray-800">{{ __('Личный кабинет') }}</h2>

                    <div class="text-center mb-6 bg-white p-6 rounded-lg shadow-md">
                        @if ($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full mx-auto shadow-md">
                        @else
                            <img src="{{ asset('images/default-avatar.png') }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full mx-auto shadow-md">
                        @endif
                        <h3 class="text-2xl font-semibold text-gray-900 mt-4">{{ $user->name }}</h3>
                        <p class="text-gray-600 mt-2">{{ $user->email }}</p>

                        <form method="POST" action="{{ route('profile.update_avatar') }}" enctype="multipart/form-data" class="mt-4" id="avatarForm">
                            @csrf
                            <div class="mb-4">
                                <x-label for="avatar" :value="__('Сменить аватар')" classes="text-lg font-semibold mb-2" />
                                <x-file-input :name="'avatar'" :id="'avatar_update'" :displayText="__('Нажмите, чтобы выбрать фото')" classes="mt-1" />
                                <p id="avatarError" class="text-red-500 text-sm mt-2 hidden">{{ __('Пожалуйста, выберите фото.') }}</p>
                                @error('avatar')
                                    <p id="avatarErrorServer" class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <x-button :route="''" :text="__('Обновить')" :type="'button'" :buttonType="'submit'" classes="" />
                            </div>
                        </form>

                        <div class="text-center mt-4">
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <x-link :type="'button'" :buttonType="'submit'" :text="__('Выйти')" />
                            </form>
                        </div>
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
