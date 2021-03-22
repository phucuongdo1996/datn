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
                                <li><a href="" class="registrationBtn">{{ trans('attributes.dota.header.home') }}</a></li>
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
