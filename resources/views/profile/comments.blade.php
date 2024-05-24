@if ($comments->isNotEmpty())
    <div class="space-y-6">
        @foreach ($comments as $comment)
            <div class="border-b pb-4">
                <h4 class="text-gray-700 hover:text-blue-500 transition duration-300">
                    <a href="{{ route('posts.show', $comment->post->slug) }}">{{ $comment->post->title }}</a>
                </h4>
                <p class="text-sm text-gray-500">{{ $comment->created_at->format('d.m.Y, H:i') }}</p>
                <p class="mt-1 text-gray-700">{{ $comment->content }}</p>
            </div>
        @endforeach
    </div>
    @if ($comments->hasMorePages())
        <div class="text-center mt-4">
            <button id="load-more-comments" data-url="{{ $comments->nextPageUrl() }}"
                class="px-4 py-2 bg-blue-500 text-white rounded-lg shadow hover:bg-blue-600 transition duration-300">{{ __('Показать ещё') }}</button>
        </div>
    @endif
@else
    <div class="mb-4">
        <p class="text-gray-700">{{ __('У вас пока нет комментариев.') }}</p>
    </div>
@endif

@once
    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelector('#comments-container').addEventListener('click', function(e) {
                    if (e.target && e.target.id === 'load-more-comments') {
                        const button = e.target;
                        const url = button.getAttribute('data-url');

                        fetch(url, {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(response => response.text())
                            .then(data => {
                                const container = document.querySelector('#comments-container');
                                container.insertAdjacentHTML('beforeend', data);
                                button.remove();
                            })
                            .catch(error => console.error('Error loading more comments:', error));
                    }
                });
            });
        </script>
    @endpush
@endonce
