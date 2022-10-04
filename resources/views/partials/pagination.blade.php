@if ($paginator->hasPages())
    <div class="utils-page">
        <div class="pagination--container">
            <ul class="pagination--inner">
                <li>
                    <span class="pagination--item pagination-info">{{$paginator->firstItem()}}-{{$paginator->lastItem()}}/{{$paginator->total()}} </span>
                </li>
                @if (!$paginator->onFirstPage())
                    <li class="pagination--previous"><a class="pagination--item"
                                                        href="{{ $paginator->previousPageUrl() }}">‹</a></li>
                @endif
                @foreach ($elements as $element)
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="pagination--active"><span class="pagination--item">{{ $page }}</span>
                                </li>
                            @else
                                <li><a class="pagination--item" href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach
                @if ($paginator->hasMorePages())
                    <li class="pagination--next"><a class="pagination--item" href="{{ $paginator->nextPageUrl() }}">›</a></li>
                @endif
            </ul>
        </div>
    </div>
@endif