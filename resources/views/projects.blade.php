@extends('layouts.main')

@section('title')
	Мои проекты
@endsection

@section('content')
	<nav aria-label="breadcrumb" class="py-5 px-4">
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
@endsection