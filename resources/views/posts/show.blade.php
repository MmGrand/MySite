@extends('layouts.main')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <x-breadcrumbs :breadcrumbs="$breadcrumbs" />

    <x-content-wrapper class="bg-white">
        <article class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
            <img src="{{ $post->main_image }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
            <div class="p-6">
                <h1 class="text-4xl font-bold mb-4 text-gray-900">{{ $post->title }}</h1>
                <div class="flex items-center mb-4 text-gray-600">
                    <span
                        class="bg-blue-500 text-white text-xs font-bold mr-2 px-2.5 py-0.5 rounded">{{ $post->category->name }}</span>
                    <span class="mr-4"><i class="fas fa-eye"></i> {{ $post->views_count }} просмотров</span>
                </div>
                <div class="prose max-w-none text-gray-800">
                    {!! $post->main_content !!}
                </div>
                <div class="mt-6">
                    <h3 class="text-xl font-bold mb-2 text-gray-900">Теги:</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($post->tags as $tag)
                            <span
                                class="bg-green-200 hover:bg-green-300 text-green-800 hover:text-white text-xs font-medium px-2 py-1 rounded-full transition-colors duration-300">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </article>

        <section class="max-w-3xl mx-auto mt-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-900">{{ __('Комментарии') }}</h2>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6 mb-8">
                <form id="comment-form" method="POST" action="{{ route('comments.store') }}">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div class="mb-4">
                        <label for="author" class="block text-gray-700">{{ __('Имя') }}</label>
                        <input type="text" name="author" id="author"
                            class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                    <div class="mb-4">
                        <label for="content" class="block text-gray-700">{{ __('Комментарий') }}</label>
                        <textarea name="content" id="content" rows="4"
                            class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                    </div>
                    <div>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">{{ __('Отправить') }}</button>
                    </div>
                </form>
            </div>

            @if ($comments->isNotEmpty())
                <div id="comments-container" class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
                    @foreach ($comments as $comment)
                        <div class="mb-4" id="comment-{{ $comment->id }}">
                            <div class="text-sm text-gray-500">{{ $comment->author }} -
                                {{ $comment->created_at->format('d.m.Y, H:i') }}</div>
                            <div class="mt-1 text-gray-700">{{ $comment->content }}</div>
                            <button onclick="toggleReplyForm({{ $comment->id }});"
                                class="text-blue-500 text-sm hover:underline">{{ __('Ответить') }}</button>
                            <div id="reply-form-{{ $comment->id }}" class="hidden mt-4">
                                <form class="reply-form" method="POST" action="{{ route('comments.store') }}">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                    <div class="mb-4">
                                        <label for="author-{{ $comment->id }}"
                                            class="block text-gray-700">{{ __('Имя') }}</label>
                                        <input type="text" name="author" id="author-{{ $comment->id }}"
                                            class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="content-{{ $comment->id }}"
                                            class="block text-gray-700">{{ __('Комментарий') }}</label>
                                        <textarea name="content" id="content-{{ $comment->id }}" rows="2"
                                            class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                                    </div>
                                    <div>
                                        <button type="submit"
                                            class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">{{ __('Отправить') }}</button>
                                    </div>
                                </form>
                            </div>
                            <div class="ml-4 mt-4" id="child-comments-{{ $comment->id }}">
                                @foreach ($comment->children as $child)
                                    <div class="mb-4" id="comment-{{ $child->id }}">
                                        <div class="text-sm text-gray-500">{{ $child->author }} -
                                            {{ $child->created_at->format('d.m.Y, H:i') }}</div>
                                        <div class="mt-1 text-gray-700">{{ $child->content }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </section>
    </x-content-wrapper>
@endsection

@once
    @push('js')
        <script>
            function toggleReplyForm(commentId) {
                document.getElementById('reply-form-' + commentId).classList.toggle('hidden');
            }

            $(document).ready(function() {
                $('#comment-form').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: $(this).attr('action'),
                        method: $(this).attr('method'),
                        data: $(this).serialize(),
                        success: function(response) {
                            if (response.success) {
                                $('#comment-form')[0].reset();
                                $('#comments-container').prepend(
                                    `<div class="mb-4" id="comment-${response.comment.id}">
																	<div class="text-sm text-gray-500">${response.comment.author} - ${new Date(response.comment.created_at).toLocaleString('ru-RU', { hour: '2-digit', minute: '2-digit', year: 'numeric', month: '2-digit', day: '2-digit', timeZone: 'Europe/Moscow' })}</div>
																	<div class="mt-1 text-gray-700">${response.comment.content}</div>
																	<button onclick="toggleReplyForm(${response.comment.id});" class="text-blue-500 text-sm hover:underline">{{ __('Ответить') }}</button>
																	<div id="reply-form-${response.comment.id}" class="hidden mt-4">
																			<form class="reply-form" method="POST" action="{{ route('comments.store') }}">
																					@csrf
																					<input type="hidden" name="post_id" value="${ response.comment.post_id }">
																					<input type="hidden" name="parent_id" value="${response.comment.id}">
																					<div class="mb-4">
																							<label for="author-${response.comment.id}" class="block text-gray-700">{{ __('Имя') }}</label>
																							<input type="text" name="author" id="author-${response.comment.id}" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
																					</div>
																					<div class="mb-4">
																							<label for="content-${response.comment.id}" class="block text-gray-700">{{ __('Комментарий') }}</label>
																							<textarea name="content" id="content-${response.comment.id}" rows="2" class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
																					</div>
																					<div>
																							<button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600">{{ __('Отправить') }}</button>
																					</div>
																			</form>
																	</div>
																	<div class="ml-4 mt-4" id="child-comments-${response.comment.id}"></div>
															</div>`
                                );
                            }
                        }
                    });
                });

                $(document).on('submit', '.reply-form', function(e) {
                    e.preventDefault();
                    var form = $(this);
                    $.ajax({
                        url: form.attr('action'),
                        method: form.attr('method'),
                        data: form.serialize(),
                        success: function(response) {
                            if (response.success) {
                                form[0].reset();
                                form.closest('.reply-form').toggleClass('hidden');
                                $('#child-comments-' + response.comment.parent_id).append(
                                    `<div class="mb-4" id="comment-${response.comment.id}">
																	<div class="text-sm text-gray-500">${response.comment.author} - ${new Date(response.comment.created_at).toLocaleString('ru-RU', { hour: '2-digit', minute: '2-digit', year: 'numeric', month: '2-digit', day: '2-digit', timeZone: 'Europe/Moscow' })}</div>
																	<div class="mt-1 text-gray-700">${response.comment.content}</div>
															</div>`
                                );
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
@endonce
