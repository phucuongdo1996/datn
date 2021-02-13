@extends('layout.home.master')

@section('content')
    <div class="container-fluid container-wrapper balance-full-view">
        <div class="essential-content">
            <div class="row essential-header p0 m-0 media-575-p20l media-575-p20r">
                <div class="col-lg-12 p0">
                    <div>
                        <span class="essential-title fs28">{{ trans('attributes.setting.header.title') }}</span>
                    </div>
                    <div>
                        <span class="fs14">{{ trans('attributes.setting.header.sub_title') }}</span>
                    </div>
                </div>
            </div>

            <div class="m20t">
                @include('partials.flash_messages')
            </div>
            <input type="hidden" name="time_open_page" id="time-open-page" value="{{ date('Y/m/d H:i:s', time()) }}" readonly>

            @if($userProxy->isUser() && $userSubscription != null)
                <div class="row m30t essential-body m-0">
                    @if(!$currentUser->isSubUser())
                        <div class="col-lg-12 p0 p5l">
                            <span class="fs18 fw-bold color-2c3348">{{ trans('attributes.sub_user.title') }}</span>
                        </div>
                        <div class="col-lg-12 m10t text-left p0 p5l">
                            <a href="{{ route(SUB_USER_INDEX) }}" class="btn custom-btn-default m5t btn-process">{{ trans('attributes.sub_user.title') }}</a>
                            <button class="btn custom-btn-default m5t m20l btn-process p0" @if($currentUser->member_status == FREE) disabled @endif>
                                <a href="{{ route(SUB_USER_PROFILE_CREATE) }}" class="btn btn-process">{{ trans('attributes.sub_user.add.btn_add') }}</a>
                            </button>
                                @if($amount['total_sub'] > FLAG_ZERO)
                                <button class="btn custom-btn-default m5t m20l btn-process p0" @if($currentUser->member_status == FREE) disabled @endif>
                                    <a href="{{ route(SUB_USER_PROPERTY_CREATE) }}" class="btn btn-process">{{ trans('attributes.sub_user.sub_user_power') }}</a>
                                </button>
                            @endif
                        </div>
                    @elseif($currentUser->hasPermission(CHANGE_SUB_USER))
                        <div class="col-lg-12 p0 p5l">
                            <span class="fs18 fw-bold color-2c3348">{{ trans('attributes.sub_user.title') }}</span>
                        </div>
                        <div class="col-lg-12 m10t text-left p0 p5l">
                            <a href="{{ route(SUB_USER_INDEX) }}" class="btn custom-btn-default m5t btn-process">{{ trans('attributes.sub_user.title') }}</a>
                            <a href="{{ route(SUB_USER_PROFILE_CREATE) }}" class="btn custom-btn-default m5t m20l btn-process">{{ trans('attributes.sub_user.add.btn_add') }}</a>
                        </div>
                    @endif

                    <div class="col-lg-12 m30t p0 p5l">
                        <table class="table table-bordered w-70">
                            <thead>
                            <tr>
                                <th></th>
                                <th class="text-center">{{ trans('attributes.setting.body.money_by_account') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($currentUser->role == INVESTOR )
                            <tr>
                                <td>{{ trans('attributes.role.investor') }}</td>
                                <td class="text-right">{{ trans('attributes.common.unit_yen') . MONEY_SUB_USER_BY_INVESTOR }}</td>
                            </tr>
                            @else
                            <tr>
                                <td>{{ trans('attributes.top.header.price_plan_kind_2') }}</td>
                                <td class="text-right">{{ trans('attributes.common.unit_yen') . number_format(MONEY_SUB_USER_BY_BROKER_EXPERT) }}</td>
                            </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            @if(!$currentUser->isSubUser() || $currentUser->hasPermission(CHANGE_PLAN))
                @if(!$userProxy->isFreeMember())
                    <div class="card m30t">

                        <div class="card-header">
                            <h3 class="card-title">{{ trans('attributes.setting.pay.current_contract_information') }}</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-12 m10t p0l p0r">

                                <!--無料会員の場合-->
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ trans('attributes.setting.pay.plans_under_contract') }}</th>
                                        <th>{{ trans('attributes.setting.pay.quantity') }}</th>
                                        <th>{{ trans('attributes.setting.pay.fee') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{ PLAN_TEXT_NAME[$userProxy->getMemberStatus()] }}</td>
                                        <td>1</td>
                                        <td>{{ trans('attributes.common.unit_yen') . number_format($amount['amounts_by_member']) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ trans('attributes.setting.pay.sub_user') }}</td>
                                        <td>{{ $amount['total_sub'] }}</td>
                                        <td>{{ trans('attributes.common.unit_yen') . number_format($amount['total_sub'] *  $amount['amounts_by_sub_user']) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ trans('attributes.setting.pay.discount_rate') }}</td>
                                        <td class="text-danger">{{ $userSubscription['discount'] . __('attributes.common.percent') }}</td>
                                        <td class="text-danger">{{ trans('attributes.common.unit_yen') . number_format($amount['discount_value']) }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{ trans('attributes.info_billing.sale_tax') }}</td>
                                        <td>{{ number_format(TAX_PERSONAL * FLAG_ONE_HUNDRED, FLAG_TWO) . trans('attributes.common.percent') }}</td>
                                        <td>{{ trans('attributes.common.unit_yen') . number_format($amount['tax']) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="background-color:#666;color:#fff;" align="right">{{ trans('attributes.setting.pay.total_charges') }}</td>
                                        <td>{{ trans('attributes.common.unit_yen') . number_format($amount['total_amount']) }}</td>
                                    </tr>
                                    </tbody>
                                </table>

                                <table class="table table-bordered mt-4">
                                    <tbody>
                                    @if($userProxy->inTrial())
                                        <tr>
                                            <th>{{ trans('attributes.setting.pay.free_period') }}</th>
                                            <td>
                                                <p>{{ date('yy/m/d', strtotime($userSubscription['start_date'])) . '〜' . date('yy/m/d', strtotime($userSubscription['finish_date'])) }}</p>
                                                <p class="text-danger small mb-0">{{ trans('attributes.setting.pay.downgrade_trial') }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('attributes.setting.pay.billing_start_date') }}</th>
                                            <td>{{ date('yy/m/d', strtotime($userSubscription['finish_date'])) }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('attributes.setting.pay.request') }}</th>
                                            <td>{{ date('Y/m/d', strtotime(getDayInNextMonth($userSubscription['finish_date']))) }}</td>
                                        </tr>
                                        <tr>
                                            <th>{{ trans('attributes.setting.pay.billing_cycle') }}</th>
                                            <td>{{ trans('attributes.setting.pay.every_month') }}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <th>{{ trans('attributes.setting.pay.next_date') }}</th>
                                            <td>{{ date('yy/m/d', strtotime($userSubscription['finish_date'])) }}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                @endif

                    @if($customer)
                        <div class="card m30t">
                            <div class="card-header">
                                <h3 class="card-title">{{ trans('attributes.setting.pay.register_information') }}</h3>
                            </div>
                            <div class="card-body">
                                <p class="fs14 m5b">{{ trans('attributes.setting.pay.describe_usage_1') }}</p>
                                <p class="fs14">{{ trans('attributes.setting.pay.describe_usage_2') }}</p>
                                <div class="col-lg-12 m10t p0l p0r">
                                    <!--無料会員の場合-->
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="100" align="center">{{ trans('attributes.setting.pay.use') }}</th>
                                            <th>{{ trans('attributes.setting.pay.last_three_digits_credit_card') }}</th>
                                            <th class="w-20"></th>
                                        </tr>
                                        </thead>
                                        @foreach($customer['cards']['data'] as $card)
                                            <tbody>
                                                <tr>
                                                    <td align="center" class="text-danger">@if($card['id'] == $customer['default_card']) {{ trans('attributes.admin_manager.user.in_use') }}  @endif</td>
                                                    <td>●●●● ●●●● ●●●● {{$card['last4']}}</td>
                                                    <td>
                                                        <div class="row">

                                                            @if($card['id'] !== $customer['default_card'])
                                                                <button class="m10l btn btn-sm btn-success btn-process change-default-card" data-id="{{$card['id']}}">{{ trans('attributes.setting.pay.change_default_card') }}</button>
                                                                <button class="m10l btn btn-sm btn-danger btn-delete-card btn-process" data-id="{{$card['id']}}">{{ trans('attributes.common.delete') }}</button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        @endforeach
                                    </table>
                                </div>
                            </div>

                            @if($customer['cards']['count'] < FLAG_FIVE)
                                <div class="card-footer clearfix">
                                    <a href="{{ route(USER_SETTING_PAY_CREATE_CARD) }}" class="btn btn-primary pull-right btn-process">{{ trans('attributes.setting.pay.btn_create') }}</a>
                                </div>
                            @endif

                        </div>
                    @else
                        <div class="card m30t">
                            <div class="card-header">
                                <h3 class="card-title">{{ trans('attributes.setting.pay.register_information') }}</h3>
                            </div>

                            <div class="card-body">
                                <p class="fs14 m5b">{{ trans('attributes.setting.pay.describe_usage_1') }}</p>
                                <p class="fs14">{{ trans('attributes.setting.pay.describe_usage_2') }}</p>
                                <div class="col-lg-12 m10t p0l p0r">
                                    <!--無料会員の場合-->
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                            <td>{{ trans('attributes.setting.pay.description_not_registered') }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer clearfix">
                                <a href="{{ route(USER_SETTING_PAY_CREATE_CARD) }}" class="btn btn-primary pull-right">{{ trans('attributes.setting.pay.btn_create') }}</a>
                            </div>
                        </div>
                    @endif
                @if($userProxy->userSubscription)
                    <div class="m30t">
                        <a href="{{ route(USER_SETTING_PAYMENT_INFO) }}" class="btn btn-primary">{{ trans('attributes.setting.pay.btn_payment_info') }}</a>
                    </div>
                @endif
                <div class="card m30t">
                    <div class="card-header">
                        <h3 class="card-title">{{ trans('attributes.setting.body.content') }}</h3>
                    </div>

                    <div class="card-body">
                        <p class="fs14">{{ trans('attributes.setting.body.content_1') }}<br />{{ trans('attributes.setting.body.content_2') }}<a href="{{ route(TOP) }}#price">こちら</a>{{ trans('attributes.setting.body.content_3') }}</p>
                        <!--↓↓↓↓無料会員の場合のみ表示-->
                        <p class="fs14">{{ trans('attributes.setting.body.content_4') }}</p>
                        <!--↑↑↑↑無料会員の場合のみ表示-->
                        <div class="col-lg-12 m10t p0l p0r">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>{{ trans('attributes.setting.body.member_status') }}</th>
                                    <th>{{ trans('attributes.setting.body.monthly_usage_fee') }}</th>
                                    <th class="w-45"></th>
                                </tr>
                                </thead>
                                <tbody>
        {{--                             Row 1--}}
                                @if($userProxy->getMemberStatus() == FREE)
                                    <tr>
                                        <td>{{ trans('attributes.admin_manager.user.free') }}</td>
                                        <td>{{ trans('attributes.setting.body.free') }}</td>
                                        <td>
                                            <a href="javascript:void(0);" style="pointer-events: none;" class="btn btn-block btn-outline-danger btn-sm free btn-process">{{ trans('attributes.setting.body.current_membership_status') }}</a>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{ trans('attributes.admin_manager.user.free') }}</td>
                                        <td>{{ trans('attributes.setting.body.free') }}</td>
                                        <td>
                                            @if($userProxy->inTrial())
                                                <button class="btn btn-block btn-sm btn-secondary btn-process show-notification-trial" data-type="{{ FREE }}">{{ trans('attributes.setting.body.downgrade_to_free_membership') }}</button>
                                            @else
                                                <button class="btn btn-block btn-sm btn-secondary btn-process show-notification-downgrade" data-type="{{ FREE }}">{{ trans('attributes.setting.body.downgrade_to_free_membership') }}</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
        {{--                             Row 2--}}
                                @if($userProxy->getMemberStatus() == BASIC)
                                    <tr>
                                        <td>{{ trans('attributes.admin_manager.user.fee') }}</td>
                                        <td>
                                            @if($userProxy->isInvestor())
                                                {{ number_format(MONEY_BASIC_BY_INVESTOR) . trans('attributes.common.unit_amount') }}
                                            @elseif($userProxy->isBroker() || $userProxy->isExpert())
                                                {{ number_format(MONEY_BASIC_BY_BROKER_EXPERT) . trans('attributes.common.unit_amount') }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" style="pointer-events: none;"
                                               class="btn btn-block btn-outline-danger btn-sm paid-member">{{ trans('attributes.setting.body.current_membership_status') }}</a>
                                        </td>
                                    </tr>
                                @elseif($userProxy->getMemberStatus() == PREMIUM)
                                    <tr >
                                        <td>{{ trans('attributes.admin_manager.user.fee') }}</td>
                                        <td>
                                            @if($userProxy->isInvestor())
                                                {{ number_format(MONEY_BASIC_BY_INVESTOR) . trans('attributes.common.unit_amount') }}
                                            @elseif($userProxy->isBroker() || $userProxy->isExpert())
                                                {{ number_format(MONEY_BASIC_BY_BROKER_EXPERT) . trans('attributes.common.unit_amount') }}
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-block btn-sm btn-primary paid-member btn-process show-notification-downgrade" data-type="{{ BASIC }}">{{ trans('attributes.setting.body.downgrade_to_paid_member') }}</button>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{ trans('attributes.admin_manager.user.fee') }}</td>
                                        <td>
                                            @if($userProxy->isInvestor())
                                                {{ number_format(MONEY_BASIC_BY_INVESTOR) . trans('attributes.common.unit_amount') }}
                                            @elseif($userProxy->isBroker() || $userProxy->isExpert())
                                                {{ number_format(MONEY_BASIC_BY_BROKER_EXPERT) . trans('attributes.common.unit_amount') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($customer)
                                                @if($userProxy->inTrial())
                                                    <button class="btn btn-block btn-sm btn-primary btn-process show-notification-trial" data-type="{{ BASIC }}">{{ trans('attributes.setting.body.upgrade') }}</button>
                                                @else
                                                    <a href="{{ route(USER_SETTING_PAY_BASIC_CHECKOUT) }}"
                                                       class="btn btn-block btn-sm btn-primary btn-process">{{ trans('attributes.setting.body.upgrade') }}</a>
                                                @endif
                                            @else
                                                <button class="btn btn-block btn-sm btn-primary btn-process upgrade-from-trial" data-type="basic">{{ trans('attributes.setting.body.upgrade') }}</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
        {{--                             Row 3--}}
                                @if($userProxy->getMemberStatus() == PREMIUM)
                                    <tr>
                                        <td>{{ trans('attributes.admin_manager.user.premium') }}</td>
                                        <td>
                                            @if($userProxy->isInvestor())
                                                {{ number_format(MONEY_PREMIUM_BY_INVESTOR) . trans('attributes.common.unit_amount') }}
                                            @elseif($userProxy->isBroker() || $userProxy->isExpert())
                                                {{ number_format(MONEY_PREMIUM_BY_BROKER_EXPERT) . trans('attributes.common.unit_amount') }}
                                            @endif
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" style="pointer-events: none;"
                                               class="btn btn-block btn-outline-danger btn-sm premium">{{ trans('attributes.setting.body.current_membership_status') }}</a>
                                        </td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>{{ trans('attributes.admin_manager.user.premium') }}</td>
                                        <td>
                                            @if($userProxy->isInvestor())
                                                {{ number_format(MONEY_PREMIUM_BY_INVESTOR) . trans('attributes.common.unit_amount') }}
                                            @elseif($userProxy->isBroker() || $userProxy->isExpert())
                                                {{ number_format(MONEY_PREMIUM_BY_BROKER_EXPERT) . trans('attributes.common.unit_amount') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if($customer)
                                                @if($userProxy->inTrial())
                                                    <button class="btn btn-block btn-sm btn-primary btn-process show-notification-trial" data-type="{{ PREMIUM }}">{{ trans('attributes.setting.body.upgrade') }}</button>
                                                @else
                                                    <a href="{{ route(USER_SETTING_PAY_PREMIUM_CHECKOUT) }}" class="btn btn-block btn-sm btn-primary">{{ trans('attributes.setting.body.upgrade') }}</a>
                                                @endif
                                            @else
                                                <button class="btn btn-block btn-sm btn-primary btn-process upgrade-from-trial" data-type="premium">{{ trans('attributes.setting.body.upgrade') }}</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if($userProxy->getMemberStatus() == FREE)
                    <!--無料会員の場合のみ表示-->
                        <div class="card-footer clearfix">
                            <a href="{{ route(USER_DELETE_INDEX) }}" class="btn btn-danger pull-right btn-process">{{ trans('attributes.button.btn_delete_account') }}</a>
                        </div>
                    @endif
                </div>
            @endif

            <div class="card m30t">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">{{ trans('attributes.sub_user.title') }}</h3>
                            </div>

                            <div class="card-body p-0">
                                <div class="row m0 br10 bg-white">
                                    <div class="table-responsive">
                                        <table id="table-property" class="table table-bordered table-striped border-0 m0">
                                            <tbody>
                                            <tr class="table-head">
                                                <th class="border-left-0 border-top-0 align-middle w-15">{{ trans('attributes.admin_manager.user.user_name') }}</th>
                                                <th class="border-top-0 align-middle w-10">{{ trans('attributes.sub_user.id') }}</th>
                                                <th class="border-top-0 align-middle w-20">{{ trans('attributes.invite_user.mail_address') }}</th>
                                                <th class="text-center border-top-0 align-middle w-10" >{{ trans('attributes.admin_manager.user.use_stop') }}</th>
                                                <th class="text-center border-top-0 align-middle w-10" >{{ trans('attributes.admin_manager.user.registration_date') }}</th>
                                                <th class="text-center border-top-0 align-middle w-10" >{{ trans('attributes.admin_manager.user.update_date') }}</th>
                                                <th class="text-center border-top-0 align-middle w-10" >{{ trans('attributes.admin_manager.user.last_login') }}</th>
                                            </tr>
                                            @forelse($listSubUser as $subUser)
                                                <tr class="table">
                                                    <td class=""><a href="{{ route(USER_PROFILE_SUB_USER_EDIT, $subUser['id']) }}">{{ $subUser['profile']['person_charge_last_name'] . $subUser['profile']['person_charge_first_name'] }}</a></td>
                                                    <td class="">{{ $subUser['user_code'] }}</td>
                                                    <td class="">{{ $subUser['email'] }}</td>
                                                    <td class="text-center">{{ $subUser['status'] == OPEN ? trans('attributes.admin_manager.user.in_use') : trans('attributes.admin_manager.user.use_stop') }}</td>
                                                    <td class="text-center">{{ date('Y/m/d', strtotime($subUser['created_at'])) }}</td>
                                                    <td class="text-center">{{ date('Y/m/d', strtotime($subUser['updated_at'])) }}</td>
                                                    <td class="text-center">{{ $subUser['last_login'] ? date('Y/m/d', strtotime($subUser['last_login'])) : 'ー' }}</td>
                                                </tr>
                                            @empty
                                                <tr class="table">
                                                    <td colspan="7" class="text-center border-left-0 border-right-0">{{ trans('attributes.common.no_data') }}</td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modal.preview.check_card')
    @include('modal.preview.show_notification_trial')
    @include('modal.preview.show_notification_downgrade')
@endsection
@section('js')
    <script src="{{ asset('dist/js/pay-card.min.js') }}"></script>
@endsection
