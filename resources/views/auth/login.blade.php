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

							@if ($errors->any())
									<div class="mb-4">
											<ul class="list-disc list-inside text-red-600">
													@foreach ($errors->all() as $error)
															<li>{{ $error }}</li>
													@endforeach
											</ul>
									</div>
							@endif

							<form method="POST" action="{{ route('login') }}">
									@csrf
									<div class="mb-4">
											<label for="email" class="block text-gray-700">{{ __('Почта') }}</label>
											<input type="email" name="email" id="email" class="w-full p-3 border border-gray-300 rounded mt-1 focus:outline-none focus:border-blue-500" value="{{ old('email') }}" required autofocus>
									</div>
									<div class="mb-4">
											<label for="password" class="block text-gray-700">{{ __('Пароль') }}</label>
											<input type="password" name="password" id="password" class="w-full p-3 border border-gray-300 rounded mt-1 focus:outline-none focus:border-blue-500" required>
									</div>
									<div class="flex items-center justify-between mb-4">
											<label for="remember_me" class="flex items-center">
													<input type="checkbox" name="remember" id="remember_me" class="mr-2">
													<span class="text-sm text-gray-600">{{ __('Запомнить меня') }}</span>
											</label>
											<a href="{{ route('password.request.form') }}" class="text-sm text-blue-600 hover:underline">{{ __('Забыли пароль?') }}</a>
									</div>
									<div class="text-center">
											<button type="submit" class="w-full bg-blue-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-600 transition duration-300">
													{{ __('Войти') }}
											</button>
									</div>
							</form>
					</div>
			</div>
	</section>
</x-content-wrapper>
@endsection
