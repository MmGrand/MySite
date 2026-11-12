@extends('layouts.main')

@section('title')
    Профиль
@endsection

@section('content')
    <x-content-wrapper>
        <section class="py-12">
            <div class="container mx-auto px-4">
                <div class="site-card mx-auto max-w-3xl p-6 md:p-8">
                    <p class="site-kicker mb-2 text-center">{{ __('Настройки аккаунта') }}</p>
                    <h1 class="mb-6 text-center text-3xl font-bold tracking-tight text-white">{{ __('Личный кабинет') }}</h1>

                    <div class="site-panel mb-6 p-6 text-center">
                        @if ($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}" class="site-avatar mx-auto h-32 w-32 rounded-full shadow-md">
                        @else
                            <img src="{{ asset('images/default-avatar.png') }}" alt="{{ $user->name }}" class="site-avatar mx-auto h-32 w-32 rounded-full shadow-md">
                        @endif
                        <h3 class="mt-4 text-2xl font-semibold text-white">{{ $user->name }}</h3>
                        <p class="site-muted mt-2">{{ $user->email }}</p>

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

                    <div class="site-panel mb-8 p-6" id="comments-container">
                        <h3 class="mb-4 text-2xl font-bold text-white">{{ __('Мои комментарии') }}</h3>
                        @include('profile.comments', ['comments' => $comments])
                    </div>
                </div>
            </div>
        </section>
    </x-content-wrapper>
@endsection
