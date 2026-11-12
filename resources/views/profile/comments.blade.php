@if ($comments->isNotEmpty())
    <div class="space-y-6">
        @foreach ($comments as $comment)
            <div class="site-comment">
                <h4 class="font-semibold text-slate-200 transition duration-300 hover:text-cyan-300">
                    <a class="no-underline" href="{{ route('posts.show', $comment->post->slug) }}">{{ $comment->post->title }}</a>
                </h4>
                <p class="site-muted text-sm">{{ $comment->created_at->format('d.m.Y, H:i') }}</p>
                <p class="site-muted mt-1">{{ $comment->content }}</p>
            </div>
        @endforeach
    </div>
    @if ($comments->hasMorePages())
        <div class="text-center mt-4">
            <button id="load-more-comments" data-url="{{ $comments->nextPageUrl() }}"
                class="site-button">{{ __('Показать ещё') }}</button>
        </div>
    @endif
@else
    <div class="mb-4">
        <p class="site-muted">{{ __('У вас пока нет комментариев.') }}</p>
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

                document.getElementById('avatarForm').addEventListener('submit', function(e) {
                    const avatarInput = document.getElementById('avatar_update');
                    const avatarError = document.getElementById('avatarError');
                    const avatarErrorServer = document.getElementById('avatarErrorServer');

                    if (!avatarInput.files.length) {
                        e.preventDefault();
                        avatarError.textContent = "{{ __('Пожалуйста, выберите фото.') }}";
                        avatarError.classList.remove('hidden');
                        if (avatarErrorServer) {
                            avatarErrorServer.classList.add('hidden');
                        }
                    } else {
                        avatarError.classList.add('hidden');
                        if (avatarErrorServer) {
                            avatarErrorServer.classList.add('hidden');
                        }
                    }
                });

                document.getElementById('avatar_update').addEventListener('click', function() {
                    const avatarError = document.getElementById('avatarError');
                    const avatarErrorServer = document.getElementById('avatarErrorServer');
                    avatarError.classList.add('hidden');
                    if (avatarErrorServer) {
                        avatarErrorServer.classList.add('hidden');
                    }
                });
            });
        </script>
    @endpush
@endonce
