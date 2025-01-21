@if ($paginator->hasPages())
    <nav class="hs-d-flex hs-flex-column hs-align-items-center hs-mt-4">
        {{-- Exibir números de itens (opcional, para informar o intervalo de itens) --}}
        <div class="">
            <p class="hs-small hs-text-muted">
                {!! __('Showing') !!}
                <span class="hs-fw-semibold">{{ $paginator->firstItem() }}</span>
                {!! __('-') !!}
                <span class="hs-fw-semibold">{{ $paginator->lastItem() }}</span>
                {!! __('of') !!}
                <span class="hs-fw-semibold">{{ $paginator->total() }}</span>
            </p>
        </div>

        {{-- Pagination --}}
        <ul class="hs-pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="hs-page-item hs-disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="hs-page-link" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li class="hs-page-item">
                    <a class="hs-page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="hs-page-item hs-disabled" aria-disabled="true"><span class="hs-page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="hs-page-item hs-active" aria-current="page"><span class="hs-page-link">{{ $page }}</span></li>
                        @else
                            <li class="hs-page-item"><a class="hs-page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="hs-page-item">
                    <a class="hs-page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="hs-page-item hs-disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="hs-page-link" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
@endif
