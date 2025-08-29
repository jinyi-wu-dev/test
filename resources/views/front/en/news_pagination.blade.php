@if ($paginator->hasPages())
  <nav class="pager">
    <ol class="pager-list">
      {{-- Previous Page Link --}}
      @if ($paginator->onFirstPage())
        <li class="pager-list__item">
          <a class="pager-inr prev" href="{{ $paginator->previousPageUrl() }}"> </a>
        </li>
      @else
        <li class="pager-list__item">
          <a class="pager-inr prev" href="{{ $paginator->previousPageUrl() }}"> </a>
        </li>
      @endif

      {{-- Pagination Elements --}}
      @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
          <li class="pager-list__item">
            <span>...</span>
          </li>
        @endif
        
        {{-- Array Of Links --}}
        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <li class="pager-list__item">
                <span class="current pager-inr">{{ $page }}</span>
              </li>
            @else
              <li class="pager-list__item">
                <a class="pager-inr" href="{{ $url }}">{{ $page }}</a>
              </li>
            @endif
          @endforeach
        @endif
      @endforeach

      {{-- Next Page Link --}}
      @if ($paginator->hasMorePages())
        <li class="pager-list__item">
          <a class="pager-inr next" href="{{ $paginator->nextPageUrl() }}"> </a>
        </li>
      @else
        <li class="pager-list__item">
          <a class="pager-inr next" href="{{ $paginator->nextPageUrl() }}"> </a>
        </li>
      @endif
    </ol>
  </nav>
@endif
