<div> {{ isset($data->user) ? optional($data->user->profile)->person_charge_last_name . optional($data->user->profile)->person_charge_first_name : '' }}{{ trans('messages.email.mr') }}</div>
<br>
<div>{{ trans('mail-attributes.admin_delete_topic.title') }}</div>
<div>{{ trans('mail-attributes.admin_edit_topic.line_2') }}{{ dateTimeFormat($data['created_at']) }}</div>
<div>{{ trans('mail-attributes.admin_edit_topic.line_3') }}{{ $data['title'] }}</div>
<br>
<div>{{ trans('messages.email.delete_photo.reason_for_stopping') }}</div>
<div>@if(!empty($data->reason_delete))
        {{ $data->reason_delete }}
    @else
        {{ $data->title . ' ' . trans('messages.delete_topic_not_reason') }}
    @endif
</div>
<br>
<div>{{ trans('messages.email.message1') }}</div>
<div>{{ trans('messages.email.message2') }}</div>
<div>{{ trans('messages.email.message3') }}</div>

