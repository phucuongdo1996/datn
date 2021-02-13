@extends('layout.home.master')
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid container-wrapper container-wrapper-bank container-list-topic">
            <form id="form-manage-list-topic" action="{{ route(ADMIN_SHOW_LIST_TOPIC_SCREEN) }}" method="GET">
                <div id="main-info-assessment">
                    <div class="row row-header mb-5">
                        <div class="row m0">
                            <div class="col-12 text-center text-md-left p0">
                                <h3 class="m0">{{ trans('attributes.admin_manager.topics.list_title') }}</h3>
                            </div>
                        </div>
                    </div>
                @include('partials.flash_messages')
                    <!--profile edit-->
                    <div class="row">
                        <div class="col-12">

                            <div class="card">

                                <div class="card-header">

                                    <h3 class="card-title">{{ trans('attributes.admin.manage_topic_title') }}</h3>

                                    <div class="card-tools d-flex align-items-center">
                                        <div class="dropdown mr-1 custom-select-dropdown">
                                            <a class="btn btn-light dropdown-toggle btn-sm select-dropdown w105"
                                               href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                               aria-haspopup="true" aria-expanded="false">
                                                {{ showSelectedValue(request('category_name'), TOPIC_CATEGORIES, trans('attributes.admin_manager.topics.category')) }}
                                            </a>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <li class="dropdown-item pointer select-dropdown">---</li>
                                                <li class="dropdown-item pointer select-dropdown">{{ trans('attributes.my_page.notice') }}</li>
                                                <li class="dropdown-item pointer select-dropdown">{{ trans('attributes.my_page.results_of_activities') }}</li>
                                                <li class="dropdown-item pointer select-dropdown">{{ trans('attributes.my_page.survey_research') }}</li>
                                                <li class="dropdown-item pointer select-dropdown">{{ trans('attributes.my_page.events') }}</li>
                                                <li class="dropdown-item pointer select-dropdown">{{ trans('attributes.my_page.employment_information') }}</li>
                                            </ul>
                                            <input name="category_name" type="hidden" class="form-control"
                                                   value="{{ (request('category_name') && in_array(request('category_name'), TOPIC_CATEGORIES)) ? request('category_name') : "" }}">
                                        </div>
                                        <div class="input-group input-group-sm">
                                            <input name="user_name" type="text" class="form-control"
                                                   placeholder="{{ trans('attributes.article_photo.user_name') }}" value="{{ request('user_name') ?? "" }}">
                                            <div class="input-group-append">
                                                <div id="search-list-topic" class="btn btn-primary">
                                                    <i class="fas fa-search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-0">
                                    <div class="row m0 br10 bg-white">
                                        <div class="table-responsive">
                                            @include('backend.admin.topics.table')
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    {{ $topics->appends([
                                        'user_name' => request('user_name') ?? '',
                                        'category_name' => request('category_name') ?? '',
                                    ])->links('partials.custom_pagination_manager', ['paginator' => $topics]) }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <input id="resolve-deleted" type="hidden" value="reload">
    @include('modal.delete.delete_topic')
@endsection
@section('js')
    <script src="{{ asset('dist/js/top.min.js') }}"></script>
@endsection
