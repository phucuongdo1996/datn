<div> {{ isset($data->user) ? optional($data->user->profile)->person_charge_last_name . optional($data->user->profile)->person_charge_first_name : '' }}{{ trans('messages.email.mr') }}</div>
<br>
<div>{{ trans('mail-attributes.admin_delete_photo.line_1') }}</div>
<div>{{ trans('mail-attributes.admin_edit_topic.line_2') }}{{ dateTimeFormat($data->created_at) }}</div>
<div>
    {{ trans('mail-attributes.admin_delete_photo.line_3') }}
    {{ isset($data['caption']) ? $data['caption'] : trans('mail-attributes.admin_delete_photo.your_photo_archive') }}
</div>
<br>
<div>{{ trans('messages.email.delete_photo.reason_for_stopping') }}</div>
<div>{{ isset($data->reason_delete) ? $data->reason_delete : (isset($data->caption) ? $data->caption : trans('attributes.my_page.photo_archive')) . trans('attributes.my_page.photo_delete_success') }} </div>
<br>
<div>{{ trans('messages.email.message1') }}</div>
<div>{{ trans('messages.email.message2') }}</div>
<div>{{ trans('messages.email.message3') }}</div>
