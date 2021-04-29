<div id="headWrap">
    <header id="header">
        <div id="logo" style="">
            <a class="d-flex" href="{{route(DOTA_HOME) }}" style="height: 80px !important;">
                <img class="w-80 object-fit-cover" src="{{ asset('images/logo.png') }}" alt="DATN" />
            </a>
        </div>

        <div id="globalNavWrap">
            <nav id="globalNav">
                <div id="globalNavInner">
                    <div id="mainNav">
                        <ul>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div><!-- mainNav -->

                    <div id="memberNav">
                        <ul>
                            @if(!$currentUser)
                                <li><a href="" class="registrationBtn">Đăng nhập</a>
                            @else
                                        <div id="dropdown-menu">
                                            <div class="dropdown" style="cursor: pointer">
                                                <div class="d-flex align-items-center" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img style="border-radius: 50%; width: 50px; height: 50px" src="{{ asset(URL_USER_AVATAR . ($currentUser->avatar ?? 'img_avatar.png')) }}" alt="">
                                                    <div class="p10l fs16">
                                                        <div class="text-right font-weight-bold m5b">{{ $currentUser->nick_name }} <i class="fas fa-caret-down"></i></div>
                                                    </div>
                                                </div>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item p15" href="{{ route(ADMIN_INDEX) }}"><i class="fas fa-chart-line"></i> Thống kê doanh số</a>
                                                    <a class="dropdown-item p15" href="{{ route(ADMIN_ADD_STEAM_CODE) }}"><i class="fab fa-steam-square"></i> Quản lý thẻ Steam Code</a>
                                                    <a class="dropdown-item p15" href="{{ route(ADMIN_EDIT_PRODUCT) }}"><i class="fas fa-edit"></i> Quản lý thẻ Sản phẩm</a>
                                                    <a class="dropdown-item p15" href="{{ route(LOGOUT) }}"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                                                </div>
                                            </div>
                                        </div>
                            @endif
                        </ul>
                    </div><!-- memberNav -->
                </div><!-- globalNavInner -->
            </nav><!--globalNav-->
        </div><!--globalNavWrap-->

        <div id="globalNavBtnWrap" class="pcH">
            <div id="globalNavBtn"><a href="javascript:void(0);"><span></span></a></div>
        </div><!-- globalNavBtnWrap -->
    </header><!--header-->
</div><!--headWrap-->
