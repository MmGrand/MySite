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

							<x-errors />

							<form method="POST" action="{{ route('password.email') }}">
									@csrf
									<div class="mb-4">
											<x-label for="email" :value="__('Укажите вашу почту')" />
											<x-input type="email" id="email" name="email" :value="old('email')" required />
									</div>
									<div class="text-center">
											<x-button :route="''" :text="__('Отправить ссылку для сброса пароля')" :type="'button'" :buttonType="'submit'" classes="w-full" />
									</div>
							</form>
					</div>
			</div>
	</section>
</x-content-wrapper>
@endsection
