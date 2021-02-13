<div>{{ $dataUser['profile']['person_charge_last_name'].$dataUser['profile']['person_charge_first_name'].__('attributes.invite_user.gender') }}</div>
<br>
<div>
    <span>{{ trans('messages.pay.notification1') }}</span>
    <br>
    <span>{{ date("Y/m/d") . trans('messages.pay.error.notification2') }}</span>
    <br>
    <span>{{ trans('messages.pay.error.notification3') }}</span>
</div>
<br>
<div>
    <span>{{ trans('messages.pay.error.notification4') }}</span>
    <br>
    <span>{{ trans('messages.pay.error.notification5') }}</span>
</div>
<br>
<div>
    <div>{{ trans('messages.pay.plan') }}</div>
    <div>{{MEMBER_STATUS_PAY[$dataUser['member_status']]}}</div>
    <div>{{ trans('attributes.info_billing.monthly') . ' ' . trans('attributes.common.unit_yen') . number_format($dataAmount['amounts_by_member']) }} ({{ trans('attributes.top.body.tax') }})</div>
</div>
<br>
<div>
    <div>{{ trans('messages.pay.sub_user') }}</div>
    <div> {{ trans('messages.pay.breakdown') . ' ' .$dataAmount['total_sub'] . trans('messages.pay.number_sub_user') . trans('attributes.common.unit_yen') . number_format($dataAmount['amounts_by_sub_user'] ) }}</div>
    <div> {{ trans('attributes.info_billing.monthly') . ' ' . trans('attributes.common.unit_yen') . number_format($dataAmount['total_sub'] * $dataAmount['amounts_by_sub_user']) }} ({{ trans('attributes.top.body.tax') }})</div>
</div>
<br>
<div>
    <div>{{ trans('messages.pay.total_billed_amount') }}</div>
    <div>{{ trans('attributes.info_billing.monthly') . ' ' . trans('attributes.common.unit_yen') . number_format(round((FLAG_ONE_HUNDRED - $dataUser['user_subscription']['discount']) * ($dataAmount['amounts_by_member'] + $dataAmount['total_sub'] * $dataAmount['amounts_by_sub_user']) / FLAG_ONE_HUNDRED))}} ({{ trans('attributes.top.body.tax') }})</div>
</div>
<br>
<div>
    <div>{{ trans('messages.pay.billing_date') }}</div>
    <div>{{ date("Y/m/d") }}</div>
</div>
<br>
<div>{{ __('attributes.invite_user.content_10') }}</div>
<div>{{ __('attributes.invite_user.content_11') }}</div>
<div>{{ __('attributes.invite_user.content_12') }}</div>
