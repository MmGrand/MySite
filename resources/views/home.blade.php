@extends('layouts.main')

@section('title')
	Главная
@endsection

@section('content')
		<section class="bg-white py-12">
			<div class="container mx-auto px-4">
				<h2 class="text-3xl font-bold text-center mb-6">Мои проекты</h2>
				<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
						@foreach ($projects as $project)
								<div class="overflow-hidden shadow-lg border border-slate-100 rounded-3xl hover:shadow-2xl transition-shadow duration-300">
										<a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer">
												<img src="{{ $project->preview_image }}" alt="{{ $project->title }}" class="w-full h-48 object-cover">
												<div class="p-5">
														<h3 class="text-xl font-semibold">{{ $project->title }}</h3>
														<p class="text-gray-600">{{ $project->preview_content }}</p>
												</div>
										</a>
								</div>
						@endforeach
				</div>
				<div class="text-center mt-8">
						<a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
								Все проекты
						</a>
				</div>
			</div>
	</section>
	<section class="bg-gray-100 py-12">
		<div class="container mx-auto px-4">
			<h2 class="text-3xl font-bold text-center mb-6 text-gray-800">Мои посты</h2>
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
					@foreach ($posts as $post)
							<div class="overflow-hidden shadow-lg border border-slate-100 rounded-3xl hover:shadow-2xl transition-shadow duration-300">
									<a href="{{ url('/posts/'.$post->slug) }}" target="_blank" rel="noopener noreferrer">
											<img src="{{ $post->preview_image }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
											<div class="p-5">
												<h3 class="text-xl text-gray-800 font-semibold">{{ $post->title }}</h3>
												<p class="text-gray-600 mb-2">{{ $post->preview_content }}</p>
												<div class="flex items-center text-gray-500 text-sm mt-2">
														<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="w-4 h-4 mr-1">
																<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-3-7a9 9 0 00-9 9 9 9 0 0018 0 9 9 0 00-9-9z" />
														</svg>
														<span>{{ $post->views_count }} просмотров</span>
												</div>
											</div>
									</a>
							</div>
					@endforeach
			</div>
			<div class="text-center mt-8">
					<a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
							Все посты
					</a>
			</div>
		</div>
</section>
@endsection