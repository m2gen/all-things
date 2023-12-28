@if ($paginator->hasPages())
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="page-item disabled"><span class="page-link text-dark fw-bold">前</span></li>
        @else
        <li class="page-item"><a class="page-link text-dark fw-bold" href="{{ $paginator->previousPageUrl() }}" rel="prev">前</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <li class="page-item disabled"><span class="page-link text-dark fw-bold">{{ $element }}</span></li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="page-item active"><span class="page-link text-dark fw-bold">{{ $page }}</span></li>
        @else
        <li class="page-item"><a class="page-link text-dark fw-bold" href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="page-item"><a class="page-link text-dark fw-bold" href="{{ $paginator->nextPageUrl() }}" rel="next">次</a></li>
        @else
        <li class="page-item disabled"><span class="page-link text-dark fw-bold">次</span></li>
        @endif
    </ul>
</nav>
@endif
