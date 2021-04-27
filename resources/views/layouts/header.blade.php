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
                            <li><a href="{{ route(DOTA_HOME) }}">DOTA 2</a></li>
                            <li><a href="{{ route(STEAM_CODE_INDEX) }}">Steam Code</a></li>
                            <li><a>Hướng dẫn</a></li>
                            <li><a>Liên hệ</a></li>
                        </ul>
                    </div><!-- mainNav -->
                    @if(!$currentUser)

                    <div id="memberNav" style="padding: 10px 0">
                        <ul>
                            <li>
                                <a href="{{ route(SHOW_LOGIN) }}" class="text-white effect01" style="padding: 0 60px">
                                    <span>Đăng nhập</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    @else
                        <div id="dropdown-menu">
                            <div class="dropdown" style="cursor: pointer">
                                <div class="d-flex align-items-center" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img style="border-radius: 50%; width: 50px; height: 50px" src="{{ asset(URL_USER_AVATAR . ($currentUser->avatar ?? 'img_avatar.png')) }}" alt="">
                                    <div class="p10l fs16">
                                        <div class="text-right font-weight-bold m5b">{{ $currentUser->nick_name }} <i class="fas fa-caret-down"></i></div>
                                        <div class="text-right text-gold"><i class="fas fa-coins"></i> {{ number_format($currentUser->money_own) }}</div>
                                    </div>
                                </div>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item p15" href="{{ route(USER_INFO) }}"><i class="fas fa-info-circle"></i> Tài khoản</a>
                                    <a class="dropdown-item p15" href="{{ route(LOGOUT) }}"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
                                </div>
                            </div>
                        </div>
                    @endif
                </div><!-- globalNavInner -->
            </nav><!--globalNav-->
        </div><!--globalNavWrap-->

        <div id="globalNavBtnWrap" class="pcH">
            <div id="globalNavBtn"><a href="javascript:void(0);"><span></span></a></div>
        </div><!-- globalNavBtnWrap -->
    </header><!--header-->
</div><!--headWrap-->
