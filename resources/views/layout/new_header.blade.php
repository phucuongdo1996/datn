<div id="headWrap">
    <header id="header">
        <div id="logo"><a href="{{ route($currentUser ? TOP : USER_HOME) }}"><img src="{{ asset('images/logo.svg') }}" alt="CYARea!" /></a></div>

        <div id="globalNavWrap">
            <nav id="globalNav">
                <div id="globalNavInner">
                    <div id="mainNav">
                        <ul>
                            <li><a href="{{ request()->route()->getName() == TOP ? null : route(TOP) }}#cloudService">{{ trans('attributes.header.about_CYARea!') }}</a></li>
                            <li><a href="{{ request()->route()->getName() == TOP ? null : route(TOP) }}#price">{{ trans('attributes.header.rate_plan') }}</a></li>
                            <li><a href="{{ request()->route()->getName() == TOP ? null : route(TOP) }}#faq">{{ trans('attributes.header.faq') }}</a></li>
                            <li><a href="{{ route(USER_CONTACT_CREATE) }}">{{ trans('attributes.header.contact') }}</a></li>
                        </ul>
                    </div><!-- mainNav -->

                    <div id="memberNav">
                        <ul>
                            @if(!$currentUser)
                                <li><a href="{{ route(SHOW_LOGIN) }}" class="loginBtn">{{ trans('attributes.top.header.login_form.login') }}</a></li>
                                <li><a href="{{ route(REGISTER_SHOW_SCREEN_REGISTER) }}" class="registrationBtn">{{ trans('attributes.header.new_member') }}</a></li>
                            @else
                                <li><a href="{{ route(USER_HOME) }}" class="registrationBtn">{{ trans('attributes.top.header.home') }}</a></li>
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
