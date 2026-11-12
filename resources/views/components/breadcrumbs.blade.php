<nav aria-label="{{ __('Навигационная цепочка') }}" class="container mx-auto px-4 pt-20 pb-5">
    <ol class="breadcrumb site-muted flex flex-wrap text-sm">
        @foreach ($breadcrumbs as $breadcrumb)
            <li class="mr-2 flex items-center">
                @if (!$loop->last)
                    <a href="{{ $breadcrumb['href'] }}" class="site-link">{{ $breadcrumb['title'] }}</a>
                    <span class="site-muted mx-2" aria-hidden="true">/</span>
                @else
                    <span class="text-slate-200" aria-current="page">{{ $breadcrumb['title'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>