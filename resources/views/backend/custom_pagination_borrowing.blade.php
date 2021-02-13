@php($totalPage = ceil(($paginator->total())/($paginator->perPage())))
<div class="d-inline-block cus-paginate">
    <a href="{{$paginator->previousPageUrl()
    . (isset($param['owning']) ? '&owning=on' : '')
    . (isset($param['sold']) ? '&sold=on' : '')
    . (isset($param['negotiating']) ? '&negotiating=on' : '')
    . (isset($param['negotiated']) ? '&negotiated=on' : '')
    . (isset($param['paginate']) ? '&paginate='.$param['paginate'] : '')
    . (isset($param['paginate']) ? '&paginate='.$param['paginate'] : '') }}" class="btn custom-btn-default h36" {{ ($paginator->currentPage() == FLAG_ONE) ? ' disabled' : '' }}>
        <i class="icon-paginate fa fa-angle-left" aria-hidden="true"></i></a>
    <span class="d-inline-block p10l p10r">{{$paginator->currentPage()}}/{{$totalPage}}</span>
    <a href="{{ $paginator->nextPageUrl()
    . (isset($param['owning']) ? '&owning=on' : '')
    . (isset($param['sold']) ? '&sold=on' : '')
    . (isset($param['negotiating']) ? '&negotiating=on' : '')
    . (isset($param['negotiated']) ? '&negotiated=on' : '')
    . (isset($param['paginate']) ? '&paginate='.$param['paginate'] : '')
    . (isset($param['paginate']) ? '&paginate='.$param['paginate'] : '') }}" class="btn custom-btn-default h36" {{ ($paginator->currentPage() == $totalPage) ? ' disabled' : '' }}>
        <i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i></a>
</div>
