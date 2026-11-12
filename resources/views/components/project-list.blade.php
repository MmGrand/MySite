@props(['projects' => [], 'columns' => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4', 'gap' => 'gap-8'])

<div class="grid {{ $columns }} {{ $gap }}">
    @foreach ($projects as $project)
        <article class="site-card site-card-interactive relative">
            <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer" class="block h-full no-underline">
                <img src="{{ $project->preview_image }}" alt="{{ $project->title }}"
                    class="h-48 w-full object-cover">
                <div class="flex min-h-56 flex-col p-5">
                    <div class="mb-2 flex items-start justify-between gap-3">
                        <h3 class="text-xl font-semibold leading-snug text-white">{{ $project->title }}</h3>
                        <i class="fas fa-external-link-alt site-accent mt-1 text-sm" aria-hidden="true"></i>
                    </div>
                    <p class="site-muted mb-4 text-sm leading-relaxed">{{ $project->preview_content }}</p>
                    <div class="mt-auto flex flex-wrap gap-2">
                        @foreach ($project->tags as $tag)
                            <span class="site-tag">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </a>
        </article>
    @endforeach
</div>
@if (method_exists($projects, 'links'))
    <div class="mt-6">
        {{ $projects->links('vendor.pagination.tailwind') }}
    </div>
@endif
