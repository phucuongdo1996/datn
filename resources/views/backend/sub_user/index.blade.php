@extends('layout.home.master')
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-bank container-sub-user">
        <div class="row row-header mb-5">
            <div class="col-12 col-md-7 text-center text-md-left p0">
                <h3 class="m0">{{ trans('attributes.sub_user.title') }}</h3>
            </div>
            @if($typeShowListSubUser != SHOW_BY_FREE_MAIN_USER)
                <div class="col-12 col-md-5 text-right text-md-right">
                    <a href="{{ route(USER_SETTING_INDEX) }}" class="btn custom-btn-default w60 d-none d-sm-inline-block fs15 m5t m15r">{{ trans('attributes.my_page.topic.back') }}</a>
                    <a href="{{ route(SUB_USER_PROFILE_CREATE) }}" class="btn custom-btn-default fs13-sp m5t d-none d-sm-inline-block fs15">{{ trans('attributes.sub_user.title') }}{{ trans('attributes.repair_history.add.btn_add') }}</a>
                </div>
            @endif
        </div>
        @include('partials.flash_messages')
        <form id="form-change-permission" action="{{ route(SUB_USER_CHANGE_PERMISSION) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ trans('attributes.sub_user.title') }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="row m0 br10 bg-white">
                                <div class="table-responsive">
                                    <table id="table-property" class="table table-bordered table-striped border-0 m0">
                                        <tbody>
                                        @switch($typeShowListSubUser)
                                            @case (SHOW_BY_FEE_MAIN_USER)
                                                <tr class="table-head">
                                                    <th class="border-left-0 border-top-0 align-middle w-15" rowspan="2">{{ trans('attributes.admin_manager.user.user_name') }}</th>
                                                    <th class="border-top-0 align-middle w-10" rowspan="2">{{ trans('attributes.sub_user.id') }}</th>
                                                    <th class="border-top-0 align-middle w-15" rowspan="2">{{ trans('attributes.invite_user.mail_address') }}</th>
                                                    <th class="text-center border-top-0 align-middle w-40" colspan="4">{{ trans('attributes.sub_user.power') }}</th>
                                                    <th class="text-center border-top-0 align-middle w-10" rowspan="2">{{ trans('attributes.property.status') }}</th>
                                                    <th class="text-center border-top-0 align-middle w-10" rowspan="2">{{ trans('attributes.admin_manager.user.registration_date') }}</th>
                                                    <th class="text-center border-top-0 align-middle w-10" rowspan="2">{{ trans('attributes.admin_manager.user.update_date') }}</th>
                                                    <th class="text-center border-top-0 align-middle w-10" rowspan="2">{{ trans('attributes.admin_manager.user.last_login') }}</th>
                                                    <th class="text-center border-right-0 border-top-0 align-middle w-10" rowspan="2">{{ trans('attributes.common.delete') }}</th>
                                                </tr>
                                                <tr class="table-head">
                                                    <th class="border-top-0 w-10">
                                                        <p class="m0">{{ trans('attributes.sub_user.add_property') }}<br><span class="font-weight-normal">{{ trans('attributes.sub_user.explain_power_1') }}</span></p>
                                                    </th>
                                                    <th class="border-top-0 w-10">
                                                        <p class="m0">{{ trans('attributes.sub_user.user_operation') }}<br><span class="font-weight-normal break-all">{{ trans('attributes.sub_user.explain_power_2') }}</span></p>
                                                    </th>
                                                    <th class="border-top-0 w-10">
                                                        <p class="m0">{{ trans('attributes.sub_user.plan_operation') }}<br><span class="font-weight-normal">{{ trans('attributes.sub_user.explain_power_3') }}</span></p>
                                                    </th>
                                                    <th class="border-top-0 w-10">
                                                        <p class="m0">{{ trans('attributes.sub_user.mypage_operation') }}<br><span class="font-weight-normal break-all">{{ trans('attributes.sub_user.explain_power_4') }}</span></p>
                                                    </th>
                                                </tr>
                                                @forelse($infoSubUser as $value)
                                                    <tr class="table">
                                                        <td class="border-left-0"><a href="{{ route(USER_PROFILE_SUB_USER_EDIT, ['id' => $value->id]) }}">{{ $value->profile->person_charge_last_name . $value->profile->person_charge_first_name }}</a></td>
                                                        <td class="">{{ $value->user_code }}</td>
                                                        <td class=""><a href="mailto:{{ $value->email }}">{{ $value->email }}</a></td>
                                                        <td class="">
                                                            <div class="form-check text-center p0  centered">
                                                                <input data-id="{{ $value['id'] }}" name="role[{{ $value['id'] }}][change_property]" value="1" class="form-check-input m0 change-role" type="checkbox"
                                                                       @if($value->subUserPermission['change_property'] == FLAG_ONE) checked @endif>
                                                            </div>
                                                        </td>
                                                        <td class="">
                                                            <div class="form-check text-center p0  centered">
                                                                <input data-id="{{ $value['id'] }}" name="role[{{ $value['id'] }}][change_sub_user]" value="1" class="form-check-input m0 change-role" type="checkbox"
                                                                       @if($value->subUserPermission['change_sub_user'] == FLAG_ONE) checked @endif>
                                                            </div>
                                                        </td>
                                                        <td class="">
                                                            <div class="form-check text-center p0  centered">
                                                                <input data-id="{{ $value['id'] }}" name="role[{{ $value['id'] }}][change_plan]" value="1" class="form-check-input m0 change-role" type="checkbox"
                                                                       @if($value->subUserPermission['change_plan'] == FLAG_ONE) checked @endif>
                                                            </div>
                                                        </td>
                                                        <td class="">
                                                            <div class="form-check text-center p0  centered">
                                                                <input data-id="{{ $value['id'] }}" name="role[{{ $value['id'] }}][change_mypage]" value="1" class="form-check-input m0 change-role" type="checkbox"
                                                                       @if($value->subUserPermission['change_mypage'] == FLAG_ONE) checked @endif>
                                                            </div>
                                                        </td>
                                                        <td class="text-center p0dot7rem">
                                                            <select data-id="{{ $value['id'] }}" name="role[{{ $value['id'] }}][status]" class="btn form-control focus-out building-selection fs14 text-left change-role">
                                                                <option value="1" @if($value->subUserPermission['status'] == FLAG_ONE || !isset($value->subUserPermission['status'])) selected @endif>{{ trans('attributes.user_detail.active') }}</option>
                                                                <option value="0" @if($value->subUserPermission['status'] == FLAG_ZERO && isset($value->subUserPermission['status'])) selected @endif>{{ trans('attributes.user_detail.disable') }}</option>
                                                            </select>
                                                            <input id="change-{{ $value['id'] }}" name="change[]" value="{{ $value['id'] }}" class="form-check-input m0 d-none" type="checkbox">
                                                        </td>
                                                        <td class="text-center">{{ dateTimeFormat($value->created_at) }}</td>
                                                        <td class="text-center">{{ dateTimeFormat($value->updated_at) }}</td>
                                                        <td class="text-center">{{ $value->last_login ? dateTimeFormat($value->last_login) : 'ー' }}</td>
                                                        <td class="border-right-0 text-center">
                                                            <a class="user_delete delete-sub-user pointer" data-id="{{ $value->id }}"><i class="far fa-trash-alt" style='color:#d03c42;'></i></a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <td colspan="12" class="text-center border-0">{{ trans('attributes.repair_history.no_data') }}</td>
                                                @endforelse
                                            @break

                                            @case (SHOW_BY_SUB_USER)
                                                <tr class="table-head">
                                                    <th class="border-left-0 border-top-0 align-middle w-15">{{ trans('attributes.admin_manager.user.user_name') }}</th>
                                                    <th class="border-top-0 align-middle w-10">{{ trans('attributes.sub_user.id') }}</th>
                                                    <th class="border-top-0 align-middle w-15">{{ trans('attributes.invite_user.mail_address') }}</th>
                                                    <th class="text-center border-top-0 align-middle w-8">{{ trans('attributes.admin_manager.user.use_stop') }}</th>
                                                    <th class="text-center border-top-0 align-middle w-10">{{ trans('attributes.admin_manager.user.registration_date') }}</th>
                                                    <th class="text-center border-top-0 align-middle w-10">{{ trans('attributes.admin_manager.user.update_date') }}</th>
                                                    <th class="text-center border-top-0 align-middle w-10">{{ trans('attributes.admin_manager.user.last_login') }}</th>
                                                    <th class="text-center border-right-0 border-top-0 align-middle w-10">{{ trans('attributes.common.delete') }}</th>
                                                </tr>
                                                @forelse($infoSubUser as $value)
                                                    <tr class="table">
                                                        <td class="border-left-0"><a href="{{ route(USER_PROFILE_SUB_USER_EDIT, ['id' => $value->id]) }}">{{ $value->profile->person_charge_last_name . $value->profile->person_charge_first_name }}</a></td>
                                                        <td class="">{{ $value->user_code }}</td>
                                                        <td class=""><a href="mailto:{{ $value->email }}">{{ $value->email }}</a></td>
                                                        <td class="text-center">{{ $value->status == OPEN ? trans('attributes.admin_manager.user.in_use') : trans('attributes.admin_manager.user.use_stop') }}</td>
                                                        <td class="text-center">{{ dateTimeFormat($value->created_at) }}</td>
                                                        <td class="text-center">{{ dateTimeFormat($value->updated_at) }}</td>
                                                        <td class="text-center">{{ $value->last_login ? dateTimeFormat($value->last_login) : 'ー' }}</td>
                                                        <td class="border-right-0 text-center">
                                                            <a class="user_delete delete-sub-user pointer" data-id="{{ $value->id }}"><i class="far fa-trash-alt" style='color:#d03c42;'></i></a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <td colspan="8" class="text-center border-0">{{ trans('attributes.repair_history.no_data') }}</td>
                                                @endforelse
                                            @break

                                            @case (SHOW_BY_FREE_MAIN_USER)
                                                <tr class="table-head">
                                                    <th class="border-left-0 border-top-0 align-middle w-15">{{ trans('attributes.admin_manager.user.user_name') }}</th>
                                                    <th class="border-top-0 align-middle w-10">{{ trans('attributes.sub_user.id') }}</th>
                                                    <th class="border-top-0 align-middle w-15">{{ trans('attributes.invite_user.mail_address') }}</th>
                                                    <th class="text-center border-top-0 align-middle w-8">{{ trans('attributes.admin_manager.user.use_stop') }}</th>
                                                    <th class="text-center border-top-0 align-middle w-10">{{ trans('attributes.admin_manager.user.registration_date') }}</th>
                                                    <th class="text-center border-top-0 align-middle w-10">{{ trans('attributes.admin_manager.user.update_date') }}</th>
                                                    <th class="text-center border-top-0 align-middle w-10">{{ trans('attributes.admin_manager.user.last_login') }}</th>
                                                    <th class="text-center border-right-0 border-top-0 align-middle w-10">{{ trans('attributes.common.delete') }}</th>
                                                </tr>
                                                @forelse($infoSubUser as $value)
                                                    <tr class="table">
                                                        <td class="border-left-0"><a href="{{ route(USER_PROFILE_SUB_USER_EDIT, ['id' => $value->id]) }}">{{ $value->profile->person_charge_last_name . $value->profile->person_charge_first_name }}</a></td>
                                                        <td class="">{{ $value->user_code }}</td>
                                                        <td class=""><a href="mailto:{{ $value->email }}">{{ $value->email }}</a></td>
                                                        <td class="text-center">{{ $value->status == OPEN ? trans('attributes.admin_manager.user.in_use') : trans('attributes.admin_manager.user.use_stop') }}</td>
                                                        <td class="text-center">{{ dateTimeFormat($value->created_at) }}</td>
                                                        <td class="text-center">{{ dateTimeFormat($value->updated_at) }}</td>
                                                        <td class="text-center">{{ $value->last_login ? dateTimeFormat($value->last_login) : 'ー' }}</td>
                                                        <td class="border-right-0 text-center">
                                                            <a class="user_delete delete-sub-user pointer" data-id="{{ $value->id }}"><i class="far fa-trash-alt" style='color:#d03c42;'></i></a>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <td colspan="8" class="text-center border-0">{{ trans('attributes.repair_history.no_data') }}</td>
                                                @endforelse
                                            @break
                                        @endswitch
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        @if(!$currentUser->isSubUser() && $currentUser->member_status != FREE)
                            <div class="card-footer clearfix">
                                <button id="btn-submit-change-permission" type="button" class="btn btn-primary pull-right">{{ trans('attributes.sub_user.btn_save_power') }}</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('modal.confirm_delete_sub_user')
@endsection
@section('js')
    <script src="{{ asset('/dist/js/profile_sub_user.min.js') }}"></script>
@endsection
