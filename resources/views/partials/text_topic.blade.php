@php($page = request()->has('page') ?? FLAG_ONE)
@php($isLargePages = $paginator->currentPage() > $totalPage)
@if ($paginator->hasPages())
    <div class="d-inline-block cus-paginate m15l">
        <a href="{{ $paginator->previousPageUrl() }}"
           class="btn custom-btn-default" @if ($paginator->onFirstPage() || $isLargePages) {{ 'disabled' }} @endif>
            <i class="icon-paginate fa fa-angle-left" aria-hidden="true"></i>
        </a>
        <span
            class="d-inline-block p10l p10r">
            {{ $paginator->currentPage() }}/{{  $totalPage }}
        </span>
        <a href="{{ $paginator->nextPageUrl() }}"
           class="btn custom-btn-default" @if (!$paginator->hasMorePages() || $isLargePages) {{ 'disabled' }} @endif>
            <i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i>
        </a>
    </div>
@else
    <div class="d-inline-block cus-paginate m15l">
        <a href="#"
           class="btn custom-btn-default" disabled>
            <i class="icon-paginate fa fa-angle-left" aria-hidden="true"></i>
        </a>
        <span
            class="d-inline-block p10l p10r">{{ $paginator->currentPage() }}/{{ FLAG_ONE }}</span>
        <a href="#"
           class="btn custom-btn-default" disabled>
            <i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i>
        </a>
    </div>
@endif
