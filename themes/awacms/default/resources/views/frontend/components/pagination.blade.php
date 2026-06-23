@if ($paginator->hasPages())
    <nav class="d-flex justify-items-center justify-content-between">
        <div class="col-12 mt-4 d-flex justify-content-center">
            <ul class="pagination pagination-style-01 fs-13 fw-500 mb-0">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link" href="#"><i class="feather icon-feather-arrow-left fs-18 d-xs-none"></i></a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><i class="feather icon-feather-arrow-left fs-18 d-xs-none"></i></a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active"><a class="page-link" href="#">{{ $page }}</a></li>
                            @else
                                <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}"><i class="feather icon-feather-arrow-right fs-18 d-xs-none"></i></a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <a class="page-link" href="#"><i class="feather icon-feather-arrow-right fs-18 d-xs-none"></i></a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
@endif
