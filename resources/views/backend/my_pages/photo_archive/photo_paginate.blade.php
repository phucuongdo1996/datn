@if ($articlePhotos->hasMorePages())
    @if ($articlePhotos->onFirstPage())
        <a href="#" class="btn custom-btn-default" onclick="return false;" disabled>
            <i class="icon-paginate fa fa-angle-left" aria-hidden="true"></i>
        </a>
    @else
        <a href="{{ $articlePhotos->previousPageUrl() }}" class="btn custom-btn-default">
            <i class="icon-paginate fa fa-angle-left" aria-hidden="true"></i>
        </a>
    @endif
    <span class="d-inline-block p10l p10r">{{ $articlePhotos->currentPage() }}/{{ $articlePhotos->lastPage() }}</span>
    <a href="{{ $articlePhotos->nextPageUrl() }}" class="btn custom-btn-default m5t">
        <i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i>
    </a>
@else
    @if ($articlePhotos->onFirstPage())
        <a href="#" onclick="return false;" class="btn custom-btn-default" disabled>
            <i class="icon-paginate fa fa-angle-left" aria-hidden="true"></i>
        </a>
    @else
        <a href="{{ $articlePhotos->previousPageUrl() }}"
           class="btn custom-btn-default">
            <i class="icon-paginate fa fa-angle-left" aria-hidden="true"></i>
        </a>
    @endif
    <span class="d-inline-block p10l p10r">{{ $articlePhotos->currentPage() }}/{{ $articlePhotos->lastPage() }}</span>
    @if($articlePhotos->currentPage() == $articlePhotos->lastPage())
        <a href="#" onclick="return false;" class="btn custom-btn-default" disabled>
            <i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i>
        </a>
    @else
        <a href="{{ $articlePhotos->nextPageUrl() }}" class="btn custom-btn-default m5t">
            <i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i>
        </a>
    @endif
@endif
