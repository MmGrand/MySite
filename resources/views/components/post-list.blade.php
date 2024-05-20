@props(['posts' => [], 'columns' => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4', 'gap' => 'gap-8'])

<div class="grid {{ $columns }} {{ $gap }}">
    @foreach ($posts as $post)
        <div
            class="overflow-hidden shadow-lg border border-slate-100 rounded-3xl hover:shadow-2xl transition-transform duration-500 relative transform hover:-translate-y-2 hover:scale-105 hover:rotate-1">
            <a href="{{ route('posts.show', $post->slug) }}">
                <img src="{{ Str::startsWith($post->preview_image, 'http') ? $post->preview_image : Storage::url($post->preview_image) }}" alt="{{ $post->title }}"
                    class="w-full h-48 object-cover transition-transform duration-500 transform hover:scale-110">
                <div class="absolute top-0 left-0 bg-gradient-to-r from-green-500 to-blue-500 text-white text-sm px-3 py-1.5 rounded-br-2xl shadow">
                    <i class="fas fa-layer-group mr-1"></i>
                    {{ $post->category->name }}
                </div>
                <div class="p-5">
                    <h3 class="text-xl text-gray-800 font-semibold">{{ $post->title }}</h3>
                    <p class="text-gray-600 mb-2">{{ $post->preview_content }}</p>
                    <div class="flex flex-wrap gap-2 mt-2 mb-6">
                        @foreach ($post->tags as $tag)
                            <span
                                class="bg-green-200 hover:bg-green-300 text-green-800 hover:text-white text-xs font-medium px-2 py-1 rounded-full transition-colors duration-300">
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
@if (method_exists($posts, 'links'))
    <div class="mt-6">
        {{ $posts->links('vendor.pagination.tailwind') }}
    </div>
@endif
