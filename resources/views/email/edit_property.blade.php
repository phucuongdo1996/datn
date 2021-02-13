<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div> {{ isset($dataProperty['user']) && isset($dataProperty['user']['profile']) ? $dataProperty['user']['profile']['person_charge_last_name'] . $dataProperty['user']['profile']['person_charge_first_name'] : '' }}{{ trans('messages.email.mr') }}</div>
    <br>
    <div>{{ trans('messages.email.delete_photo.admin') . $propertyOld['house_name'] . trans('messages.email.edit_property.deleted') }} </div>
    <br>
    <div>{{ trans('messages.email.edit_property.reason_for_stopping') }}</div>
    <div id="parent-content">
    @foreach($dataDirty as $key => $value)
        @php($flag = isset(PROPERTY_LABEL_TEXT[$key]) && ($value != $propertyOld[$key]))
        @switch($key)
            @case('detail_real_estate_type_id')
                <div>{{ $flag ? PROPERTY_LABEL_TEXT['detail_real_estate_type_id'] . ': ' . (isset($dataProperty['detail_real_estate_type']['name']) ? $dataProperty['detail_real_estate_type']['name'] : 'ー') : '' }}</div>
                @break
            @case('real_estate_type_id')
                <div>{{ $flag ? PROPERTY_LABEL_TEXT['real_estate_type_id'] . ': ' . (isset($dataProperty['real_estate_type']['name']) ? $dataProperty['real_estate_type']['name'] : 'ー') : '' }}</div>
                @break
            @case('building_right_id')
                <div>{{ $flag ? PROPERTY_LABEL_TEXT[$key] . ': ' . (isset($dataProperty['building_right']['name']) ? $dataProperty['building_right']['name'] : 'ー') : '' }}</div>
                @break
            @case('avatar')
                <div>{{ $flag ? PROPERTY_LABEL_TEXT[$key] . ': ' . trans('messages.email.edit_property.avatar') : '' }}</div>
                @break
            @case('land_right_id')
                <div>{{ $flag ? PROPERTY_LABEL_TEXT[$key] . ': ' . (isset($dataProperty['land_right']['name']) ? $dataProperty['land_right']['name'] : 'ー') : '' }}</div>
                @break
            @case('house_material_id')
                <div>{{ $flag ? PROPERTY_LABEL_TEXT[$key] . ': ' . (isset($dataProperty['house_material']['name']) ? $dataProperty['house_material']['name'] : 'ー') : '' }}</div>
                @break
            @case('house_roof_type_id')
                <div>{{ $flag ? PROPERTY_LABEL_TEXT[$key] . ': ' . (isset($dataProperty['house_roof_type']['name']) ? $dataProperty['house_roof_type']['name'] : 'ー') : '' }}</div>
                @break
            @case('type_rental_id')
                <div>{{ $flag ? PROPERTY_LABEL_TEXT[$key] . ': ' . (isset($dataProperty['type_rental']['name']) ? $dataProperty['type_rental']['name'] : 'ー') : '' }}</div>
                @break
            @case('date_year_registration_revenue')
                <div>{{ $flag ? PROPERTY_LABEL_TEXT[$key] . ': ' . $dataProperty['date_year_registration_revenue'] .trans('attributes.common.year') : '' }}</div>
                @break
            @case('date_month_registration_revenue')
                <div>{{ $flag ? PROPERTY_LABEL_TEXT[$key] . ': ' . MONTH[$dataProperty['date_month_registration_revenue']] : '' }}</div>
                @break
            @case('contract_loan_period')
                @php($year = range(1, 35))
                <div>{{ $flag ? PROPERTY_LABEL_TEXT[$key] . ': ' . $year[$dataProperty['contract_loan_period'] - FLAG_ONE] . trans('attributes.common.year') : '' }}</div>
                @break
            @case('status')
                <div>{{ $flag ? PROPERTY_LABEL_TEXT[$key] . ': ' . STATUS_HOUSE[$dataProperty['status']] : '' }}</div>
                @break
            @case('main_application')
                <div>{{ $flag ? PROPERTY_LABEL_TEXT[$key] . ': ' . (empty($dataProperty['main_application']) ? 'ー' : MAIN_APPLICATION[$dataProperty['main_application']]) : '' }}</div>
                @break
            @case('loan_bank_name')
                <div>{{ PROPERTY_LABEL_TEXT['loan_bank_name'] }}: <span id="loan_bank_name">{{ isset($dataProperty['loan_bank_name']) ? $dataDirty['bank_name'] : 'ー' }}</span></div>
                @break
            @case('bank_branch_name')
                <div>{{ PROPERTY_LABEL_TEXT['bank_branch_name'] }}: <span id="bank_branch_name">{{ isset($dataProperty['bank_branch_name']) ? $dataDirty['loan_bank_branch_name'] : 'ー' }}</span></div>
                @break
            @case('total_tenants')
                <div>{{ $flag ? PROPERTY_LABEL_TEXT[$key] . ': ' . number_format($dataProperty[$key]) : '0'}}</div>
                @break
            @default
                @if(in_array($key, PROPERTY_PERCENT))
                    <div>{{ $flag ? PROPERTY_LABEL_TEXT[$key] . ': ' . number_format($dataProperty[$key], 2, ".", ",") . '%' : '' }}</div>
                @elseif(in_array($key, PROPERTY_SQUARE_METER))
                    <div>{{ $flag ? PROPERTY_LABEL_TEXT[$key] . ': ' . number_format($dataProperty[$key], 2, ".", ",") . trans('attributes.common.m2') : '' }}</div>
                @elseif(in_array($key, NUMBER_FORMAT_PROPERTY))
                    <div>{{ $flag ? PROPERTY_LABEL_TEXT[$key] . ': ' . number_format($dataProperty[$key]) . trans('attributes.common.yen') : '' }}</div>
                @elseif(in_array($key, PROPERTY_DATE))
                    <div>{{ $flag ? PROPERTY_LABEL_TEXT[$key] . ': ' . ($dataProperty[$key] ? date("Y/m/d", strtotime($dataProperty[$key])) : 'ー') : '' }}</div>
                @else
                    <div>{{ $flag ? PROPERTY_LABEL_TEXT[$key] . ': ' . (empty($dataProperty[$key]) ?  'ー' : $dataProperty[$key]) : '' }}</div>
                @endif
        @endswitch
    @endforeach
    </div>
    <br>
    <div>{{ trans('messages.email.message1') }}</div>
    <div>{{ trans('messages.email.message2') }}</div>
    <div>{{ trans('messages.email.message3') }}</div>
</body>
</html>
