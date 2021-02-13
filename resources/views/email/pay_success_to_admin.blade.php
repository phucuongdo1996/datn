<div>{{ config('mail.mail_admin') . trans('messages.pay.admin_notification') }}</div>
<br>
<div>
    <div>{{ trans('messages.pay.plan') }}</div>
    <div>{{MEMBER_STATUS_PAY[$dataUser['member_status']]}}</div>
    <div>{{ trans('attributes.info_billing.monthly') . ' ' . trans('attributes.common.unit_yen') . number_format($dataAmount['amounts_by_member']) }} ({{ trans('attributes.top.body.tax') }})</div>
</div>
<br>
<div>
    <div>{{ trans('messages.pay.sub_user') }}</div>
    <div>{{ trans('messages.pay.breakdown') . ' ' .$dataAmount['total_sub'] . trans('messages.pay.number_sub_user')  . trans('attributes.common.unit_yen') . number_format($dataAmount['amounts_by_sub_user'] ) }}</div>
    <div>{{ trans('attributes.info_billing.monthly') . ' ' . trans('attributes.common.unit_yen') . number_format($dataAmount['total_sub'] * $dataAmount['amounts_by_sub_user']) }} ({{ trans('attributes.top.body.tax') }})</div>
</div>
<br>
<div>
    <div>{{ trans('messages.pay.total_billed_amount') }}</div>
    <div>{{ trans('attributes.info_billing.monthly') . ' ' . trans('attributes.common.unit_yen') . number_format(round((FLAG_ONE_HUNDRED - $dataUser['user_subscription']['discount']) * ($dataAmount['amounts_by_member'] + $dataAmount['total_sub'] * $dataAmount['amounts_by_sub_user']) / FLAG_ONE_HUNDRED))}} ({{ trans('attributes.top.body.tax') }})</div>
</div>
<br>
@php
    $date = new DateTime();
    $dateStart = $date->format('Y/m/d');
    $date->add(new DateInterval('P30D'));
    $dateFinish = $date->format('Y/m/d');
@endphp
<div>
    <div>{{ trans('messages.pay.billing_date') }}</div>
    <div>{{ $dateStart }}</div>
</div>
<br>
<div>
    <div>{{ trans('messages.pay.next_billing_date') }}</div>
    <div>{{ $dateFinish }}</div>
</div>
