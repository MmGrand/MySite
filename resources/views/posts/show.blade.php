@extends('layouts.main')

@section('title')
	{{ $post->title }}
@endsection

@section('content')
	<x-breadcrumbs :breadcrumbs="$breadcrumbs" />

	<section class="bg-white py-12">
    <div class="container mx-auto px-4">
			<article class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
				<img src="{{ $post->main_image }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
				<div class="p-6">
						<h1 class="text-4xl font-bold mb-4 text-gray-900">{{ $post->title }}</h1>
						<div class="flex items-center mb-4 text-gray-600">
								<span class="bg-blue-500 text-white text-xs font-bold mr-2 px-2.5 py-0.5 rounded">{{ $post->category->name }}</span>
								<span class="mr-4"><i class="fas fa-eye"></i> {{ $post->views_count }} просмотров</span>
						</div>
						<div class="prose max-w-none text-gray-800">
								{!! $post->main_content !!}
						</div>
						<div class="mt-6">
								<h3 class="text-xl font-bold mb-2 text-gray-900">Теги:</h3>
								<div class="flex flex-wrap gap-2">
										@foreach ($post->tags as $tag)
												<span class="bg-green-200 hover:bg-green-300 text-green-800 hover:text-white text-xs font-medium px-2 py-1 rounded-full transition-colors duration-300">
														{{ $tag->name }}
												</span>
										@endforeach
								</div>
						</div>
				</div>
			</article>
    </div>
	</section>
@endsection