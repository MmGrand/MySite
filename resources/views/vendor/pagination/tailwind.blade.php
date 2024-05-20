@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-center">
        <ul class="pagination flex space-x-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link px-2.5 py-2 text-gray-400 bg-gray-100 rounded-md" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link px-2.5 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link px-2.5 py-2 text-gray-400 bg-gray-100 rounded-md">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @php
                        $currentPage = $paginator->currentPage();
                        $lastPage = $paginator->lastPage();
                    @endphp
                    @foreach ($element as $page => $url)
                        @if ($page == $currentPage)
                            <li class="page-item active" aria-current="page"><span class="page-link px-2.5 py-2 text-white bg-gray-500 rounded-md">{{ $page }}</span></li>
                        @elseif ($page == 1 || $page == $lastPage || ($page >= $currentPage - 1 && $page <= $currentPage + 1))
                            <li class="page-item"><a class="page-link px-2.5 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100" href="{{ $url }}">{{ $page }}</a></li>
                        @elseif ($page == 2 && $currentPage > 4)
                            @if (!$loop->first && !$loop->parent->first)
                                <li class="page-item disabled" aria-disabled="true"><span class="page-link px-2.5 py-2 text-gray-400 bg-gray-100 rounded-md">...</span></li>
                            @endif
                        @elseif ($page == $lastPage - 1 && $currentPage < $lastPage - 3)
                            @if (!$loop->last && !$loop->parent->last)
                                <li class="page-item disabled" aria-disabled="true"><span class="page-link px-2.5 py-2 text-gray-400 bg-gray-100 rounded-md">...</span></li>
                            @endif
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link px-2.5 py-2 text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link px-2.5 py-2 text-gray-400 bg-gray-100 rounded-md" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
