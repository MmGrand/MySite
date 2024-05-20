@props(['projects' => [], 'columns' => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4', 'gap' => 'gap-8'])

<div class="grid {{ $columns }} {{ $gap }}">
    @foreach ($projects as $project)
        <div
            class="overflow-hidden shadow-lg border border-slate-100 rounded-3xl hover:shadow-2xl transition-transform duration-500 relative transform hover:-translate-y-2 hover:scale-105 hover:rotate-1">
            <a href="{{ $project->url }}" target="_blank" rel="noopener noreferrer">
                <img src="{{ $project->preview_image }}" alt="{{ $project->title }}"
                    class="w-full h-48 object-cover transition-transform duration-500 transform hover:scale-110">
                <div class="p-5">
                    <h3 class="text-xl font-semibold">{{ $project->title }}</h3>
                    <p class="text-gray-600">{{ $project->preview_content }}</p>
                    <div class="flex flex-wrap gap-2 mt-2 mb-6">
                        @foreach ($project->tags as $tag)
                            <span
                                class="bg-green-200 hover:bg-green-300 text-green-800 hover:text-white text-xs font-medium px-2 py-1 rounded-full transition-colors duration-300">
                                {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
@if (method_exists($projects, 'links'))
    <div class="mt-6">
        {{ $projects->links('vendor.pagination.tailwind') }}
    </div>
@endif
