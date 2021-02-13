<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div> {{ isset($data['profile']) ? $data['profile']['person_charge_last_name'] . $data['profile']['person_charge_first_name'] : $data['email'] }}{{ trans('messages.email.mr') }}</div>
    <br>
    <div>{{ trans('messages.email.administrator_has_suspended_your_account') }}</div>
    <div>{{ trans('messages.email.email_user') }}：{{ $data['email'] }}</div>
    <div>{{ trans('messages.email.role') }}：{{ ROLES_JA[$data['role']] }}</div>
    <div>{{ trans('messages.email.member_status') }}：{{ MEMBER_STATUS[$data['member_status']] }}</div>
    <br>
    <div>{{ trans('messages.email.reason_for_stopping') }}</div>
    <div>{{ $data['reason_delete'] }}</div>
    <br>
    <div>{{ trans('messages.email.message1') }}</div>
    <div>{{ trans('messages.email.message2') }}</div>
    <div>{{ trans('messages.email.message3') }}</div>
</body>
</html>
