<div class="p5r">
    <div class="item-block h-100">
        @php($currentRouteName = request()->route()->getName())
        <div id="">
            <ul>
                <a href="{{ route(USER_INFO) }}" class="d-flex align-items-center menu-user-item p15 border-bottom @if($currentRouteName == USER_INFO) menu-user-item-active @endif ">
                    <i class="fas fa-chart-line fs20"></i>
                    <div class="fs18 p10l">Thống kê doanh số</div>
                </a>
            </ul>
        </div>
    </div>
</div>