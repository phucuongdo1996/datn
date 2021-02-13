<div>{{ isset($user['profile']) ? $user['profile']['person_charge_last_name'] . $user['profile']['person_charge_first_name'] : $user['email'] }}{{ trans('attributes.invite_user.gender') }}</div>
<br>
<div>{{ trans('mail-attributes.unblock_user.line_1') }}</div>
<div>{{ trans('mail-attributes.admin_add_sub_user.line_3') }}{{ $user['email'] }}</div>
<div>{{ trans('mail-attributes.unblock_user.line_2') }}{{ ROLES_JA[$user['role']] }}</div>
<div>{{ trans('mail-attributes.unblock_user.line_3') }}{{ MEMBER_STATUS[$user['member_status']] }}</div>
<br>
<div>{{ trans('mail-attributes.unblock_user.line_4') }}</div>
<br>
<div>{{ trans('mail-attributes.body.line7') }}</div>
<div>{{ trans('mail-attributes.body.line8') }}</div>
<div>{{ trans('mail-attributes.change_member_status.last_line') }}</div>
