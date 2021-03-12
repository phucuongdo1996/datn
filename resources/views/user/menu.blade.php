<div class="p5r">
    <div class="item-block h-100">
        @php($currentRouteName = request()->route()->getName())
        <div id="">
            <ul>
                <a href="{{ route(USER_INFO) }}" class="d-flex align-items-center menu-user-item p15 border-bottom @if($currentRouteName == USER_INFO) menu-user-item-active @endif ">
                    <i class="fas fa-user-circle fs20"></i>
                    <div class="fs18 p10l">Thông tin tài khoản</div>
                </a>
                <a href="{{ route(USER_LIST_ITEM) }}" class="d-flex align-items-center menu-user-item p15 border-bottom @if($currentRouteName == USER_LIST_ITEM) menu-user-item-active @endif " >
                    <i class="fab fa-product-hunt fs20"></i>
                    <div class="fs18 p10l">Kho sản phẩm</div>
                </a>
                <a href="{{ route(USER_STORE_PRODUCT) }}" class="d-flex align-items-center menu-user-item p15 border-bottom @if($currentRouteName == USER_STORE_PRODUCT) menu-user-item-active @endif">
                    <i class="fas fa-store fs20"></i>
                    <div class="fs18 p10l">Sản phẩm đang bán</div>
                </a>
                <a href="{{ route(USER_HISTORY) }}" class="d-flex align-items-center menu-user-item p15 border-bottom @if($currentRouteName == USER_HISTORY) menu-user-item-active @endif" >
                    <i class="fas fa-history fs20"></i>
                    <div class="fs18 p10l">Lịch sử giao dịch</div>
                </a>

            </ul>
        </div>
    </div>
</div>