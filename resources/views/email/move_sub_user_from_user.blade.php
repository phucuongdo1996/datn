<div>{{ $data['person_charge_last_name_from'].$data['person_charge_first_name_from'].__('attributes.invite_user.gender') }}</div>
<br>
<div>{{ trans('mail-attributes.admin_move_sub_user.content_from') }}</div>
<div>{{ trans('mail-attributes.admin_move_sub_user.content_from_2').$data['person_charge_last_name_to'].$data['person_charge_first_name_to'] }}</div>
<div>{{ trans('mail-attributes.admin_move_sub_user.content_from_3') }}</div>
@foreach($data['sub_user_data'] as $item)
    <div>{{ $item['profile']['person_charge_last_name'] }}{{ $item['profile']['person_charge_first_name'] }} &nbsp; {{ $item['email'] }}</div>
@endforeach
<br>
<div>{{ __('attributes.invite_user.content_10') }}</div>
<div>{{ __('attributes.invite_user.content_11') }}</div>
<div>{{ __('attributes.invite_user.content_12') }}</div>
