<div>{{ $data['profile']['person_charge_last_name'].$data['profile']['person_charge_first_name'].__('attributes.invite_user.gender') }}</div>
<br>
<div>{{ trans('mail-attributes.admin_delete_photo.line_2') }}</div>
<div>{{ trans('mail-attributes.admin_edit_topic.line_2') }}{{ dateTimeFormat($data['created_at_photo']) }}</div>
<div>
    {{ trans('mail-attributes.admin_delete_photo.line_3') }}
    {{ isset($data['caption']) ? $data['caption'] : trans('mail-attributes.admin_delete_photo.your_photo_archive') }}
</div>
<br>
<div>{{ __('mail-attributes.admin_edit_photo.line_2') }}</div>
<div>{{ isset($data['reason']) ? $data['reason'] : ($data['caption'] ?? __('mail-attributes.admin_edit_photo.line_1_1')).__('mail-attributes.admin_edit_photo.line_3') }}</div>
<br>
<div>{{ __('attributes.invite_user.content_10') }}</div>
<div>{{ __('attributes.invite_user.content_11') }}</div>
<div>{{ __('attributes.invite_user.content_12') }}</div>
