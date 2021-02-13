@extends('layout.home.master')
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-bank container-wrapper-pay">
        <div class="row row-header mb-5">
            <div class="col-12 col-md-7 text-center text-md-left p0">
                <h3 class="m0">{{ trans('attributes.info_billing.title') }}</h3>
            </div>
            <div class="col-12 col-md-5 text-right text-md-right">
                <a href="{{ route(USER_SETTING_INDEX) }}" class="btn custom-btn-default w60 d-none d-sm-inline-block fs15 m5t">{{ trans('attributes.article_photo.btn_back') }}</a>
            </div>
        </div>

        <div class="row m30t card p20 m-0">
            <div class="col-lg-12 p0">
                <p class="fs18 color-2c3348">{{ trans('attributes.info_billing.plan') }}</p>
                <p>{{ $userProxy->getMemberStatus() == FLAG_TWO ? PLAN_TEXT_NAME[$userProxy->getMemberStatus()] . trans('attributes.info_billing.plan') : PLAN_TEXT_NAME[$userProxy->getMemberStatus()] }}</p>
                <p>{{ trans('attributes.info_billing.monthly') . ' ' . trans('attributes.common.unit_yen') . ' ' . number_format($amount['total_amount']) }}（{{ trans('attributes.info_billing.tax_included') }}）</p>
            </div>
            <div class="col-lg-12 p0 m60t">
                <p class="fs18 color-2c3348">{{ trans('attributes.info_billing.next_date') }}</p>
                <p>{{ convertDateToString($userProxy->userSubscription->finish_date) }}</p>
            </div>
        </div>

        <div class="row m30t bg-white block-table-billing m-0">
            <table class="table table-bordered table-billing m0">
                <tr>
                    <th class="w-20">{{ trans('attributes.info_billing.billing_date') }}</th>
                    <th class="w-20">{{ trans('attributes.info_billing.content') }}</th>
                    <th class="w-30">{{ trans('attributes.borrowing.table.agreement_period') }}</th>
                    <th class="w-20">{{ trans('attributes.info_billing.billing_amount') }}</th>
                    <th class="w-10"></th>
                </tr>
                @forelse($history as $item)
                    <tr>
                        <td>{{ convertDateToString($item['captured_at']) }}</td>
                        <td>{{ $item['member_status'] == FLAG_TWO ? PLAN_TEXT_NAME[$item['member_status']] . trans('attributes.info_billing.plan') : PLAN_TEXT_NAME[$item['member_status']] }}</td>
                        <td>{{ convertDateToString($item['start_date']) }} 〜 {{ convertDateToString($item['finish_date'], $userProxy->userSubscription->finish_date) }}</td>
                        <td>{{ trans('attributes.common.unit_yen') .' '. number_format($item['total_amount']) }}</td>
                        <td><a href="{{ route(USER_SETTING_PAYMENT_INFO_DETAIL, $item['id']) }}"><u>{{ trans('attributes.info_billing.invoice') }}</u></a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">{{ trans('attributes.common.no_data') }}</td>
                    </tr>
                @endforelse
            </table>
        </div>

        <p class="m30t">{{ trans('attributes.info_billing.last_text') }}</p>
    </div>
@endsection
