@php($linkLimit = 5)
@if ($paginator->lastPage() > 1)
    <ul class="pagination pagination-sm m-0 float-right">
        <li class="page-item {{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
            <a href="{{ $paginator->url($paginator->currentPage() - 1)  }}" class="page-link">«</a>
        </li>
        @for($i = 1; $i <= $paginator->lastPage(); $i++)
            <?php
                $halfTotalLinks = floor($linkLimit / 2);
                $from = $paginator->currentPage() - $halfTotalLinks;
                $to = $paginator->currentPage() + $halfTotalLinks;
                if ($paginator->currentPage() < $halfTotalLinks) {
                    $to += $halfTotalLinks - $paginator->currentPage();
                }
                if ($paginator->lastPage() - $paginator->currentPage() < $halfTotalLinks) {
                    $from -= $halfTotalLinks - ($paginator->lastPage() - $paginator->currentPage()) - 1;
                }
            ?>

            @if ($from < $i && $i < $to)
                <li class="page-item {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                    <a href="{{ $paginator->url($i) }}" class="page-link">{{ $i }}</a>
                </li>
            @endif
        @endfor
        <li class="page-item {{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
            <a href="{{ $paginator->url($paginator->currentPage() + 1) }}" class="page-link">»</a>
        </li>
    </ul>
@endif
