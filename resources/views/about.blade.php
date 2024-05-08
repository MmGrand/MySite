@extends('layouts.main')

@section('title')
	Обо мне
@endsection

@section('content')
	<nav aria-label="breadcrumb" class="pt-16 pb-5 px-4">
		<ol class="breadcrumb flex text-sm text-gray-500">
			@foreach ($breadcrumbs as $breadcrumb)
					<li class="mr-2">
							@if (!$loop->last)
									<a href="{{ $breadcrumb['href'] }}" class="text-gray-500 hover:text-gray-900 hover:underline">{{ $breadcrumb['title'] }}</a>
									<span class="text-gray-500 mx-2">/</span>
							@else
									<span class="text-gray-900">{{ $breadcrumb['title'] }}</span>
							@endif
					</li>
			@endforeach
		</ol>
	</nav>
	<section class="bg-white py-12">
		<div class="container mx-auto px-4">
			<div class="flex items-center justify-center flex-col">
				<img class="lg:w-2/6 md:w-3/6 w-5/6 mb-10 object-cover object-center rounded rounded-full" src="{{ asset('images/main_avatar.jpg') }}" alt="avatar">
				<div class="text-center lg:w-2/3 w-full">
						<h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">Привет, я Максим 👋</h1>
						<p class="mb-8 leading-relaxed text-gray-600 body-font">Я Fullstack разработчик. Началось всё с того, что в университете я не знал куда мне идти дальше, и я решил разрабатывать сайты. Изучал разные языки программирования, проходил курсы, но пока остановился на PHP и его фреймворке Laravel. Во Frontend направлении выбрал Vue JS. С 2022 года осени работаю, паралелльно изучаю разные возможности разработки и прогрессирую с каждым днём.</p>
				</div>
				<h2 class="text-3xl font-bold text-center mb-4">Мой стек разработки 🛠</h2>
				<div class="flex flex-wrap justify-center gap-4 mt-5">
						<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" class="w-10 h-10 sm:w-12 sm:h-12" alt="html5 logo" />
						<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" class="w-10 h-10 sm:w-12 sm:h-12" alt="css3 logo" />
						<img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/laravel/laravel-original.svg" class="w-10 h-10 sm:w-12 sm:h-12" alt="laravel logo" />
						<img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/vuejs/vuejs-original.svg" class="w-10 h-10 sm:w-12 sm:h-12" alt="vuejs logo" />
						<img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/docker/docker-original.svg" class="w-10 h-10 sm:w-12 sm:h-12" alt="docker logo" />
						<img src="https://cdn.jsdelivr.net/gh/devicons/devicon@latest/icons/mysql/mysql-original.svg" class="w-10 h-10 sm:w-12 sm:h-12" alt="mysql logo" />
				</div>
		</div>
		</div>
	</section>
@endsection