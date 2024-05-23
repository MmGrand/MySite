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

							@if (session('status'))
									<div class="mb-4 text-green-600">
											{{ session('status') }}
									</div>
							@endif

							<form method="POST" action="{{ route('password.email') }}">
									@csrf
									<div class="mb-4">
											<label for="email" class="block text-gray-700">{{ __('Email') }}</label>
											<input type="email" name="email" id="email" class="w-full p-3 border border-gray-300 rounded mt-1 focus:outline-none focus:border-blue-500" value="{{ old('email') }}" required>
									</div>
									<div class="text-center">
											<button type="submit" class="w-full bg-blue-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-600 transition duration-300">
													{{ __('Отправить ссылку для сброса пароля') }}
											</button>
									</div>
							</form>
					</div>
			</div>
	</section>
</x-content-wrapper>
@endsection
