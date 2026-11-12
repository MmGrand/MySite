@extends('layouts.main')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <x-breadcrumbs :breadcrumbs="$breadcrumbs" />

    <x-content-wrapper>
        <article class="site-card mx-auto max-w-4xl">
            <img src="{{ Str::startsWith($post->main_image, 'http') ? $post->main_image : Storage::url($post->main_image) }}"
                alt="{{ $post->title }}" class="h-64 w-full object-cover md:h-96">
            <div class="p-6 md:p-10">
                <h1 class="mb-5 text-3xl font-bold leading-tight tracking-tight text-white md:text-5xl">{{ $post->title }}</h1>
                <div class="site-muted mb-8 flex flex-wrap items-center gap-3 text-sm">
                    <span class="site-tag">{{ $post->category->name }}</span>
                    <span><i class="fas fa-eye mr-1" aria-hidden="true"></i> {{ $post->views_count }} просмотров</span>
                </div>
                <div class="site-prose max-w-none">
                    {!! $post->main_content !!}
                </div>
                <div class="mt-10 border-t site-divider pt-6">
                    <h3 class="mb-3 text-lg font-bold text-white">Теги:</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach ($post->tags as $tag)
                            <span class="site-tag">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </article>

        <section class="max-w-3xl mx-auto mt-8">
            <h2 class="mb-4 text-2xl font-bold text-white">{{ __('Комментарии') }}</h2>
            <div class="site-panel mb-6 p-5 md:p-6">
                @auth
                    <form id="comment-form" method="POST" action="{{ route('comments.store') }}">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="mb-4">
                            <label for="content" class="site-label mb-2">{{ __('Комментарий') }}</label>
                            <textarea name="content" id="content" rows="4"
                                class="site-textarea" required></textarea>
                        </div>
                        <div>
                            <x-button :route="''" :text="__('Отправить')" :type="'button'" :buttonType="'submit'"
                                :classes="''" />
                        </div>
                    </form>
                @else
                    <p class="site-muted">{{ __('Для того чтобы оставить комментарий, пожалуйста,') }} <a
                            href="{{ route('login') }}" class="site-link">{{ __('войдите') }}</a>.</p>
                @endauth
            </div>

            <div id="comments-container" class="site-panel p-5 md:p-6">
                @if ($comments->isNotEmpty())
                    @foreach ($comments as $comment)
                        <div class="site-comment mb-5" id="comment-{{ $comment->id }}">
                            <div class="flex items-start">
                                <img src="{{ $comment->author->avatar ? Storage::url($comment->author->avatar) : asset('images/default-avatar.png') }}"
                                    alt="{{ $comment->author->name }}" class="site-avatar mr-4 h-10 w-10 rounded-full">
                                <div class="flex-1 w-full">
                                    <div class="site-muted text-sm">{{ $comment->author->name }} -
                                        {{ $comment->created_at->format('d.m.Y, H:i') }}</div>
                                    <div class="mt-1 whitespace-pre-wrap text-slate-200">{{ $comment->content }}</div>
                                    @auth
                                        <button onclick="toggleReplyForm({{ $comment->id }});"
                                            class="site-link mt-2 text-sm">{{ __('Ответить') }}</button>
                                    @endauth
                                    <div id="reply-form-{{ $comment->id }}" class="hidden mt-4 w-full">
                                        <form class="reply-form w-full" method="POST"
                                            action="{{ route('comments.store') }}">
                                            @csrf
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                            <div class="mb-4">
                                                <label for="content-{{ $comment->id }}"
                                                    class="site-label mb-2">{{ __('Комментарий') }}</label>
                                                <textarea name="content" id="content-{{ $comment->id }}" rows="2"
                                                    class="site-textarea" required></textarea>
                                            </div>
                                            <div>
                                                <x-button :route="''" :text="__('Отправить')" :type="'button'"
                                                    :buttonType="'submit'" :classes="''" />
                                            </div>
                                        </form>
                                    </div>
                                    <div class="ml-4 mt-4" id="child-comments-{{ $comment->id }}">
                                        @foreach ($comment->children as $child)
                                            <div class="site-comment mb-4" id="comment-{{ $child->id }}">
                                                <div class="flex items-start">
                                                    <img src="{{ $child->author->avatar ? Storage::url($child->author->avatar) : asset('images/default-avatar.png') }}"
                                                        alt="{{ $child->author->name }}"
                                                        class="site-avatar mr-4 h-10 w-10 rounded-full">
                                                    <div class="flex-1 w-full">
                                                        <div class="site-muted text-sm">{{ $child->author->name }} -
                                                            {{ $child->created_at->format('d.m.Y, H:i') }}</div>
                                                        <div class="mt-1 whitespace-pre-wrap text-slate-200">{{ $child->content }}</div>
                                                        {{-- @auth
                                                            <button onclick="toggleReplyForm({{ $child->id }});"
                                                                class="text-blue-500 text-sm hover:underline">{{ __('Ответить') }}</button>
                                                            <div id="reply-form-{{ $child->id }}"
                                                                class="hidden mt-4 w-full">
                                                                <form class="reply-form w-full" method="POST"
                                                                    action="{{ route('comments.store') }}">
                                                                    @csrf
                                                                    <input type="hidden" name="post_id"
                                                                        value="{{ $post->id }}">
                                                                    <input type="hidden" name="parent_id"
                                                                        value="{{ $child->id }}">
                                                                    <div class="mb-4">
                                                                        <label for="content-{{ $child->id }}"
                                                                            class="block text-gray-700">{{ __('Комментарий') }}</label>
                                                                        <textarea name="content" id="content-{{ $child->id }}" rows="2"
                                                                            class="w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
                                                                    </div>
                                                                    <div>
                                                                        <x-button :route="''" :text="__('Отправить')"
                                                                            :type="'button'" :buttonType="'submit'"
                                                                            :classes="''" />
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        @endauth --}}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p id="empty-comment-state" class="site-muted">{{ __('Пока нет комментариев. Будьте первым!') }}</p>
                @endif
            </div>
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
                                $('#empty-comment-state').remove();
                                const authorName = response.comment.author ? response.comment.author
                                    .name : 'Аноним';
                                const authorAvatar = response.comment.author && response.comment
                                    .author.avatar ?
                                    `/storage/${response.comment.author.avatar}` :
                                    '/images/default-avatar.png';
                                const newCommentHtml = `
                                <div class="site-comment mb-5" id="comment-${response.comment.id}">
                                    <div class="flex items-start">
                                        <img src="${authorAvatar}" alt="${authorName}" class="site-avatar mr-4 h-10 w-10 rounded-full">
                                        <div class="flex-1 w-full">
                                            <div class="site-muted text-sm">${authorName} - ${new Date(response.comment.created_at).toLocaleString('ru-RU', { hour: '2-digit', minute: '2-digit', year: 'numeric', month: '2-digit', day: '2-digit', timeZone: 'Europe/Moscow' })}</div>
                                            <div class="mt-1 whitespace-pre-wrap text-slate-200">${response.comment.content}</div>
                                            <button onclick="toggleReplyForm(${response.comment.id});" class="site-link mt-2 text-sm">{{ __('Ответить') }}</button>
                                            <div id="reply-form-${response.comment.id}" class="hidden mt-4 w-full">
                                                <form class="reply-form w-full" method="POST" action="{{ route('comments.store') }}">
                                                    @csrf
                                                    <input type="hidden" name="post_id" value="${response.comment.post_id}">
                                                    <input type="hidden" name="parent_id" value="${response.comment.id}">
                                                    <div class="mb-4">
                                                        <label for="content-${response.comment.id}" class="site-label mb-2">{{ __('Комментарий') }}</label>
                                                        <textarea name="content" id="content-${response.comment.id}" rows="2"
                                                            class="site-textarea"
                                                            required></textarea>
                                                    </div>
                                                    <div>
                                                        <x-button :route="''" :text="__('Отправить')" :type="'button'"
                                                            :buttonType="'submit'" :classes="''" />
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="ml-4 mt-4" id="child-comments-${response.comment.id}"></div>
                                        </div>
                                    </div>
                                </div>
                            `;

                                $('#comments-container').prepend(newCommentHtml);
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 401) {
                                alert('Вы должны быть авторизованы для добавления комментария.');
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
                                form.closest('[id^="reply-form-"]').addClass('hidden');
                                const authorName = response.comment.author ? response.comment.author
                                    .name : 'Аноним';
                                const authorAvatar = response.comment.author && response.comment
                                    .author.avatar ?
                                    `/storage/${response.comment.author.avatar}` :
                                    '/images/default-avatar.png';
                                const newReplyHtml = `
                                <div class="site-comment mb-4" id="comment-${response.comment.id}">
                                    <div class="flex items-start">
                                        <img src="${authorAvatar}" alt="${authorName}" class="site-avatar mr-4 h-10 w-10 rounded-full">
                                        <div class="flex-1 w-full">
                                            <div class="site-muted text-sm">${authorName} - ${new Date(response.comment.created_at).toLocaleString('ru-RU', { hour: '2-digit', minute: '2-digit', year: 'numeric', month: '2-digit', day: '2-digit', timeZone: 'Europe/Moscow' })}</div>
                                            <div class="mt-1 whitespace-pre-wrap text-slate-200">${response.comment.content}</div>
                                            <button onclick="toggleReplyForm(${response.comment.id});" class="site-link mt-2 text-sm">{{ __('Ответить') }}</button>
                                        </div>
                                    </div>
                                </div>
                            `;

                                $('#child-comments-' + response.comment.parent_id).append(
                                    newReplyHtml);
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 401) {
                                alert('Вы должны быть авторизованы для добавления комментария.');
                            }
                        }
                    });
                });
            });
        </script>
    @endpush
@endonce
