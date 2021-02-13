<header class="header" id="header">
    <div class="container-fluid h-100 header-simulation bg-general text-white">
        <div class="header-simulation-logo d-none d-md-block">
            <a href="{{ route($currentUser ? USER_HOME : TOP) }}">
                <img class="logo-header" src="{{ asset('images/logo_wh.png') }}">
            </a>
        </div>
        <div class="header-simulation-logo display-center d-flex d-md-none m4l">
            <a href="{{ route(USER_HOME) }}">
                <img src="{{ asset('images/logo.png') }}">
            </a>
        </div>
        <div class="header-simulation-search text-white d-none d-md-block">
            <div class="input-group-append form-search">
                <button class="btn bg-search header-btn-search-radius" type="submit">
                    <i class="fa fa-search font_awesome-search text-white"></i>
                </button>
                <input class="form-control bg-search input-search border-0 fs14 text-white h46 header-form-search-radius" type="search"
                       placeholder= {{__('attributes.home.header.placeholder_search') }}>
            </div>
        </div>

        <div class="header-simulation-right">
                <div class="message-dropdown-menu dropdown m5t">
                @if($currentUser)
                    <a class="nav-link nav-link-mess bg-general" data-toggle="dropdown" href="#">
                        <span data-title= {{__('attributes.home.header.title_mess') }}><img
                                src="{{ asset('images/message.png') }}"></span>
                        <span class="badge-home badge-danger">10</span>
                    </a>
                @else
                    <a class="nav-link nav-link-mess bg-general">
                        <span data-title= {{__('attributes.home.header.title_mess') }}><img
                                src="{{ asset('images/message_none.png') }}"></span>
                    </a>
                @endif
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right message-dropdown">
                    <a href="#" class="dropdown-item">
                        <div class="media">
                            <img src="{{ asset('images/user_default.png') }}"
                                 class="img-size-50 mr-3 img-circle">
                            <div class="media-body">
                                <h3 class="dropdown-item-title">
                                    Guest
                                    <span class="float-right text-sm text-danger"></span>
                                </h3>
                                <p class="text-sm">Call me whenever you can...</p>
                                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                </div>
            </div>

            <div class="noti-dropdown-menu dropdown m5t">
                @if($currentUser)
                    <a class="nav-link nav-link-noti bg-general" data-toggle="dropdown" href="#">
                        <span data-title={{__('attributes.home.header.title_noti') }}><img
                                src="{{ asset('images/notification.png') }}"></span>
                        <span class="badge-home badge-danger">10</span>
                    </a>
                @else
                    <a class="nav-link nav-link-mess bg-general">
                        <span data-title= {{__('attributes.home.header.title_mess') }}><img
                                src="{{ asset('images/notification_none.png') }}"></span>
                    </a>
                @endif
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <span class="dropdown-item dropdown-header">15 Notifications</span>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">
                        <i class="fa fa-envelope mr-2"></i> 10 new messages
                        <span class="float-right text-muted text-sm">3 mins</span>
                    </a>
                    <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                </div>
            </div>

            <nav class="navbar-expand-smk m10r">
                <ul class="navbar-nav">
                    <!-- Dropdown -->
                    <li class="nav-item dropdown">
                        @if($currentUser)
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbardrop"
                               data-toggle="dropdown">
                                <img class="img-user w30 h30" src={{ $currentUser->profile ? ($currentUser->profile->avatar_thumbnail ?
                                url(PATH_SRC_AVATAR . $currentUser->profile->avatar_thumbnail) : asset('images/user_default.png')) :  asset('images/user_default.png')}}>
                                <span class="name-user text-center m10l"> {{ $currentUser->profile ? ($currentUser->profile->person_charge_first_name && $currentUser->profile->person_charge_last_name) ?
                                $currentUser->profile->person_charge_last_name . " " . $currentUser->profile->person_charge_first_name : $currentUser->email : $currentUser->email }}</span>
                            </a>
                            <div class="dropdown-menu drop-down-for-user">
                                @if($currentUser->role !== ADMIN)
                                    <a class="dropdown-item" href="{{ $currentUser->isSubUser() ? route(SUB_USER_PROFILE_EDIT, $currentUser->id) : route(USER_PROFILE_EDIT, ['role' => ROLES[$currentUser->role], 'id' => $currentUser->id]) }}">
                                        {{__('attributes.home.modal.profile') }}
                                    </a>
                                    @if(!$currentUser->isSubUser() || $currentUser->hasPermission(CHANGE_SUB_USER, CHANGE_PLAN))
                                        <a class="dropdown-item" href="{{ route(USER_SETTING_INDEX) }}">{{__('attributes.home.modal.setting') }}</a>
                                    @endif
                                @endif
                                <a class="dropdown-item"
                                   href="{{ route(LOGOUT) }}">{{__('attributes.home.modal.logout') }}</a>
                            </div>
                        @else
                            <a class="nav-link dropdown-toggle text-white default" href="#" id="navbardrop" data-toggle="dropdown">
                                <img class="img-user w30 h30" src="{{ asset('images/user_default.png') }}">
                                <span class="name-user text-center m10l">Guest</span>
                            </a>
                            <div class="dropdown-menu drop-down-for-user">
                                <a class="dropdown-item"
                                   href="{{ route(TOP) }}">{{__('attributes.home.modal.logout') }}</a>
                            </div>
                        @endif
                    </li>
                </ul>
            </nav>

            <div class="type-user display-center d-none d-md-flex">
                @if(!$currentUser || $currentUser->isFreeMember())
                    <button type="button" class="btn-free bg-general text-white default">Free</button>
                @elseif($currentUser->isBasicMember())
                    <button type="button" class="btn-basic bg-general default">Basic</button>
                @elseif($currentUser->isPremiumMember())
                    <button type="button" class="btn-premium bg-general default">Premium</button>
                @endif
            </div>

            <a class="header-simulation-left btn-bars display-center d-flex d-md-none d-lg-none" data-widget="pushmenu">
                <i class="fa fa-bars-custom" id="fa-menu">
                    <img class="open-menu fa-bars-img fa-menu" src="{{ asset('images/open_icon.png') }}">
                    <img class="close-menu fa-close-img fa-menu" src="{{ asset('images/close_icon.png') }}" style="display: none">
                </i>
            </a>
        </div>
    </div>
</header>
