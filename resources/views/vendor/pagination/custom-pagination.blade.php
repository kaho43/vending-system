@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-center space-x-2">
        <!-- 前のページリンク -->
        @if ($paginator->onFirstPage())
            <span class="pagination-item pagination-prev disabled">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-item pagination-prev">
                {!! __('pagination.previous') !!}
            </a>
        @endif

        <!-- ページ番号リンク -->
        @foreach ($elements as $element)
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination-item pagination-current">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="pagination-item">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        <!-- 次のページリンク -->
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-item pagination-next">
                {!! __('pagination.next') !!}
            </a>
        @else
            <span class="pagination-item pagination-next disabled">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif
