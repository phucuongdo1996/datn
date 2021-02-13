<div>{{ $data['person_charge_last_name_to'].$data['person_charge_first_name_to'].__('attributes.invite_user.gender') }}</div>
<br>
<div>{{ trans('mail-attributes.admin_move_property.content_to') }}</div>
<div>{{ trans('mail-attributes.admin_move_property.content_to_2').$data['person_charge_last_name_from'].$data['person_charge_first_name_from'] }}</div>
<div>{{ trans('mail-attributes.admin_move_property.content_to_3') }}</div>
@foreach($data['house_name'] as $item)
    <div>{{ $item }}</div>
@endforeach
<br>
<div>{{ __('attributes.invite_user.content_10') }}</div>
<div>{{ __('attributes.invite_user.content_11') }}</div>
<div>{{ __('attributes.invite_user.content_12') }}</div>
