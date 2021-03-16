<div id="headWrap">
    <header id="header">
        <div id="logo">
            <a href="{{route(DOTA_HOME) }}"><img class="w-80" src="{{ asset('images/logo.png') }}" alt="DATN" /></a>
        </div>

        <div id="globalNavWrap">
            <nav id="globalNav">
                <div id="globalNavInner">
                    <div id="mainNav">
                        <ul>
                            <li><a href="{{ route(DOTA_HOME) }}">DOTA 2</a></li>
                            <li><a>Steam Code</a></li>
                            <li><a>Hướng dẫn</a></li>
                            <li><a>Liên hệ</a></li>
                        </ul>
                    </div><!-- mainNav -->

                    <div id="memberNav">
                        <ul>
                            @if(!$currentUser)
                                <li><a href="" class="registrationBtn">Đăng nhập</a>
                            @else
                                <li><a href="" class="registrationBtn">{{ trans('attributes.top.header.home') }}</a></li>
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
