@php($totalPage = ceil(($paginator->total())/($paginator->perPage())))
<div class="d-inline-block cus-paginate portfolio-float-right m10t m0lr-sp">
    <a href="{{$paginator->previousPageUrl().'&'.formatArrayOnUrl($params['status']).'&option_paginate='.$params['option_paginate']}}"
       class="btn custom-btn-default h36" {{ ($paginator->currentPage() == FLAG_ONE) ? ' disabled' : '' }}>
        <i class="icon-paginate fa fa-angle-left" aria-hidden="true"></i></a>
    <span class="d-inline-block p10l p10r fs14">{{$paginator->currentPage()}}/{{$totalPage}}</span>
    <a href="{{$paginator->nextPageUrl().'&'.formatArrayOnUrl($params['status']).'&option_paginate='.$params['option_paginate']}}"
       class="btn custom-btn-default h36" {{ ($paginator->currentPage() >= $totalPage) ? ' disabled' : '' }}>
        <i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i></a>
</div>
