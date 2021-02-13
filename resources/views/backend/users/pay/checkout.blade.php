@extends('layout.home.master')
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-bank container-wrapper-pay">
        <div id="main-info-assessment">
            <div class="row row-header mb-5">
                <div class="row m0">
                    <div class="col-12 text-center text-md-left p0">
                        <h3 class="m0">{{ trans('attributes.setting.pay.title') }}</h3>
                    </div>
                </div>
            </div>

            @include('partials.flash_messages')
            <!--profile edit-->
            <div class="row">
                <div class="col-12">

                    <div class="card">

                        <div class="card-header">
                            <h3 class="card-title">{{ trans('attributes.setting.pay.selected_plan') }}</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>{{ trans('attributes.setting.pay.plan_name') }}</th>
                                    <th>{{ trans('attributes.setting.pay.unit_price') }}</th>
                                    <th>{{ trans('attributes.setting.pay.quantity') }}</th>
                                    <th>{{ trans('attributes.setting.pay.fee') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ trans('attributes.setting.pay.basic') }}</td>
                                    <td>1</td>
                                    <td>{{ trans('attributes.common.unit_yen') . number_format($amount['amounts_by_member']) }}（{{ trans('attributes.top.body.tax') }}）</td>
                                    <td>{{ trans('attributes.common.unit_yen') . number_format($amount['amounts_by_member']) }}（{{ trans('attributes.top.body.tax') }}）</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.setting.pay.sub_user') }}</td>
                                    <td>{{ $amount['total_sub'] }}</td>
                                    <td>{{ trans('attributes.common.unit_yen') . number_format($amount['amounts_by_sub_user']) }}（{{ trans('attributes.top.body.tax') }}）</td>
                                    <td>{{ trans('attributes.common.unit_yen') . number_format($amount['total_sub'] *  $amount['amounts_by_sub_user']) }}（{{ trans('attributes.top.body.tax') }}）</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.setting.pay.discount_rate') }}</td>
                                    <td class="text-danger">{{ $userSubscription ? $userSubscription['discount'] . __('attributes.common.percent') : '0.00%' }}</td>
                                    <td class="text-danger"></td>
                                    <td class="text-danger">{{ trans('attributes.common.unit_yen') . number_format($amount['discount_value']) }}（{{ trans('attributes.top.body.tax') }}）</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('attributes.info_billing.sale_tax') }}</td>
                                    <td>{{ number_format(TAX_PERSONAL * FLAG_ONE_HUNDRED, FLAG_TWO) . trans('attributes.common.percent') }}</td>
                                    <td></td>
                                    <td>{{ trans('attributes.common.unit_yen') . number_format($amount['tax']) }}（{{ trans('attributes.top.body.tax') }}）</td>
                                </tr>
                                <tr>
                                    <td colspan="3" style="background-color:#666;color:#fff;" align="right">{{ trans('attributes.setting.pay.total_charges') }}</td>
                                    <td>{{ trans('attributes.common.unit_yen') . number_format($amount['total_amount']) }}（{{ trans('attributes.top.body.tax') }}）</td>
                                </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered mt-4">
                                <tbody>
                                @if($userProxy->canTrial())
                                    @php($trialEnd = date('yy/m/d', time() + TRIAL_DAY_BY_SECONDS))
                                    <tr>
                                        <th>{{ trans('attributes.setting.pay.free_period') }}</th>
                                        <td>
                                            <p>{{ date('yy/m/d', time()) . '〜' . $trialEnd }}</p>
                                            <p class="text-danger small mb-0">{{ trans('attributes.setting.pay.downgrade_or_upgrade') }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('attributes.setting.pay.billing_start_date') }}</th>
                                        <td>{{ $trialEnd }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('attributes.setting.pay.request') }}</th>
                                        <td>{{ date('Y/m/d', strtotime(getDayInNextMonth($trialEnd))) }}</td>
                                    </tr>
                                @elseif($userProxy['member_status'] == TRIALS)
                                    <tr>
                                        <th>{{ trans('attributes.setting.pay.free_period') }}</th>
                                        <td>
                                            <p>{{ date('yy/m/d', strtotime($userSubscription['start_date'])) . '〜' . date('yy/m/d', strtotime($userSubscription['finish_date'])) }}</p>
                                            <p class="text-danger small mb-0">{{ trans('attributes.setting.pay.downgrade_or_upgrade') }}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('attributes.setting.pay.billing_start_date') }}</th>
                                        <td>{{ date('yy/m/d', strtotime($userSubscription['finish_date'])) }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('attributes.setting.pay.request') }}</th>
                                        <td>{{ date('yy/m/d', strtotime($userSubscription['finish_date']) + THIRTY_DAY_BY_SECONDS) }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <th>{{ trans('attributes.setting.pay.billing_start_date') }}</th>
                                        <td>{{ date('yy/m/d', strtotime($userSubscription['start_date'])) }}</td>
                                    </tr>
                                    <tr>
                                        <th>{{ trans('attributes.setting.pay.request') }}</th>
                                        <td>{{ date('yy/m/d', strtotime($userSubscription['finish_date'])) }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <th>{{ trans('attributes.setting.pay.billing_cycle') }}</th>
                                    <td>{{ trans('attributes.setting.pay.every_month') }}</td>
                                </tr>
                                </tbody>
                            </table>


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <form id="checkout-member-status" action="{{ request()->route()->getName() == USER_SETTING_PAY_BASIC_CHECKOUT ? route(USER_SETTING_PAY_BASIC_UPGRADE) : route(USER_SETTING_PAY_PREMIUM_UPGRADE) }}" method="POST">
                        <div class="card">
                            @csrf
                            <div class="card-header">
                                <h3 class="card-title">{{ trans('attributes.setting.pay.payment_information') }}</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>

                            <div class="card-body">

                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{ trans('attributes.setting.pay.please_select_card_use') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($customer['cards']['data'] as $card)
                                        <tr>
                                            <td>
                                                <div class="form-group mb-0">
                                                    <div class="form-check">
                                                        <input class="form-check-input checkout-card" type="radio" name="use_card" value="{{$card['id']}}"
                                                        @if($card['id'] == $customer['default_card']) checked  @endif>
                                                        <label class="form-check-label">●●●● ●●●● ●●●● {{ $card['last4'] }}</label>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary float-right btn-checkout-card btn-process">{{ trans('attributes.setting.pay.btn_checkout') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
