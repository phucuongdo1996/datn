<header id="header" class="">
    <div class="container h-100 text-center text-md-left">
        <div class="row justify-content-between">
            <div class="col-12 col-sm-3">
                <a href="{{ route(USER_HOME) }}">
                    <img src="{{ asset('images/logo_wh.png') }}" alt="" class="m10t m10b logo-header">
                </a>
            </div>
            <div class="col-sm-2 text-right m20t d-none d-md-block">
            </div>
            <div id="nav-bar-home" class="col-12 col-sm-7 justify-content-end p0r">
                <ul class="nav">
                    <li class="nav-item fs16 d-flex align-items-center">
                        <a class="nav-link text-white" href="#">{{ __('attributes.header.about_CYARea!') }}</a>
                    </li>
                    <li class="nav-item fs16 d-flex align-items-center">
                        <a class="nav-link text-white" href="#">{{ __('attributes.header.rate_plan') }}</a>
                    </li>
                    <li class="nav-item fs16 d-flex align-items-center">
                        <a class="nav-link text-white" href="#">{{ __('attributes.header.faq') }}</a>
                    </li>
                    <li class="nav-item fs16 d-flex align-items-center">
                        <a class="nav-link text-white" href="#">{{ __('attributes.header.contact') }}</a>
                    </li>
                    <li class="nav-item fs16 d-flex align-items-center li-free">
                        <a class="nav-link text-white" href="{{ route(REGISTER_SHOW_SCREEN_REGISTER) }}">{{ __('attributes.header.new_member') }}</a>
                    </li>
                </ul>
            </div>
            @if($currentUser)
                <div class="col-12 col-sm-3 text-center"><a href="{{ route(LOGOUT) }}" class="text-center text-white logout-profile" >{{__('attributes.home.modal.logout') }}</a></div>
            @endif
        </div>
    </div>
</header>
