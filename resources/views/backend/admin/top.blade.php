@extends('layout.home.master')
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-bank container-padding">
        <div id="main-info-assessment">
            <div class="row row-header m30b">
                <div class="row m0">
                    <div class="col-12 text-center text-md-left p0">
                        <h3 class="m0">{{ trans('attributes.admin.top_title') }}</h3>
                    </div>
                </div>
            </div>

            <div id="div-delete-success" class="wp99 m10-auto delete-topic alert alert-success success no-print" style="display: none" role="alert">
                <button class="close" data-dismiss="alert">×</button>
                <span class="delete-success delete-topic-success"></span>
            </div>
            <div class="wp99 m10-auto delete-photo alert alert-success success no-print" style="display: none" role="alert">
                <button class="close" data-dismiss="alert">×</button>
                <span class="delete-success delete-photo-success"></span>
            </div>

            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">{{ trans('attributes.admin.manage_user_title') }}</h3>
                        </div>

                        <div class="card-body p-0">
                            <div class='table-responsive'>
                                <table class="table table-striped projects">
                                    <thead>
                                    <tr>
                                        <th class="w-20">{{ trans('attributes.article_photo.user_name') }}</th>
                                        <th class="w-20">{{ trans('attributes.admin_manager.user.type') }}</th>
                                        <th class="w-20">{{ trans('attributes.admin_manager.user.state') }}</th>
                                        <th class='text-center w-10'>{{ trans('attributes.admin_manager.user.number_sub_user') }}</th>
                                        <th class='text-center w-10'>{{ trans('attributes.admin_manager.user.registration_date') }}</th>
                                        <th class='text-center w-10'>{{ trans('attributes.admin_manager.user.update_date') }}</th>
                                        <th class='text-center w-10'>{{ trans('attributes.admin_manager.user.last_login') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($dataUser as $user)
                                            <tr>
                                                <td><a href='{{ route(ADMIN_MANAGE_USER_DETAIL_INDEX, ['userId' => $user->id]) }}'>{{ isset($user->person_charge_last_name) ? $user->person_charge_last_name . $user->person_charge_first_name : $user->email }}</a></td>
                                                <td>{{ ROLES_JA[$user->role] }}</td>
                                                <td>{{ MEMBER_STATUS[$user->member_status] }}</td>
                                                <td class='text-center'>{{ $user->sub_user }}</td>
                                                <td class='text-center'>{{ $user->created_at ? date("Y/m/d", strtotime($user->created_at)) : "ー" }}</td>
                                                <td class='text-center'>2020/01/01</td>
                                                <td class='text-center'>{{ $user->last_login ? date("Y/m/d", strtotime($user->last_login)) : "ー" }}</td>
                                            </tr>
                                        @empty
                                            <td colspan="7" class="text-center">{{ __('attributes.common.no_data') }}</td>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="{{ Route(ADMIN_MANAGE_USER_INDEX) }}" class="btn btn-default float-right">{{ trans('attributes.admin.manage_user_btn') }}</a>
                        </div>

                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <div class="card-header">

                            <h3 class="card-title">{{ trans('attributes.admin.admin_topic_title') }}</h3>

                            <div class="card-tools d-flex align-items-center">
                                <div class="dropdown mr-1 custom-select-dropdown">
                                    <a class="btn btn-light dropdown-toggle btn-sm select-dropdown w105" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ trans('attributes.admin_manager.topics.category') }}
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <li class="dropdown-item pointer select-dropdown">---</li>
                                        <li class="dropdown-item pointer select-dropdown">{{ trans('attributes.my_page.notice') }}</li>
                                        <li class="dropdown-item pointer select-dropdown">{{ trans('attributes.my_page.results_of_activities') }}</li>
                                        <li class="dropdown-item pointer select-dropdown">{{ trans('attributes.my_page.survey_research') }}</li>
                                        <li class="dropdown-item pointer select-dropdown">{{ trans('attributes.my_page.events') }}</li>
                                        <li class="dropdown-item pointer select-dropdown">{{ trans('attributes.my_page.employment_information') }}</li>
                                    </ul>
                                    <input name="category_name" type="hidden" class="form-control">
                                </div>
                                <div class="input-group input-group-sm">
                                    <input name="user_name" type="text" class="form-control" placeholder="{{ trans('attributes.article_photo.user_name') }}">
                                    <div class="input-group-append">
                                        <div id="search-topic" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="row m0 br10 bg-white">
                                <div id="list-table-topics" class="table-responsive">
                                </div>
                            </div>
                        </div>

                        <!-- /.card-body -->

                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div id="btn-list-topic" class="btn btn-default float-right">{{ trans('attributes.admin.manage_topic_btn') }}</div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <div class="card-header">

                            <h3 class="card-title">{{ trans('attributes.admin.manage_photo_title') }}</h3>

                            <div class="card-tools d-flex align-items-center">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control user-name-photo" name="user_name_photo" placeholder="{{ trans('attributes.article_photo.user_name') }}">
                                    <div class="input-group-append">
                                        <div id="search-top-photo"class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="card-body">
                            <div class="user_photo_wrap mp_r top-article-photo">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <div id="btn-top-article-photo" class="btn btn-default float-right">{{ trans('attributes.admin.manage_photo_btn') }}</div>
                        </div>

                    </div>

                </div>
            </div>


        </div>
    </div>
    @include('modal.delete.delete_topic')
    @include('modal.delete.delete_photo')
@endsection
@section('js')
    <script src="{{ asset('dist/js/top.min.js') }}"></script>
@endsection

