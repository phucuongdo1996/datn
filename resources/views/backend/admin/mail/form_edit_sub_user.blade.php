<div>{{ $mainUser['person_charge_last_name'].$mainUser['person_charge_first_name'].__('attributes.invite_user.gender') }}</div>
<br>
<div>{{ __('mail-attributes.admin_edit_sub_user.line_1') }}</div>
<div>{{ __('mail-attributes.admin_add_sub_user.line_2').$subUser['person_charge_last_name'].$subUser['person_charge_first_name'] }}</div>
<div>{{ __('mail-attributes.admin_add_sub_user.line_3').$subUser['email'] }}</div>
<br>
<div>{{ __('attributes.invite_user.content_10') }}</div>
<div>{{ __('attributes.invite_user.content_11') }}</div>
<div>{{ __('attributes.invite_user.content_12') }}</div>
