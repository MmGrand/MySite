@props(['posts' => [], 'columns' => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4', 'gap' => 'gap-8'])

<div class="grid {{ $columns }} {{ $gap }}">
    @foreach ($posts as $post)
        <article class="site-card site-card-interactive relative">
            <a href="{{ route('posts.show', $post->slug) }}" class="block h-full no-underline">
                <div class="relative">
                    <img src="{{ Str::startsWith($post->preview_image, 'http') ? $post->preview_image : Storage::url($post->preview_image) }}" alt="{{ $post->title }}"
                        class="h-48 w-full object-cover">
                    <span class="site-tag absolute left-4 top-4">
                        <i class="fas fa-layer-group mr-2" aria-hidden="true"></i>{{ $post->category->name }}
                    </span>
                </div>
                <div class="flex min-h-56 flex-col p-5">
                    <h3 class="mb-2 text-xl font-semibold leading-snug text-white">{{ $post->title }}</h3>
                    <p class="site-muted mb-4 line-clamp-3 text-sm leading-relaxed">{{ $post->preview_content }}</p>
                    <div class="mt-auto flex flex-wrap gap-2 pb-8">
                        @foreach ($post->tags as $tag)
                            <span class="site-tag">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                    <div class="site-muted absolute bottom-4 right-5 flex items-center gap-2 text-xs">
                        <i class="fas fa-eye"></i>
                        <span>{{ $post->views_count }} {{ __('просмотров') }}</span>
                    </div>
                </div>
            </a>
        </article>
    @endforeach
</div>
@if (method_exists($posts, 'links'))
    <div class="mt-6">
        {{ $posts->links('vendor.pagination.tailwind') }}
    </div>
@endif
