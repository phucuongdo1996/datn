<div class="p5r">
    <div class="item-block h-100">
        @php($currentRouteName = request()->route()->getName())
        <div id="">
            <ul>
                <a href="{{ route(ADMIN_INDEX) }}" class="d-flex align-items-center menu-user-item p15 border-bottom @if($currentRouteName == ADMIN_INDEX) menu-user-item-active @endif ">
                    <i class="fas fa-chart-line fs20"></i>
                    <div class="fs18 p10l">Thống kê doanh số</div>
                </a>
                <a href="{{ route(ADMIN_ADD_STEAM_CODE) }}" class="d-flex align-items-center menu-user-item p15 border-bottom @if($currentRouteName == ADMIN_ADD_STEAM_CODE) menu-user-item-active @endif ">
                    <i class="fab fa-steam-square fs20"></i>
                    <div class="fs18 p10l">Thêm thẻ Steam code</div>
                </a>
                <a href="{{ route(ADMIN_EDIT_PRODUCT) }}" class="d-flex align-items-center menu-user-item p15 border-bottom @if($currentRouteName == ADMIN_EDIT_PRODUCT) menu-user-item-active @endif ">
                    <i class="fas fa-edit fs20"></i>
                    <div class="fs18 p10l">Chỉnh sửa sản phẩm</div>
                </a>
            </ul>
        </div>
    </div>
</div>