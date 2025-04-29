@if ($paginator->hasPages())
    <nav aria-label="Recipe pagination" class="flex justify-center mb-12">
        <div class="inline-flex rounded-md shadow-sm">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="pagination-item px-3 py-2 rounded-l-lg border border-gray-300 text-gray-400 bg-gray-50 cursor-not-allowed flex items-center" aria-disabled="true">
                    <i class="fas fa-chevron-left text-sm"></i>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination-item px-3 py-2 rounded-l-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition flex items-center" aria-label="Previous page">
                    <i class="fas fa-chevron-left text-sm"></i>
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($paginator->links()->elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="pagination-item px-4 py-2 border-t border-b border-gray-300 text-gray-500" aria-disabled="true">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="pagination-item active px-4 py-2 border-t border-b border-gray-300 bg-orange-500 text-white" aria-current="page">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="pagination-item px-4 py-2 border-t border-b border-gray-300 text-gray-700 hover:bg-gray-50 transition" aria-label="Go to page {{ $page }}">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination-item px-3 py-2 rounded-r-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition flex items-center" aria-label="Next page">
                    <i class="fas fa-chevron-right text-sm"></i>
                </a>
            @else
                <span class="pagination-item px-3 py-2 rounded-r-lg border border-gray-300 text-gray-400 bg-gray-50 cursor-not-allowed flex items-center" aria-disabled="true">
                    <i class="fas fa-chevron-right text-sm"></i>
                </span>
            @endif
        </div>
    </nav>
@endif