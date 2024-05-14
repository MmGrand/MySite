@extends('layouts.main')

@section('title')
	{{ __('Мои посты') }}
@endsection

@section('content')
<x-breadcrumbs :breadcrumbs="$breadcrumbs" />

<section class="bg-white py-12">
	<div class="container mx-auto px-4">
		<h2 class="text-3xl font-bold text-center mb-6 text-gray-800">{{ __('Мои посты') }}</h2>
        <div class="flex justify-center mb-8">
            <div class="relative inline-block w-full sm:w-auto mr-4">
                <select onchange="updateFilter('category', this.value);" class="block w-full appearance-none bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 transition-colors duration-300 shadow-md hover:shadow-lg cursor-pointer">
                    <option value="" {{ request('category') ? '' : 'selected' }}>{{ __('Все категории') }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }} class="cursor-pointer">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7 10l5 5 5-5H7z"/></svg>
                </div>
            </div>
            <div class="relative inline-block w-full sm:w-auto">
                <select onchange="updateFilter('tag', this.value);" class="block w-full appearance-none bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500 transition-colors duration-300 shadow-md hover:shadow-lg cursor-pointer">
                    <option value="" {{ request('tag') ? '' : 'selected' }}>{{ __('Все теги') }}</option>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->slug }}" {{ request('tag') == $tag->slug ? 'selected' : '' }} class="cursor-pointer">
                            {{ $tag->name }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M7 10l5 5 5-5H7z"/></svg>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach ($posts as $post)
                <div class="overflow-hidden shadow-lg border border-slate-100 rounded-3xl hover:shadow-2xl transition-shadow duration-300 relative">
                    <a href="{{ route('posts.show', $post->slug) }}">
                        <img src="{{ $post->preview_image }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
                        <div class="absolute top-0 left-0 bg-gradient-to-r from-green-500 to-blue-500 text-white text-sm px-3 py-1.5 rounded-br-2xl shadow">
                            <i class="fas fa-layer-group mr-1"></i>
                            {{ $post->category->name }}
                        </div>
                        <div class="p-5">
                            <h3 class="text-xl text-gray-800 font-semibold">{{ $post->title }}</h3>
                            <p class="text-gray-600 mb-2">{{ $post->preview_content }}</p>
                            <div class="flex flex-wrap gap-2 mt-2 mb-6">
                                @foreach ($post->tags as $tag)
                                    <span class="bg-green-200 hover:bg-green-300 text-green-800 hover:text-white text-xs font-medium px-2 py-1 rounded-full transition-colors duration-300">
                                        {{ $tag->name }}
                                    </span>
                                @endforeach
                            </div>
                            <div class="flex items-center gap-2 text-gray-500 text-sm mt-2 absolute bottom-3 right-3">
																<i class="fas fa-eye"></i>
                                <span>{{ $post->views_count }} {{ __('просмотров') }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $posts->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</section>

@once
    @push('js')
		<script>
			function updateFilter(type, value) {
					const params = new URLSearchParams(window.location.search);
					if (value) {
							params.set(type, value);
					} else {
							params.delete(type);
					}
					window.location.search = params.toString();
			}
		</script>
    @endpush
@endonce