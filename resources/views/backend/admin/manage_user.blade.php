@extends('layout.home.master')
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-bank container-manager-user">
        <div id="main-info-assessment">
            <div class="row row-header mb-3">
                <div class="row m0">
                    <div class="col-12 text-center text-md-left p0">
                        <h3 class="m0">{{ trans('attributes.admin_manager.user.title') }}</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                                <div class="card-tools d-flex flex-wrap align-items-center">
                                    <div class="dropdown mr-1 m2b custom-select-dropdown">
                                        <a class="btn btn-light dropdown-toggle btn-sm title-role w200" href="#" role="button"
                                           id="dropdown-menu-link" data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">
                                            {{ isset($param['role']) && in_array($param['role'], [(string)INVESTOR, (string)BROKER, (string)EXPERT]) ? ROLES_JA[$param['role']] : trans('attributes.admin_manager.user.role_all') }}
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdown-menu-link">
                                            <a class="dropdown-item role-option" data-id="" href="#">{{ trans('attributes.admin_manager.user.role_all') }}</a>
                                            <a class="dropdown-item role-option" data-id="0" href="#">{{ trans('attributes.role.investor') }}</a>
                                            <a class="dropdown-item role-option" data-id="1" href="#">{{ trans('attributes.role.broker') }}</a>
                                            <a class="dropdown-item role-option" data-id="2" href="#">{{ trans('attributes.role.expert') }}</a>
                                        </div>
                                    </div>
                                    <div class="dropdown mr-1 m2b custom-select-dropdown">
                                        <a class="btn btn-light dropdown-toggle btn-sm title-member-status w200" href="#" role="button"
                                           id="dropdown-menu-link" data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">
                                            {{ isset($param['member_status']) && in_array($param['member_status'], [(string)FREE, (string)BASIC, (string)PREMIUM, (string)TRIALS]) ? MEMBER_STATUS[$param['member_status']] : trans('attributes.admin_manager.user.status_all')  }}
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdown-menu-link">
                                            <a class="dropdown-item status-option" data-id="" href="#">{{ trans('attributes.admin_manager.user.status_all') }}</a>
                                            <a class="dropdown-item status-option" data-id="0"
                                               href="#">{{ trans('attributes.admin_manager.user.free') }}</a>
                                            <a class="dropdown-item status-option" data-id="1"
                                               href="#">{{ trans('attributes.admin_manager.user.fee') }}</a>
                                            <a class="dropdown-item status-option" data-id="2"
                                               href="#">{{ trans('attributes.admin_manager.user.premium') }}</a>
                                            <a class="dropdown-item status-option" data-id="3"
                                               href="#">{{ trans('attributes.admin_manager.user.trials') }}</a>
                                        </div>
                                    </div>
                                    <div class="dropdown mr-1 m2b custom-select-dropdown">
                                        <a class="btn btn-light dropdown-toggle btn-sm title-block-user w200" href="#" role="button"
                                           id="dropdown-menu-link" data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">
                                            {{ isset($param['block_user']) && in_array($param['block_user'], [(string)IN_USE, (string)USE_STOP]) ? USER_BLOCK[$param['block_user']] : trans('attributes.admin_manager.user.block_all') }}
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="dropdown-menu-link">
                                            <a class="dropdown-item block-option" data-id="" href="#">{{ trans('attributes.admin_manager.user.block_all') }}</a>
                                            <a class="dropdown-item block-option" data-id="0" href="#">{{ trans('attributes.admin_manager.user.in_use') }}</a>
                                            <a class="dropdown-item block-option" data-id="1" href="#">{{ trans('attributes.admin_manager.user.use_stop') }}</a>
                                        </div>
                                    </div>

                                    <form action="{{ route(ADMIN_MANAGE_USER_INDEX) }}" method="GET">
                                        <input type="hidden" id="role-id" name="role" value="{{ isset($param['role']) && in_array($param['role'], array_keys(ROLES_USER)) ? $param['role'] : '' }}">
                                        <input type="hidden" id="member-status-id" name="member_status" value="{{ isset($param['member_status']) && in_array($param['member_status'], array_keys(MEMBER_STATUS)) ? $param['member_status'] : '' }}">
                                        <input type="hidden" id="block-user" name="block_user" value="{{ isset($param['block_user']) && in_array($param['block_user'], array_keys(USER_BLOCK)) ? $param['block_user'] : '' }}">
                                        <div class="input-group input-group-sm w200 m0">
                                            <input type="text" class="form-control" name="nick_name" value="{{ isset($param['nick_name']) ? $param['nick_name'] : '' }}"
                                                   placeholder="{{ trans('attributes.admin_manager.user.user_name') }}">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                        </div>

                        <div class="card-body p-0">
                            <table class="table table-striped projects">
                                <thead>
                                <tr>
                                    <th class="w-20">{{ trans('attributes.admin_manager.user.user_name') }}</th>
                                    <th class="w-15">{{ trans('attributes.admin_manager.user.type') }}</th>
                                    <th class="w-15">{{ trans('attributes.admin_manager.user.state') }}</th>
                                    <th class="w-10">{{ trans('attributes.admin_manager.user.use_stop') }}</th>
                                    <th class='text-center'
                                        class="w-10">{{ trans('attributes.admin_manager.user.number_sub_user') }}</th>
                                    <th class='text-center'
                                        class="w-10">{{ trans('attributes.admin_manager.user.registration_date') }}</th>
                                    <th class='text-center'
                                        class="w-10">{{ trans('attributes.admin_manager.user.update_date') }}</th>
                                    <th class='text-center'
                                        class="w-10">{{ trans('attributes.admin_manager.user.last_login') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td><a href='{{ route(ADMIN_MANAGE_USER_DETAIL_INDEX, ['userId' => $user->id]) }}'>{{ isset($user->person_charge_last_name) ? $user->person_charge_last_name . $user->person_charge_first_name : $user->email }}</a></td>
                                        <td>{{ ROLES_JA[$user->role] }}</td>
                                        <td>{{ MEMBER_STATUS[$user->member_status] }}</td>
                                        <td>{{ empty($user->deleted_at) ? trans('attributes.admin_manager.user.in_use') : trans('attributes.admin_manager.user.use_stop')}}</td>
                                        <td class='text-center'>{{ $user->sub_user }}</td>
                                        <td class='text-center'>{{ $user->created_at ? date("Y/m/d", strtotime($user->created_at)) : "ー" }}</td>
                                        <td class='text-center'>2020/01/01</td>
                                        <td class='text-center'>{{ $user->last_login ? date("Y/m/d", strtotime($user->last_login)) : "ー" }}</td>
                                    </tr>
                                @empty
                                    <td colspan="8" class="text-center">{{ __('attributes.common.no_data') }}</td>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            {{ $users->appends([
                                'nick_name' => isset($param['nick_name']) ? $param['nick_name'] : '',
                                'role' => isset($param['role']) && in_array($param['role'], array_keys(ROLES_USER)) ? $param['role'] : '',
                                'member_status' => isset($param['member_status']) && in_array($param['member_status'], array_keys(MEMBER_STATUS)) ? $param['member_status'] : ''
                                ])->links('partials.custom_pagination_manager', ['paginator' => $users]) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('dist/js/user-manage.min.js') }}"></script>
@endsection
