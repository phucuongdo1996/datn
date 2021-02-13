<aside class="main-sidebar-left sidebar-dark-primary while-color overflow-auto">
    @php($routeIndex = request()->route()->getName())
    <nav>
        <ul class="nav nav-pills nav-sidebar flex-column nav-menu" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item menu-simulation-item">
                <div class="input-group-append form-search txt-black nl-one-item" style="display: none">
                    <i class="fa fa-search font_awesome-search centered-vertical text-body fs16 pointer"></i>
                    <input class="form-control input-search border-0 fs14 m4t" type="search"
                           placeholder= {{__('attributes.home.header.placeholder_search') }}>
                </div>
            </li>
            <li class="nav-item menu-simulation-item">
                <a href="{{ route(USER_HOME) }}" class="nav-link nav-link-item nl-one-item @if($routeIndex == USER_HOME) active-one-item @endif"
                   data-id="home">
                    <img class="icon-menu-home icon-home" src="{{ $routeIndex ==  USER_HOME ? url('images/home_wh.png') : url('images/home.png')}}">
                    <span class="text-body fs15w500">{{__('attributes.home.menu.home') }}</span>
                </a>
            </li>
            @if(!$currentUser || !$currentUser->isAdmin())
                <li class="nav-item menu-simulation-item">
                    <a href="{{ route(USER_SIMULATION_CREATE) }}" class="nav-link nav-link-item nl-one-item
                    nl-simulation @if($routeIndex == USER_SIMULATION_CREATE) active-one-item @endif"
                       data-id="simulation">
                        <img class="icon-menu-home icon-simulation"
                             src="{{ $routeIndex ==  USER_SIMULATION_CREATE ? url('images/simulation_wh.png') : url('images/simulation.png')}}">
                        <span class="text-body fs15w500">{{__('attributes.home.menu.simulation') }}</span>
                    </a>
                </li>
            @endif
            @if($currentUser)
                @if(!$currentUser->isAdmin())
                    @if($currentUser->isMainUser() || $currentUser->hasPermission(CHANGE_PROPERTY) || $currentUser->hasPermissionProperty(VIEW_PROPERTY))
                        <li class="nav-item has-treeview menu-simulation-item @if(in_array($routeIndex, [USER_PROPERTY_ADD, USER_PROPERTY_INDEX])) menu-open @endif">
                        <a href="#" class="nav-link nav-link-item nl-ml-item @if(in_array($routeIndex, [USER_PROPERTY_ADD, USER_PROPERTY_INDEX])) active-item @endif">
                            <i class="fa text-body w10 @if(in_array($routeIndex, [USER_PROPERTY_ADD, USER_PROPERTY_INDEX])) fa-caret-down @else fa-caret-right @endif"></i>
                            <img class="icon-menu-home" src="{{ asset('images/manage_home.png') }}">
                            <span class="text-body fs15w500">{{__('attributes.home.menu.investor_home') }}</span>
                        </a>
                        @if($currentUser->isMainUser() || $currentUser->hasPermission(CHANGE_PROPERTY))
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route(USER_PROPERTY_ADD) }}" class="nav-link nav-link-sub-item
                                            @if($routeIndex == USER_PROPERTY_ADD) active-sub-item @endif"
                                       data-id="property">
                                        <span class="text-body fs14">{{__('attributes.home.menu.register') }}</span>
                                        <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-silver.svg') }}"></span>
                                    </a>
                                </li>
                            </ul>
                        @endif
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route(USER_PROPERTY_INDEX) }}" class="nav-link nav-link-sub-item
                                        @if($routeIndex == USER_PROPERTY_INDEX) active-sub-item @endif"
                                   data-id="property">
                                    <span class="text-body fs14">{{__('attributes.home.menu.list_house') }}</span>
                                    <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-silver.svg') }}"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if($currentUser->isMainUser() || $currentUser->hasPermissionProperty(VIEW_REPORT))
                    <li class="nav-item has-treeview menu-simulation-item @if(in_array($routeIndex, ARRAY_BALANCE_ANALYSIS_ROUTE)) menu-open @endif">
                        <a href="#" class="nav-link nav-link-item nl-ml-item @if(in_array($routeIndex, ARRAY_BALANCE_ANALYSIS_ROUTE)) active-item @endif">
                            <i class="fa text-body w10 @if(in_array($routeIndex, ARRAY_BALANCE_ANALYSIS_ROUTE)) fa-caret-down @else fa-caret-right @endif"></i>
                            <img class="icon-menu-home" src="{{ asset('images/expenditure.png') }}">
                            <span class="text-body fs15w500">{{__('attributes.home.menu.re_and_ex_analysis') }}</span>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route(USER_SINGLE_ANALYSIS_INDEX) }}" class="nav-link nav-link-sub-item d-flex
                                @if($routeIndex == USER_SINGLE_ANALYSIS) active-sub-item @endif" data-id="portfolio-analysis">
                                    <span class="text-body fs14">{{__('attributes.home.menu.balance_analysis') }}</span>
                                    <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-bronze.svg') }}"></span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route(USER_PROPERTY_PORTFOLIO_ANALYSIS) }}" class="nav-link nav-link-sub-item d-flex
                                @if($routeIndex == USER_PROPERTY_PORTFOLIO_ANALYSIS) active-sub-item @endif" data-id="portfolio-analysis">
                                    <span class="text-body fs14">{{__('attributes.home.menu.portfolio_analysis') }}</span>
                                    <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-silver.svg') }}"></span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route(USER_BORROWING) }}" class="nav-link nav-link-sub-item
                                @if($routeIndex == USER_BORROWING) active-sub-item @endif" data-id="borrowing">
                                    <span class="text-body fs14">{{__('attributes.property.list_status_owe') }}</span>
                                    <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-silver.svg') }}"></span>
                                </a>
                            </li>
                        </ul>
                        @php($plan = $currentUser->isMainUser() ? $currentUser->isPremiumMember() : $currentUser->getParentUser()->isPremiumMember())
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route(USER_PROPERTY_SEARCH) }}" class="nav-link nav-link-sub-item
                                @if($routeIndex == USER_PROPERTY_SEARCH) active-sub-item @endif @if(!$plan) disabled @endif" data-id="borrowing">
                                    <span class="text-body fs14">{{__('attributes.property.search_bank') }}</span>
                                    <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-gold.svg') }}"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                        <li class="nav-item has-treeview menu-simulation-item @if(in_array($routeIndex, [USER_TAX_INDEX, USER_REPORT])) menu-open @endif">
                        <a href="#" class="nav-link nav-link-item nl-ml-item @if(in_array($routeIndex, [USER_TAX_INDEX, USER_REPORT])) active-item @endif">
                            <i class="fa text-body w10 @if(in_array($routeIndex, [USER_REPORT, USER_TAX_INDEX])) fa-caret-down @else fa-caret-right @endif"></i>
                            <img class="icon-menu-home" src="{{ url('images/report.png')}}">
                            <span class="text-body fs15w500">{{__('attributes.home.menu.report') }}</span>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route(USER_REPORT) }}" class="nav-link nav-link-sub-item
                                @if($routeIndex == USER_REPORT) active-sub-item @endif" data-id="portfolio-analysis">
                                    <span class="text-body fs14">{{__('attributes.home.menu.sub_report') }}</span>
                                    <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-silver.svg') }}"></span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route(USER_TAX_INDEX) }}" class="nav-link nav-link-sub-item
                                @if($routeIndex == USER_TAX_INDEX) active-sub-item @endif" data-id="list_tax">
                                    <span class="text-body fs14">{{__('attributes.property.tax_confirm_final') }}</span>
                                    <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-silver.svg') }}"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if($currentUser->isMainUser())
                        <li class="nav-item has-treeview menu-simulation-item">
                        <a href="#" class="nav-link nav-link-item nl-ml-item">
                            <i class="fa fa-caret-right text-body w10"></i>
                            <img class="icon-menu-home" src="{{ asset('images/communication.png') }}">
                            <span class="text-body fs15w500">{{__('attributes.home.menu.communication') }}</span>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-link-sub-item disabled">
                                    <span class="text-body fs14">{{__('attributes.home.menu.chat') }}</span>
                                    <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-silver.svg') }}"></span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-link-sub-item disabled">
                                    <span class="text-body fs14">{{__('attributes.home.menu.seminar_event') }}</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-link-sub-item disabled">
                                    <span class="text-body fs14">{{__('attributes.home.menu.ranking_experts') }}</span>
                                </a>
                            </li>
                        </ul>
                        @if($currentUser->isExpert())
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-link-sub-item disabled">
                                    <span class="text-body fs14">{{__('attributes.home.menu.building_chat_offer') }}</span>
                                    <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-gold.svg') }}"></span>
                                </a>
                            </li>
                        </ul>
                        @endif
                        @if($currentUser->isBroker() || $currentUser->isInvestor())
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-link-sub-item disabled">
                                    <span class="text-body fs14">{{__('attributes.home.menu.conditions_for_real') }}</span>
                                    <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-gold.svg') }}"></span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="#" class="nav-link nav-link-sub-item disabled">
                                    <span class="text-body fs14">{{__('attributes.home.menu.properties_registered') }}</span>
                                    <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-gold.svg') }}"></span>
                                </a>
                            </li>
                        </ul>
                        @endif
                    </li>
                    @endif
                @endif
                @if($currentUser->role != ADMIN && ($currentUser->isMainUser() || $currentUser->hasPermission(CHANGE_MYPAGE)))
                    @php($userProxy = $currentUser->userProxy(CHANGE_MYPAGE))
                    @php($flagSideBar = (isset($userProfile->profile->user_id) && $userProfile->profile->user_id == $userProxy->id))
                    <li class="nav-item has-treeview menu-simulation-item
                        @if(in_array($routeIndex, [USER_PHOTO_ARCHIVE_INDEX]) || in_array($routeIndex, [USER_ARTICLE_TEXT]) || in_array($routeIndex, [MY_PAGE, USER_LIST_PHOTO_INDEX]) && isset($userProfile->profile->user_id) && $userProfile->profile->user_id == $userProxy->id))
                            menu-open
                        @elseif($flagSideBar)
                            @if(in_array($routeIndex, [LIST_TOPIC]) || in_array($routeIndex, [PREVIEW_TOPIC_DETAIL]))
                                menu-open
                            @endif
                        @endif">
                        <a href="#" class="nav-link nav-link-item nl-ml-item
                        @if(in_array($routeIndex, [USER_PHOTO_ARCHIVE_INDEX]) || in_array($routeIndex, [USER_ARTICLE_TEXT]) || (in_array($routeIndex, [MY_PAGE, USER_LIST_PHOTO_INDEX]) && isset($userProfile->profile->user_id) && $userProfile->profile->user_id == $userProxy->id))
                            active-item
                        @elseif($flagSideBar)
                            @if( in_array($routeIndex, [LIST_TOPIC]) || in_array($routeIndex, [PREVIEW_TOPIC_DETAIL]))
                                active-item
                            @endif
                        @endif">
                            <i class="fa text-body w10
                        @if(in_array($routeIndex, [USER_PHOTO_ARCHIVE_INDEX]) || in_array($routeIndex, [USER_ARTICLE_TEXT]) || (in_array($routeIndex, [MY_PAGE, USER_LIST_PHOTO_INDEX]) && isset($userProfile->profile->user_id) && $userProfile->profile->user_id == $userProxy->id))
                                fa-caret-down
                        @elseif($flagSideBar)
                            @if( in_array($routeIndex, [LIST_TOPIC]) || in_array($routeIndex, [PREVIEW_TOPIC_DETAIL]))
                                fa-caret-down
                            @endif
                        @else
                                fa-caret-right
                        @endif"></i>
                            <img class="icon-menu-home" src="{{ asset('images/human.svg') }}">
                            <span class="text-body fs15w500">{{__('attributes.home.menu.personal_page')}}</span>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                @if($userProxy->role == BROKER)
                                    <a href="{{ route(MY_PAGE, ['broker', $userProxy->id]) }}" class="nav-link nav-link-sub-item d-flex
                                        @if(isset($userProfile->profile->user_id) && $userProfile->profile->user_id == $userProxy->id)
                                            @if(in_array($routeIndex, [MY_PAGE, USER_LIST_PHOTO_INDEX]) || in_array($routeIndex, [LIST_TOPIC]) || in_array($routeIndex, [PREVIEW_TOPIC_DETAIL]) )
                                                active-sub-item
                                            @endif
                                        @endif">
                                        <span class="text-body fs14">{{__('attributes.home.menu.personal_page_preview')}}</span>
                                        <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-silver.svg') }}"></span>
                                    </a>
                                @elseif($userProxy->role == EXPERT)
                                    <a href="{{ route(MY_PAGE, ['expert', $userProxy->id]) }}" class="nav-link nav-link-sub-item d-flex
                                        @if(isset($userProfile->profile->user_id) && $userProfile->profile->user_id == $userProxy->id)
                                            @if(in_array($routeIndex, [MY_PAGE, USER_LIST_PHOTO_INDEX]) || in_array($routeIndex, [LIST_TOPIC]) || in_array($routeIndex, [PREVIEW_TOPIC_DETAIL]) )
                                            active-sub-item
                                            @endif
                                        @endif">
                                        <span class="text-body fs14">{{__('attributes.home.menu.personal_page_preview')}}</span>
                                        <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-silver.svg') }}"></span>
                                    </a>
                                @endif
                            </li>
                        </ul>
                        @if(in_array($currentUser->role, [BROKER, EXPERT]))
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route(USER_ARTICLE_TEXT) }}" class="nav-link nav-link-sub-item @if($routeIndex == USER_ARTICLE_TEXT) active-sub-item @endif">
                                    <span class="text-body fs14">{{__('attributes.home.menu.topics_management')}}</span>
                                    <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-silver.svg') }}"></span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route(USER_PHOTO_ARCHIVE_INDEX) }}" class="nav-link nav-link-sub-item d-flex @if($routeIndex == USER_PHOTO_ARCHIVE_INDEX) active-sub-item @endif">
                                    <span class="text-body fs14">{{__('attributes.home.menu.photo_archive_management')}}</span>
                                    <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-silver.svg') }}"></span>
                                </a>
                            </li>
                        </ul>
                        @endif
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link nav-link-sub-item d-flex disabled">
                                    <span class="text-body fs14">{{__('attributes.home.menu.data_sharing_management')}}</span>
                                    <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-silver.svg') }}"></span>
                                </a>
                            </li>
                        </ul>
                        @if($currentUser->isExpert())
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link nav-link-sub-item d-flex disabled">
                                    <span class="text-body fs14">{{__('attributes.home.menu.seminar_registration')}}</span>
                                    <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-gold.svg') }}"></span>
                                </a>
                            </li>
                        </ul>
                        @endif
                        @if($currentUser->isInvestor())
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link nav-link-sub-item d-flex disabled">
                                        <span class="text-body fs14">{{ trans('attributes.top.header.plan_tbl_cell.title_16') }}</span>
                                        <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-silver.svg') }}"></span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link nav-link-sub-item d-flex disabled">
                                        <span class="text-body fs14">{{ trans('attributes.home.menu.register_conditions') }}</span>
                                        <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-bronze.svg') }}"></span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link nav-link-sub-item d-flex disabled">
                                        <span class="text-body fs14">{{ trans('attributes.home.menu.agent_registration') }}</span>
                                        <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-gold.svg') }}"></span>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="" class="nav-link nav-link-sub-item d-flex disabled">
                                        <span class="text-body fs14">{{ trans('attributes.home.menu.refinancing_registering') }}</span>
                                        <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-gold.svg') }}"></span>
                                    </a>
                                </li>
                            </ul>
                        @else
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="" class="nav-link nav-link-sub-item d-flex disabled">
                                    <span class="text-body fs14">{{__('attributes.home.menu.event_holding_registration')}}</span>
                                    <span class=""><img class="icon-menu-home" src="{{ asset('images/crown-gold.svg') }}"></span>
                                </a>
                            </li>
                        </ul>
                        @endif
                    </li>
                @endif
                @if($currentUser->isAdmin())
                    <li class="nav-item has-treeview menu-simulation-item @if(in_array($routeIndex, ADMIN_ROUTES)) menu-open @endif">
                        <a href="#" class="nav-link nav-link-item nl-ml-item @if(in_array($routeIndex, ADMIN_ROUTES)) active-item @endif">
                            <i class="fa text-body w10 @if(in_array($routeIndex, ADMIN_ROUTES)) fa-caret-down @else fa-caret-right @endif"></i>
                            <img class="icon-menu-home" src="{{ asset('images/management.svg') }}">
                            <span class="text-body fs15w500">{{ trans('attributes.home.menu.admin') }}</span>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Route(ADMIN_TOP) }}" class="nav-link nav-link-sub-item @if($routeIndex == ADMIN_TOP) active-sub-item @endif">
                                    <span class="text-body fs14">{{ trans('attributes.home.menu.admin_top') }}</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ Route(ADMIN_MANAGE_USER_INDEX) }}" class="nav-link nav-link-sub-item @if($routeIndex == ADMIN_MANAGE_USER_INDEX) active-sub-item @endif">
                                    <span class="text-body fs14">{{ trans('attributes.home.menu.admin_user') }}</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route(ADMIN_SHOW_LIST_TOPIC_SCREEN) }}" class="nav-link nav-link-sub-item @if($routeIndex == ADMIN_SHOW_LIST_TOPIC_SCREEN) active-sub-item @endif">
                                    <span class="text-body fs14">{{ trans('attributes.home.menu.admin_topic') }}</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route(ADMIN_ARTICLE_PHOTO_INDEX) }}" class="nav-link nav-link-sub-item @if($routeIndex == ADMIN_ARTICLE_PHOTO_INDEX) active-sub-item @endif">
                                    <span class="text-body fs14">{{ trans('attributes.home.menu.admin_photo_archive') }}</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route(ADMIN_USER_CREATE) }}" class="nav-link nav-link-sub-item @if($routeIndex == ADMIN_USER_CREATE) active-sub-item @endif">
                                    <span class="text-body fs14">{{ trans('attributes.home.menu.admin_user_invitation') }}</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route(ADMIN_MANAGE_USER_LIST_CSV) }}" class="nav-link nav-link-sub-item @if($routeIndex == ADMIN_MANAGE_USER_LIST_CSV) active-sub-item @endif">
                                    <span class="text-body fs14">{{ trans('attributes.home.menu.admin_download_csv') }}</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route(ADMIN_MANAGE_CONTACT) }}" class="nav-link nav-link-sub-item @if($routeIndex == ADMIN_MANAGE_CONTACT) active-sub-item @endif">
                                    <span class="text-body fs14">{{ trans('attributes.home.menu.admin_contact') }}</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route(ADMIN_MANAGE_SUPPORT) }}" class="nav-link nav-link-sub-item @if($routeIndex == ADMIN_MANAGE_SUPPORT) active-sub-item @endif">
                                    <span class="text-body fs14">{{ trans('attributes.home.menu.admin_support') }}</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route(ADMIN_MANAGE_INFORMATION) }}" class="nav-link nav-link-sub-item @if($routeIndex == ADMIN_MANAGE_INFORMATION) active-sub-item @endif">
                                    <span class="text-body fs14">{{ trans('attributes.home.menu.admin_information') }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if($currentUser->role != ADMIN)
                    <li class="nav-item has-treeview menu-simulation-item @if(in_array($routeIndex, [USER_SUPPORT_CREATE, USER_CONTACT_CREATE])) menu-open @endif">
                        <a href="#" class="nav-link nav-link-item nl-ml-item @if(in_array($routeIndex, [USER_SUPPORT_CREATE, USER_CONTACT_CREATE])) active-item @endif">
                            <i class="fa text-body w10 @if(in_array($routeIndex, [USER_SUPPORT_CREATE, USER_CONTACT_CREATE])) fa-caret-down @else fa-caret-right @endif"></i>
                            <img class="icon-menu-home" src="{{ asset('images/contact.png') }}">
                            <span class="text-body fs15w500">{{ trans('attributes.header.contact') }}</span>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route(USER_CONTACT_CREATE) }}" class="nav-link nav-link-sub-item  @if($routeIndex == USER_CONTACT_CREATE) active-sub-item @endif">
                                    <span class="text-body fs14">{{ trans('attributes.support.contact_us') }}</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route(USER_SUPPORT_CREATE) }}" class="nav-link nav-link-sub-item @if($routeIndex == USER_SUPPORT_CREATE) active-sub-item @endif">
                                    <span class="text-body fs14">{{ trans('attributes.support.paid_support') }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
            @endif
        </ul>
        @if($currentUser && !$currentUser->isAdmin())
        <div class="side-bottom">
            <div class="planDetailList">
                <dl class="planDetail">
                    <dt class="icon"><img src="{{ asset('images/crown-bronze.svg') }}"></dt>
                    <dd>
                        <p class="small_txt">{{ trans('attributes.sidebar_information.bronze') }}</p>
                    </dd>
                </dl>
                <dl class="planDetail">
                    <dt class="icon"><img src="{{ asset('images/crown-silver.svg') }}"></dt>
                    <dd>
                        <p class="small_txt">{{ trans('attributes.sidebar_information.silver') }}</p>
                    </dd>
                </dl>
                <dl class="planDetail">
                    <dt class="icon"><img src="{{ asset('images/crown-gold.svg') }}"></dt>
                    <dd>
                        <p class="small_txt">{{ trans('attributes.sidebar_information.gold') }}</p>
                    </dd>
                </dl>
            </div><!-- planDetailList -->

            <p class="small_txt">{{ trans('attributes.sidebar_information.note') }}</p>

            <div class="bannerList">
                <a href="#"><img src="{{ asset('images/banner1.jpg') }}" alt=""></a>
            </div><!-- bannerList -->

            <div class="side-bottom-nav">
                <ul>
                    <li><a href="#"><span class="fs14">{{ trans('attributes.header.faq') }}</span></a></li>
                    <li><a href="{{ route(PRIVACY) }}"><span class="fs14">{{ trans('attributes.footer.policy') }}</span></a></li>
                </ul>
            </div><!-- side-bottom-nav -->
        </div>
        @endif
    </nav>
</aside>
