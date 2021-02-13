@extends('layout.home.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/preview/payment_receipt.css') }}">
@endsection
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-bank container-wrapper-pay">
        <div class="row card p30t p20r p60b p20l m-0">
            <div class="col-12 p0">
               <div class="row m-0 row-header">
                   <div class="col-6 offset-3 text-center p0">
                           <h3 class="m0">{{ trans('attributes.info_billing.invoice') }}</h3>
                           <p class="m0 fs16 m10t">{{ trans('attributes.info_billing.payment_date') }}：{{ convertDateToString($data['captured_at']) }}</p>
                   </div>
                   <div class="col-3 p0 align-self-center text-right">
                       <button class="btn custom-btn-success d-none d-sm-inline-block fs15 fs13-sp btn-preview-payment">
                           {{ trans('attributes.balance.header.btn_preview') }}
                       </button>
                   </div>
               </div>

                <div class="row m0 m30t">
                    <div class="row col-12 col-lg-3 border-bottom fs16 h50">
                        <div class="col-2 offset-10 centered p0r text-flex-end"><span>{{ trans('attributes.invite_user.gender') }}</span></div>
                    </div>

                    <div class="col-12 col-lg-4 offset-lg-5">
                        <div class="logo-company text-left"><img class="mw-100 h50" src="{{ asset('images/login/logo.svg') }}" /></div>
                        <div class="m15t">
                            <span>{!! trans('attributes.info_billing.address_company') !!}</span>
                        </div>
                    </div>
                </div>

                <div class="row m0">
                    <div class="col-12 col-lg-5 p0">
                        <table class="table table-bordered table-payment m0 text-center">
                            <tr>
                                <td class="first-td">{{ trans('attributes.info_billing.billing_total') }}</td>
                                <td class="w-60">{{ trans('attributes.common.unit_yen') . ' ' . number_format($data['total_amount']) }}</td>
                            </tr>
                            <tr>
                                <td class="first-td">{{ trans('attributes.repair_history.payment_date') }}</td>
                                <td class="w-60">{{ convertDateToString($data['captured_at']) . trans('attributes.info_billing.paid_to') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row m0 m30t">
                    <span><span class="fw-bold">{{ trans('attributes.info_billing.invoice_number') }}：</span>{{ $data['pay_code'] }}</span>
                </div>

                <div class="row m0 m10t">
                    <table class="table table-bordered m0">
                            <tr>
                                <th class="w-20">{{ trans('attributes.setting.pay.plan_name') }}</th>
                                <th class="w-20">{{ trans('attributes.info_billing.unit') }}</th>
                                <th class="w-30">{{ trans('attributes.setting.pay.quantity') }}</th>
                                <th class="w-20">{{ trans('attributes.setting.pay.fee') }}</th>
                            </tr>
                            <tr>
                                <td>{{ $data['member_status'] == FLAG_TWO ? PLAN_TEXT_NAME[$data['member_status']] . trans('attributes.info_billing.plan') : PLAN_TEXT_NAME[$data['member_status']] }}</td>
                                <td>1</td>
                                <td>{{ trans('attributes.common.unit_yen') . ' ' . number_format($data['amounts_by_member']) }}</td>
                                <td>{{ trans('attributes.common.unit_yen') . ' ' . number_format($data['amounts_by_member']) }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('attributes.setting.pay.sub_user') }}</td>
                                <td>{{ number_format($data['total_sub']) }}</td>
                                <td>{{ trans('attributes.common.unit_yen') . ' ' . number_format($data['amounts_by_sub_user']) }}</td>
                                <td>{{ trans('attributes.common.unit_yen') . ' ' . number_format(round($data['total_sub'] * $data['amounts_by_sub_user'])) }}</td>
                            </tr>
                            <tr>
                                <td>{{ trans('attributes.setting.pay.discount_rate') }}</td>
                                <td class="text-danger">{{ number_format($data['discount'], FLAG_TWO) . trans('attributes.common.percent') }}</td>
                                <td></td>
                                <td class="text-danger">{{ trans('attributes.common.unit_yen') . ' ' . number_format($data['discount_value']) }}</td>
                            </tr>
                            <tr>
                                <td class="border-0"></td>
                                <td class="border-0"></td>
                                <td class="border-0 text-right">{{ trans('attributes.info_billing.sub_total') }}</td>
                                <td class="border-0 text-left">{{ trans('attributes.common.unit_yen') . ' ' . number_format(round($data['amount_basic'] - $data['discount_value'])) }}</td>
                            </tr>
                            <tr>
                                <td class="border-0"></td>
                                <td class="border-0"></td>
                                <td class="border-0 text-right">{{ trans('attributes.info_billing.sale_tax') }}</td>
                                <td class="border-0 text-left">{{ trans('attributes.common.unit_yen') . ' ' . number_format($data['tax']) }}</td>
                            </tr>
                            <tr>
                                <td class="border-0"></td>
                                <td class="border-0"></td>
                                <td class="border-0 text-right">{{ trans('attributes.setting.pay.total_charges') }}</td>
                                <td class="border-0 text-left">{{ trans('attributes.common.unit_yen') . ' ' . number_format(round($data['total_amount'])) }}</td>
                            </tr>
                        </table>
                </div>
            </div>
        </div>
    </div>
    @include('backend.preview_print.payment_receipt_print')
@endsection
@section('js')
    <script src="{{ asset('dist/js/pay-detail.min.js') }}"></script>
@endsection
