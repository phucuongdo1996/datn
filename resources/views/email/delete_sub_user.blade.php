<body>
<div> {{ isset($mainUser['profile']) ? $mainUser['profile']['person_charge_last_name'] . $mainUser['profile']['person_charge_first_name'] : $mainUser['email'] }}{{ trans('messages.email.mr') }}</div>
<br>
<div>{{ trans('messages.email.sub_user.title') }}</div>
<div>{{ trans('messages.email.sub_user.name') }}：{{ isset($subUser['profile']) ? $subUser['profile']['person_charge_last_name'] . $subUser['profile']['person_charge_first_name'] : $subUser['email'] }}</div>
<div>{{ trans('messages.email.sub_user.email') }}：{{ $subUser['email'] }}</div>
<br>
<div>{{ trans('messages.email.delete_photo.reason_for_stopping') }}</div>
<div>{{ $subUser['reason_delete'] }}</div>
<br>
<div>{{ trans('messages.email.message1') }}</div>
<div>{{ trans('messages.email.message2') }}</div>
<div>{{ trans('messages.email.message3') }}</div>

