@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- 前のページへのリンク --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><span>«</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">«</a></li>
            @endif

            {{-- ページ番号 --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><span>&lt;{{ $page }}&gt;</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- 次のページへのリンク --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">»</a></li>
            @else
                <li class="disabled"><span>»</span></li>
            @endif
        </ul>
    </nav>
@endif
