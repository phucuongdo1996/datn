<div>{{ $data['person_charge_last_name'].$data['person_charge_first_name'].__('attributes.invite_user.gender') }}{{ trans('mail-attributes.support.title_4') }}</div>
<div>{{ trans('mail-attributes.support.title_3') }}</div>
<br>
<div>{{ trans('mail-attributes.support.content_of_inquiry') }}</div>
<div>{{ $data['content_of_inquiry'] }}</div>
<br>
<div>{{ trans('mail-attributes.support.content') }}</div>
<div>{{ $data['content'] }}</div>
<br>
<div>{{ trans('mail-attributes.support.member_id') }}</div>
<div>{{ $data['user_code'] }}</div>
<br>
<div>{{ trans('mail-attributes.support.full_name') }}</div>
<div>{{ $data['person_charge_last_name'] . $data['person_charge_first_name'] }}</div>
<br>
<div>{{ trans('mail-attributes.support.furigana') }}</div>
<div>{{ $data['person_charge_last_name_kana'] . $data['person_charge_first_name_kana'] }}</div>
<br>
<div>{{ trans('attributes.tax.street_address') }}</div>
<div>{{ $data['address_city'] . ' ' . $data['address_district'] }}</div>
<br>
<div>{{ trans('mail-attributes.support.mail_address') }}</div>
<div>{{ $data['email'] }}</div>
<br>
@if(isset($data['specialties']))
    <div>{{ trans('attributes.profile.body.label.specialty') }}</div>
    @foreach($data['specialties'] as $value)
        <div>{{ $value }}</div>
    @endforeach
    <br>
    <div>{{ trans('attributes.support.web_url') }}</div>
    <div>{{ $data['website_business_name'] }}</div>
    <br>
@endif
