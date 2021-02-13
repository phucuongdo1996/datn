<div>{{ $data['person_charge_last_name'].$data['person_charge_first_name'].__('attributes.invite_user.gender') }}</div>
<br>
<div>{{ trans('mail-attributes.admin_edit_topic.line_1') }}</div>
<div>{{ trans('mail-attributes.admin_edit_topic.line_2') }}{{ dateTimeFormat($data['created_at']) }}</div>
<div>{{ trans('mail-attributes.admin_edit_topic.line_3') }}{{ $data['title'] }}</div>
<br>
<div>{{ __('mail-attributes.admin_edit_photo.line_2') }}</div>
<div>{{ isset($data['reason_update']) ? $data['reason_update'] : $data['title'].__('mail-attributes.admin_edit_photo.line_3') }}</div>
<br>
<div>{{ __('attributes.invite_user.content_10') }}</div>
<div>{{ __('attributes.invite_user.content_11') }}</div>
<div>{{ __('attributes.invite_user.content_12') }}</div>
