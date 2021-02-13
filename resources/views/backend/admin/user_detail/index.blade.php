@extends('layout.home.master')
@section('content')
<div class="container-fluid container-wrapper container-wrapper-bank container-user-detail">
    <div id="main-info-assessment" data-user-id="{{ request('userId', null) }}">
        <div class="row row-header mb-5">
            <div class="row m0">
                <div class="col-12 text-center text-md-left p0">
                    <h3 class="m0">{{ isset($user['deleted_at']) ? trans('attributes.user_detail.deleted') . ' ': '' }} {{ isset($user['profile']) ? $user['profile']['person_charge_last_name'] . $user['profile']['person_charge_first_name'] : $user['email'] }}</h3>
                </div>
            </div>
        </div>

        @include('partials.flash_messages')

        <div id="div-delete-success" class="wp100 m10-auto delete-topic alert alert-success success no-print" style="display: none" role="alert">
            <button class="close" data-dismiss="alert">×</button>
            <span class="delete-success delete-topic-success"></span>
        </div>

        <div class="wp100 m10-auto delete-photo alert alert-success success no-print" style="display: none" role="alert">
            <button class="close" data-dismiss="alert">×</button>
            <span class="delete-success delete-photo-success"></span>
        </div>
        @if(!isset($user['deleted_at']))
        <!--profile edit-->
        <div class="row">
            <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('attributes.user_detail.title_1') }}</h3>
                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                @if(isset($user['profile']))
                    <div class="card-body">
                        @if($user['role'] == BROKER)
                            @include('backend.admin.users.profile.edit_broker', ['profile' => $user['profile'], 'specialties' => $specialties])
                        @elseif($user['role'] == EXPERT)
                            @include('backend.admin.users.profile.edit_expert', ['profile' => $user['profile'], 'specialties' => $specialties])
                        @elseif($user['role'] == INVESTOR)
                            @include('backend.admin.users.profile.edit_investor', ['profile' => $user['profile']])
                        @endif
                    </div>
                    <div class="card-footer">
                        <button id="admin-update-info" class="btn btn-primary float-right btn-in-detail">{{ __('attributes.user_detail.btn_submit') }}</button>
                    </div>
                @else
                    <div class="card-body text-center">
                        {{ trans('attributes.common.no_data') }}
                    </div>
                @endif
                <!-- /.card-body -->
              </div>
          </div>
        </div>

        <!--data & status-->
        <div class="row">
            <div class="col-6">
                <form id="form-update-payment" method="POST" action="{{ route(ADMIN_FUTURE_DATE_UPDATE, $user['id']) }}">
                    <div class="card">
                        <input type="hidden" name="time_open_page" value="{{ date('Y/m/d H:i:s', time()) }}" readonly>
                        <input type="hidden" name="subscription_id" value="{{ $dataSubscription['id'] }}" readonly>
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title">{{ __('attributes.user_detail.title_2') }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('attributes.user_detail.content_2') }}</label>
                                <input type="text" class="form-control" placeholder="{{ isset($user['created_at']) ? dateTimeFormat($user['created_at']) : '' }}" disabled="">
                            </div>
                            <div class="form-group">
                                <label>{{ __('attributes.user_detail.content_3') }}</label>
                                <input type="text" class="form-control" placeholder="{{ $user['member_status'] != FREE ?  isset($dataSubscription['start_date']) ? dateTimeFormat($dataSubscription['start_date']) : '' : '' }}" disabled="">
                            </div>
                            <div class="form-group">
                                <label>{{ __('attributes.user_detail.content_4') }}</label>
                                <input type="text" class="form-control date-time @error('finish_date')input-error @enderror"
                                       name="finish_date" @error('finish_date')autofocus @enderror
                                       value="{{ old('finish_date', convertDateTime($dataSubscription['finish_date'])) }}" @if($dataSubscription == null || $user['member_status'] == FREE) disabled @endif>
                                @error('finish_date')
                                    <div class="error-message p5t m0 break-all">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('attributes.user_detail.content_26') }}</label>
                                <div class="row form-group position-relative m0">
                                    <input name="discount-output" type="text" value="{{ number_format(old('discount', $dataSubscription['discount']), FLAG_TWO) }}" class="form-control convert-number-double-decimal @error('discount')input-error @enderror" @error('discount')autofocus @enderror placeholder="0.00">
                                    <input name="discount" type="hidden" value="{{ old('discount', $dataSubscription['discount']) }}" class="form-control convert-number-double-decimal @error('discount')input-error @enderror" placeholder="0.00">
                                    <input class="m0 form-control position-absolute w40 right-0 @error('discount')input-error-custom @enderror" value="{{ trans('attributes.common.percent') }}" style="border-left: none !important;" disabled>
                                </div>
                                @error('discount')
                                    <div class="error-message p5t m0 break-all">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="button" id="update-payment" class="btn btn-primary float-right btn-in-detail" @if($dataSubscription == null || $user['member_status'] == FREE) disabled @endif>{{ __('attributes.user_detail.btn_submit') }}</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-6">
                <form id="change-member-status" method="POST" action="{{ route(ADMIN_MEMBER_STATUS_UPDATE, $user['id']) }}">
                    <div class="card">
                        <input type="hidden" name="time_open_page" value="{{ date('Y/m/d H:i:s', time()) }}" readonly>
                        @csrf
                        <div class="card-header">
                            <h3 class="card-title">{{ __('attributes.user_detail.title_3') }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('attributes.user_detail.content_5') }}</label>
                                <input type="text" class="form-control" placeholder="{{ isset($user['member_status']) ? MEMBER_STATUS[$user['member_status']] : '' }}" disabled="">
                            </div>
                            <div class="form-group">
                                <label>{{ __('attributes.user_detail.content_6') }}</label>
                                <select class="form-control" name="member_status">
                                    @foreach(MEMBER_STATUS as $key => $value)
                                        @if($key != TRIALS || $key == $user['member_status'])
                                            <option value="{{ $key }}"
                                                    @if($key == $user['member_status']) selected disabled @endif>
                                                {{ $value }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            @if($user['member_status'] == TRIALS)
                                <button type="button" class="btn btn-primary float-right show-confirm-trial btn-in-detail">{{ __('attributes.user_detail.btn_submit') }}</button>
                            @else
                                <button type="button" id="update-member-status" class="btn btn-primary float-right btn-in-detail">{{ __('attributes.user_detail.btn_submit') }}</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!--property list-->
        <div class="row" id="admin-user-list-property">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.user_detail.title_4') }}</h3>
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="row m0 br10 bg-white">
                            <div class="table-responsive" id="property-results">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--profile edit-->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.user_detail.title_5') }}</h3>
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="row m0 br10 bg-white">
                            <div class="table-responsive">
                                <table id="table-property" class="table table-bordered table-striped border-0 m0">
                                    <tr class="table-head">
                                        <th style="width: 25%" class="border-left-0 border-top-0">{{ __('attributes.user_detail.content_9') }}</th>
                                        <th style="width: 25%" class="border-top-0">{{ __('attributes.user_detail.content_10') }}</th>
                                        <th style="width: 30%" class="border-top-0">{{ __('attributes.user_detail.content_11') }}</th>
                                        <th style="width: 10%" class="border-top-0 text-center">{{ trans('attributes.admin_manager.user.use_stop') }}</th>
                                        <th style="width: 10%" class='text-center border-right-0 border-top-0'>{{ __('attributes.user_detail.content_12') }}</th>
                                    </tr>

                                    @forelse($subUsers as $key => $subUser)
                                    <tr class="table">
                                        <td class="border-left-0"><a href="{{ route(ADMIN_SUB_USER_EDIT, ['userId' => $user['id'], 'id' => $subUser['id']]) }}">{{ $subUser['profile']['person_charge_last_name'].$subUser['profile']['person_charge_first_name'] }}</a></td>
                                        <td class="">{{ $subUser['user_code'] }}</td>
                                        <td class=""><a href="{{ 'mailto:'.$subUser['email']}}">{{ $subUser['email'] }}</a></td>
                                        <td class="text-center">{{ $subUser['status'] == OPEN ? trans('attributes.admin_manager.user.in_use') : trans('attributes.admin_manager.user.use_stop') }}</td>
                                        <td class="border-right-0 text-center">
                                            <a href="javascript:;" data-id="{{ $subUser['id'] }}" class="user_delete">
                                                <i class="far fa-trash-alt" style='color:#d03c42;'></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="table">
                                        <td colspan="5" class="text-center border-left-0 border-right-0">{{ __('attributes.common.no_data') }}</td>
                                    </tr>
                                    @endforelse
                                    @if($user['member_status'] !== FREE)
                                    <tr class="table footer-table">
                                        <td colspan="5" class="text-center border-0"><a href="{{ route(ADMIN_SUB_USER_CREATE, $user['id']) }}" class="btn btn-primary">{{ __('attributes.user_detail.btn_add_sub_user') }}</a></td>
                                    </tr>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--profile edit-->
        <div class="row">
            <div class="col-md-9 col-12">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="fas fa-yen-sign"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">{{ __('attributes.user_detail.content_13') }}</span>
                        <span class="font-weight-bold lead total-money">{{ number_format(displayAmountByMemberAndRole($user['member_status'], $user['role']) + $totalSubUserNotPaid * ($user['role'] == INVESTOR ? MONEY_SUB_USER_BY_INVESTOR : MONEY_SUB_USER_BY_BROKER_EXPERT)) }}</span>
                    </div>
                <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.user_detail.title_6') }}</h3>
                    </div>
                    <div class="card-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-3">{{ __('attributes.user_detail.content_14') }}</dt>
                            <dd class="col-sm-9">{{ number_format(displayAmountByMemberAndRole($user['member_status'], $user['role'])) }} {{ __('attributes.common.yen') }}（{{ __('attributes.user_detail.content_not_tax') }}）</dd>
                            <dt class="col-sm-3">{{ __('attributes.user_detail.content_16') }}</dt>
                            <dd class="col-sm-9 fee-sub-money">{{ number_format($totalSubUserNotPaid * ($user['role'] == INVESTOR ? MONEY_SUB_USER_BY_INVESTOR : MONEY_SUB_USER_BY_BROKER_EXPERT)) }} {{ __('attributes.common.yen') }}（{{ __('attributes.user_detail.content_not_tax') }}）</dd>
                        </dl>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <!-- /.col -->
            <div class="col-md-3 col-12">
                <div class="col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-calendar-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('attributes.user_detail.content_17') }}</span>
                            <span class="font-weight-bold lead start-payment-date">{{ $user['member_status'] != FREE ? isset($dataSubscription) ? dateTimeFormat($dataSubscription['start_date']) : '' : '' }}</span>
                        </div>
                    <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="far fa-check-circle"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('attributes.user_detail.content_18') }}</span>
                            <span class="font-weight-bold lead">成功</span>
                        </div>
                    <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <div class="col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-calendar-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{ __('attributes.user_detail.content_19') }}</span>
                            <span class="font-weight-bold lead future-payment-date">{{ $user['member_status'] != FREE ? isset($dataSubscription) ? dateTimeFormat($dataSubscription['finish_date']) : '' : '' }}</span>
                        </div>
                    <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>

        </div>

        <!--profile edit-->
        <div class="row">
            @if($user['member_status'] != TRIALS)
                <div class="col-6">
                    <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.user_detail.title_7') }}</h3>
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    @if(count($subUsers) == FLAG_ZERO)
                        <div class="card-body text-center">
                            {{ trans('attributes.common.no_data') }}
                        </div>
                    @else
                        <div class="card-body">
                            <form id="form-sub-user-checkbox" action="" method="">
                                <input type="hidden" name="parent_user" value="{{ $user['id']}}" readonly>
                                <div class="form-group">
                                    <label>{{ __('attributes.user_detail.content_20') }}</label>
                                    <div class="form-group d-flex flex-wrap all-check-wrap">
                                        <div class="form-check mr-3">
                                            <input class="form-check-input all-check-trg check-all" id="check-all-subuser" type="checkbox">
                                            <label class="form-check-label" for="check-all-subuser">{{ __('attributes.user_detail.content_all') }}</label>
                                        </div>
                                        @foreach($subUsers as $key => $value)
                                            <div class="form-check mr-3">
                                                <input class="form-check-input check-items" type="checkbox" id="sub-user-{{ $key }}" name="sub_user[]" value="{{ $value['id'] }}">
                                                <label class="form-check-label" for="sub-user-{{ $key }}">{{ $value['profile']['person_charge_last_name'] . $value['profile']['person_charge_first_name'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <p class="error-message p5t m0" data-error="sub_user"></p>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('attributes.user_detail.content_id_user') }}</label>
                                    <input type="text" class="form-control" placeholder="{{ __('attributes.user_detail.content_id_place_holder') }}" name="sub_user_email_to" value="">
                                    <p class="error-message p5t m0" data-error="sub_user_email_to"></p>
                                    <input type="hidden" value="{{ request('userId', null) }}" name="user_from">
                                    <input type="hidden" value="{{ $user['email'] }}" name="email_from">
                                    <input type="hidden" value="{{ $user['profile']['person_charge_first_name'] ?? '' }}" name="person_charge_first_name_from">
                                    <input type="hidden" value="{{ $user['profile']['person_charge_last_name'] ?? '' }}" name="person_charge_last_name_from">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button id="submit-form-sub-user-checkbox" type="button" class="btn btn-primary float-right btn-in-detail">{{ __('attributes.user_detail.btn_submit') }}</button>
                        </div>
                    @endif
                  </div>
                </div>
                <div class="col-6">
                    <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.user_detail.title_8') }}</h3>
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    @if(count($listProperty) == FLAG_ZERO)
                        <div class="card-body text-center">
                            {{ trans('attributes.common.no_data') }}
                        </div>
                    @else
                        <div class="card-body">
                            <form id="form-property-checkbox" action="" method="">
                                <input type="hidden" name="parent_user" value="{{ $user['id']}}" readonly>
                                <div class="form-group">
                                    <label>{{ __('attributes.user_detail.content_21') }}</label>
                                    <div class="d-flex flex-wrap all-check-wrap">
                                        <div class="form-check mr-3">
                                            <input class="form-check-input all-check-trg check-all" type="checkbox"
                                                   id="check-all-property">
                                            <label class="form-check-label"
                                                   for="check-all-property">{{ __('attributes.user_detail.content_all') }}</label>
                                        </div>
                                        @foreach($listProperty as $key => $value)
                                            <div class="form-check mr-3">
                                                <input class="form-check-input check-items" type="checkbox"
                                                       id="property-{{ $key }}"
                                                       name="property[]" value="{{ $value['id'] }}">
                                                <label class="form-check-label"
                                                       for="property-{{ $key }}">{{ $value['house_name'] }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <p class="error-message p5t m0" data-error="property"></p>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('attributes.user_detail.content_id_user') }}</label>
                                    <input type="text" class="form-control"
                                           placeholder="{{ __('attributes.user_detail.content_id_place_holder') }}"
                                           value="" name="email_to">
                                    <p class="error-message p5t m0" data-error="email_to"></p>
                                    <input type="hidden" value="{{ request('userId', null) }}" name="user_from">
                                    <input type="hidden" value="{{ $user['email'] }}" name="email_from">
                                    <input type="hidden" value="{{ $user['profile']['person_charge_first_name'] ?? '' }}" name="person_charge_first_name_from">
                                    <input type="hidden" value="{{ $user['profile']['person_charge_last_name'] ?? '' }}" name="person_charge_last_name_from">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button id="submit-form-property-checkbox" type="button"
                                    class="btn btn-primary float-right btn-in-detail">{{ __('attributes.user_detail.btn_submit') }}</button>
                        </div>
                    @endif
                  </div>
                </div>
            @endif
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('attributes.user_detail.title_9') }}</h3>
                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p>{{ __('attributes.user_detail.content_22') }}<br />{{ __('attributes.user_detail.content_23') }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-danger btn-block {{ isset($user['deleted_at']) ? 'disabled' : '' }}" data-toggle="modal" data-target="#confirm-modal">{{ __('attributes.user_detail.title_9') }}</a>
                    </div>
                </div>
            </div>
        </div>

        <!--profile edit-->
        <div class="row">
            <div class="col-12">
                <div class="card user-detail-topic">
                </div>
            </div>
        </div>

        <!--profile edit-->
        <div class="row">
            <div class="col-12">
                <div class="card user-detail-photo">
                </div>
            </div>
        </div>
        @else
            <form action="{{ route(ADMIN_MANAGE_UNBLOCK_USER, ['id' => $user['id']]) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ trans('attributes.unblock_user.tittle') }}</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body" style="display: block;">
                                <div class="form-group">
                                    <label>{{ trans('attributes.profile.header.label_nickname') }}</label>
                                    <input type="text" class="form-control" placeholder=""
                                           value="{{ $user['profile']['nick_name'] }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('attributes.tax.full_name1') }}</label>
                                    <input type="text" class="form-control" placeholder=""
                                           value="{{ $user['profile']['person_charge_last_name'] . $user['profile']['person_charge_first_name'] }}"
                                           disabled>
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('attributes.register.step1.label_email') }}</label>
                                    <input type="text" class="form-control" placeholder="" value="{{ $user['user_code'] }}"
                                           disabled>
                                </div>
                                <div class="form-group">
                                    <label>{{ trans('attributes.invite_user.mail_address') }}</label>
                                    <input type="text" class="form-control" placeholder=""
                                           value="{{ $user['email'] }}" disabled>
                                </div>
                            </div>
                            <div class="card-footer" style="display: block">
                                <button type="submit"
                                        class="btn btn-danger">{{ trans('attributes.unblock_user.btn_unblock') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="sub-user-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content br8">
            <form id="form-delete-sub-user" method="POST" class="form-data-submit">
                @method('delete')
                @csrf
                <div class="modal-header fs16">
                    {{ __('attributes.user_detail.title_modal_1') }}
                    <button type="button" class="close close-modal-block" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>{{ trans('attributes.my_page.topic.divorce') }}</label>
                                <textarea id="reason-delete-sub-user" name="reason_delete" class="form-control" rows="3" placeholder=""></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn custom-btn-default close-modal-block" data-dismiss="modal">{{ __('attributes.user_detail.btn_cancel_modal') }}</button>
                    <button type="submit" id="btn-delete-sub-user" class="btn custom-btn-success">{{ __('attributes.user_detail.ok') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-modal" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content br8">
            <form id="form-block-user" action="{{ route(ADMIN_MANAGE_USER_DETAIL_DELETE, request('userId', null)) }}" method="POST" class="form-data-submit">
                @method('delete')
                @csrf
                <div class="modal-header fs16">
                    {{ __('attributes.user_detail.title_modal_2') }}
                    <button type="button" class="close close-modal-block" data-dismiss="modal">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <!-- textarea -->
                            <div class="form-group">
                                <label>{{ __('attributes.user_detail.content_modal_2') }}</label>
                                <textarea id="reason-block-user" name="reason_delete" class="form-control" rows="3" placeholder=""></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn custom-btn-default close-modal-block" data-dismiss="modal">{{ __('attributes.user_detail.btn_cancel_modal') }}</button>
                    <button type="submit" id="btn-block-user" class="btn custom-btn-success">{{ __('attributes.common.ok') }}</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- End_modal -->
@include('modal.delete.delete_topic')
@include('modal.delete.delete_photo')
@include('modal.preview.show_confirm_trial')
@endsection
@section('js')
    <script src="{{ asset('dist/js/admin-user-detail.min.js') }}"></script>
    <script src="{{ asset('/dist/js/profile.min.js') }}"></script>
@endsection
