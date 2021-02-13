@extends('modal.preview.common_preview')
@section('title', trans('attributes.rent_roll_list.title').$property->house_name)
@section('content_preview')
    <div id="pre-print-rent-roll" class="background-print">
        <div class="content-preview">
            <div class="preview-print m0t">
                <div id="page-12" class="page-12 print-bg m0">

                    <div class="row m-0 m10b">
                        <div class="col-2 m10r p0">
                            <table class="table table-bordered table-preview table-preview-analysis m-0">
                                <tbody>
                                <tr>
                                    <td class="w60 text-center fw-bold">{{ trans('attributes.rent_roll.period') }}</td>
                                    <td class="text-center date-time-search"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        @if ($currentUser->role != INVESTOR)
                            <div class="col-3 p0">
                                <table class="table table-bordered table-preview table-preview-analysis m-0">
                                    <tbody>
                                    <tr>
                                        <td class="w135 text-center fw-bold">{{ trans('attributes.repair_history.owner') }}</td>
                                        <td class="text-center">{{ $property->proprietor ?? '' }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>

                    <div class="row m-0 m30b">
                        <div class="col-12 p0">
                            <table id="table-data" class="table table-preview table-preview-analysis table-preview-rent-roll tb-pre-1 m-0 m20b">
                                <tr>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll_list.Floor_and_room_number') }}</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll_list.tenant') }}</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll_list.contract_area') }}<br />{{ trans('attributes.rent_roll_list.square_meters_tsubo') }}</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll_list.monthly_rent') }}<br />({{ trans('attributes.common.yen') }})</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll_list.Rent') }}<br />({{ trans('attributes.common.yen') }})</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll_list.monthly_service_fee') }}<br />({{ trans('attributes.common.yen') }})</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll_list.utilities') }}<br />({{ trans('attributes.common.yen') }})</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll_list.total_rent_month') }}<br />({{ trans('attributes.common.yen') }})</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll_list.total_rent') }}<br />({{ trans('attributes.common.yen') }})</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll_list.security_deposit') }}<br />({{ trans('attributes.common.yen') }})</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll_list.monthly_rent') }}<br />({{ trans('attributes.common.months') }})</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll_list.key_money') }}</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll_list.monthly_rent') }}<br />({{ trans('attributes.common.months') }})</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll.real_estate_type') }}</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll.contract_type') }}</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll.contract_signing_date') }}</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll.contract_start_date') }}</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll.contract_end_date') }}</th>
                                    <th class="fw-bold">{{ trans('attributes.borrowing.table.agreement_period') }}<br />({{ trans('attributes.common.year') }})</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll.money_update') }}<br />({{ trans('attributes.common.months') }})</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll_list.cancellation_notice') }}<br />({{ trans('attributes.common.months') }})</th>
                                    <th class="fw-bold">{{ trans('attributes.rent_roll_list.remarks') }}<br />({{ trans('attributes.rent_roll_list.see_attachment') }})</th>
                                    <th class="border-0"></th>
                                    <th class="fw-bold">{{ trans('attributes.property.assess_revenue_expenditure') }}<br />({{ trans('attributes.rent_roll_list.in_the_property') }})</th>
                                </tr>
                                @forelse($listRentRoll as $rentRoll)
                                    <tr class="content">
                                        <td data-text="{{ displayNumberFloorAndRooms(getIndexSort($rentRoll['floor_code']), $rentRoll['room_code']) }}">
                                            {{ displayNumberFloorAndRooms(BASEMENT_RENT_ROLL[$rentRoll['floor_code']] ?? $rentRoll['floor_code'], $rentRoll['room_code']) !== 'ー' ? displayNumberFloorAndRooms(BASEMENT_RENT_ROLL[$rentRoll['floor_code']] ?? $rentRoll['floor_code'], $rentRoll['room_code']) : '' }}
                                        </td>
                                        <td data-text="{{ $rentRoll['tenant'] ?? 'ー'}}">
                                            @if($rentRoll['room_status'] == 'no_empty')
                                                {{ $rentRoll['tenant'] ?? ''}}
                                            @else
                                                <div class="text-left">ー</div>
                                                <span class="ml-auto rent-btn rent-pink-btn">{{ trans('attributes.rent_roll.room_status') }}</span>
                                            @endif
                                        </td>
                                        <td class="text-nowrap" data-value="{{$rentRoll['contract_area']}}">{{ numberFormatWithUnit($rentRoll['contract_area'],'' . trans('attributes.common.square_meters'), FLAG_TWO) }}<br />
                                            {{ numberFormatWithUnit($rentRoll['contract_area'] * 0.3025,'' . trans('attributes.common.unit2'), FLAG_TWO) }}
                                        </td>
                                        <td class="text-right" data-value="{{$rentRoll['monthly_rent']}}">
                                            {{ number_format($rentRoll['monthly_rent']) }}
                                        </td>
                                        <td class="text-right" data-value="{{ round(divisionNumber($rentRoll['monthly_rent'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), FLAG_ZERO) }}">
                                            {{ number_format(excelRound(divisionNumber($rentRoll['monthly_rent'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), -FLAG_TWO)) }}
                                        </td>
                                        <td class="text-right" data-value="{{$rentRoll['monthly_service']}}">
                                            {{ number_format($rentRoll['monthly_service']) }}
                                        </td>
                                        <td class="text-right" data-value="{{ round(divisionNumber($rentRoll['monthly_service'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), FLAG_ZERO) }}">
                                            {{ number_format(excelRound(divisionNumber($rentRoll['monthly_service'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), -FLAG_TWO)) }}
                                        </td>
                                        <td class="text-right" data-value="{{ round(divisionNumber($rentRoll['monthly_rent'] + $rentRoll['monthly_service'], FLAG_MAX_MONTH), FLAG_ZERO) }}">
                                            {{ number_format($rentRoll['monthly_rent'] + $rentRoll['monthly_service'], FLAG_ZERO) }}
                                        </td>
                                        <td class="text-right" data-value="{{ round(divisionNumber($rentRoll['monthly_rent'] + $rentRoll['monthly_service'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), FLAG_ZERO) }}">
                                            {{ number_format(excelRound(divisionNumber($rentRoll['monthly_rent'] + $rentRoll['monthly_service'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), -FLAG_TWO)) }}
                                        </td>
                                        <td class="text-right" data-value="{{$rentRoll['deposit']}}">
                                            {{ number_format($rentRoll['deposit']) }}
                                        </td>
                                        <td data-value="{{$rentRoll['deposit_monthly']}}">
                                            {{ number_format($rentRoll['deposit_monthly'], FLAG_ONE) }}
                                        </td>
                                        <td class="text-right" data-value="{{$rentRoll['key_money']}}">
                                            {{ number_format($rentRoll['key_money']) }}
                                        </td>
                                        <td class="text-right" data-value="{{$rentRoll['key_money_monthly']}}">
                                            {{ number_format($rentRoll['key_money_monthly'], FLAG_ONE) }}
                                        </td>
                                        <td class="text-center" data-value="{{ $rentRoll['real_estate_type_id'] ? REAL_ESTATE_TYPE[$rentRoll['real_estate_type_id']] : 'ー' }}">
                                            {{ $rentRoll['real_estate_type_id'] ? REAL_ESTATE_TYPE[$rentRoll['real_estate_type_id']] : '' }}
                                        </td>
                                        <td class="text-center" data-value="{{ isset($rentRoll['contract_type']) ? CONTRACT_TYPE[$rentRoll['contract_type']] : 'ー' }}">
                                            {{ isset($rentRoll['contract_type']) ? CONTRACT_TYPE[$rentRoll['contract_type']] : '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $rentRoll['contract_signing_date'] ? dateTimeFormat($rentRoll['contract_signing_date']) : '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $rentRoll['contract_start_date'] ? dateTimeFormat($rentRoll['contract_start_date']) : '' }}
                                        </td>
                                        <td class="text-center">
                                            {{ $rentRoll['contract_end_date'] ? dateTimeFormat($rentRoll['contract_end_date']) : '' }}
                                        </td>
                                        <td class="text-center" data-value="{{ calculationMonthBetweenTwoTimeParts($rentRoll['contract_start_date'],$rentRoll['contract_end_date']) }}">
                                            {{ calculationMonthBetweenTwoTimeParts($rentRoll['contract_start_date'],$rentRoll['contract_end_date']) }}
                                        </td>
                                        <td class="text-right" data-value="{{ $rentRoll['money_update'] }}">
                                            {{ number_format($rentRoll['money_update'], FLAG_ONE) }}
                                        </td>
                                        <td class="text-right" data-value="{{ $rentRoll['cancellation_notice'] }}">
                                            {{ number_format($rentRoll['cancellation_notice']) }}
                                        </td>
                                        <td class="text-center" data-value="{{ $rentRoll['money_update'] }}">
                                            @if(isset($rentRoll['note']))有</td>
                                            @else {{ '' }}
                                            @endif
                                        <td class="border-0" ></td>
                                        <td class="text-right" data-value="{{ $score[$rentRoll['id']] }}">
                                            {{ $score[$rentRoll['id']] }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-left" colspan="24" >{{trans('attributes.rent_roll_list.no_data')}}</td>
                                    </tr>
                                @endforelse

                                <tr class="content">
                                    <td class="border-0"></td>
                                </tr>

                                @if($listRentRoll)
                                <tr class="content">
                                    <td class="fw-bold text-center">{{ trans('attributes.borrowing.table.total') }}</td>
                                    <td></td>
                                    <td class="fw-bold text-nowrap fs8">
                                        {{ numberFormatWithUnit($sumContractArea,'' . trans('attributes.common.square_meters'), FLAG_TWO) }}<br />
                                        {{ numberFormatWithUnit($sumContractAreaFar,'' . trans('attributes.common.unit2'), FLAG_TWO) }}
                                    </td>
                                    <td class="text-right fw-bold fs8">{{ number_format($sumMonthlyRent) }}</td>
                                    <td class="text-right fw-bold fs8">{{ number_format(divisionNumber($sumMonthlyRent, $sumContractAreaFar)) }}</td>
                                    <td class="text-right fw-bold fs8">{{ number_format($sumMonthlyService) }}</td>
                                    <td class="text-right fw-bold fs8">{{ number_format(divisionNumber($sumMonthlyService, $sumContractAreaFar)) }}</td>
                                    <td class="text-right fw-bold fs8">{{ number_format($sumTotalRentService) }}</td>
                                    <td class="text-right fw-bold fs8">{{ number_format(excelRound(round(divisionNumber($sumTotalRentService, $sumContractAreaFar)), FLAG_ZERO)) }}</td>
                                    <td class="text-right fw-bold fs8">{{ number_format($sumDeposit) }}</td>
                                    <td class="text-right fw-bold fs8">{{ number_format(divisionNumber($sumDeposit, $sumMonthlyRent), FLAG_ONE) }}</td>
                                    <td class="text-right fw-bold fs8">{{ number_format($sumKeyMoney, FLAG_ONE) }}</td>
                                    <td class="text-right fw-bold fs8">{{ number_format(divisionNumber($sumKeyMoney, $sumMonthlyRent), FLAG_ONE) }}</td>
                                    <td class="border-0" colspan="13"></td>
                                </tr>
                                <tr class="content">
                                    <td class="border-0"></td>
                                </tr>
                                @endif

                                @if(!empty($listRentRoll))
                                <tr class="content">
                                    <td class="fw-bold text-center" rowspan="3">{{ trans('attributes.rent_roll_list.summary') }}</td>
                                    <td class="w70 text-center"><span class="rent-btn rent-green-btn">{{ trans('attributes.rent_roll_list.rent') }}</span></td>
                                    <td class="text-right text-nowrap">{{ numberFormatWithUnit($sumContractAreaNoEmpty,'' . trans('attributes.common.square_meters'), FLAG_TWO) }}<br />
                                        {{ numberFormatWithUnit($sumContractAreaFarNoEmpty,'' . trans('attributes.common.unit2'), FLAG_TWO) }}</td>
                                    <td class="text-right">{{ number_format($sumMonthlyRentNoEmpty) }}</td>
                                    <td class="">{{ number_format(divisionNumber($sumMonthlyRentNoEmpty, $sumContractAreaFarNoEmpty)) }}</td>
                                    <td class="text-right">{{ number_format($sumMonthlyServiceNoEmpty) }}</td>
                                    <td class="text-right">{{ number_format(divisionNumber($sumMonthlyServiceNoEmpty, $sumContractAreaFarNoEmpty)) }}</td>
                                    <td class="text-right">{{ number_format($sumTotalRentServiceNoEmpty) }}</td>
                                    <td class="text-right">{{ number_format(excelRound(round(divisionNumber($sumTotalRentServiceNoEmpty, $sumContractAreaFarNoEmpty)), FLAG_ZERO)) }}</td>
                                    <td class="text-right">{{ number_format($sumDepositNoEmpty) }}</td>
                                    <td class="text-right">{{ number_format(divisionNumber($sumDepositNoEmpty, $sumMonthlyRentNoEmpty), FLAG_ONE) }}</td>
                                    <td class="text-right">{{ number_format($sumKeyMoneyNoEmpty) }}</td>
                                    <td class="text-right">{{ number_format(divisionNumber($sumKeyMoneyNoEmpty, $sumMonthlyRentNoEmpty), FLAG_ONE) }}</td>
                                    <td class="text-center" colspan="2">{{ trans('attributes.register_info.item_block.label.crop_yield') }}：<br>{{numberFormatWithUnit(divisionNumber(round($sumContractAreaNoEmpty, FLAG_TWO), round($sumContractArea, FLAG_TWO)) * FLAG_ONE_HUNDRED, '' . trans('attributes.common.percent'), FLAG_ONE)}}</td>
                                    <td class="border-0" colspan="9"></td>
                                </tr>
                                <tr class="content">
                                    <td class="text-center"><span class="rent-btn rent-pink-btn">{{ trans('attributes.rent_roll.room_status') }}</span></td>
                                    <td class="text-nowrap">{{ numberFormatWithUnit($sumContractArea - $sumContractAreaNoEmpty,'' . trans('attributes.common.square_meters'), FLAG_TWO) }}<br />
                                        {{ numberFormatWithUnit($sumContractAreaFar -$sumContractAreaFarNoEmpty,'' . trans('attributes.common.unit2'), FLAG_TWO) }}</td>
                                    <td class="text-right">-</td>
                                    <td class="text-right">-</td>
                                    <td class="text-right">-</td>
                                    <td class="text-right">-</td>
                                    <td class="text-right">-</td>
                                    <td class="text-right">-</td>
                                    <td class="text-right">-</td>
                                    <td class="text-right">-</td>
                                    <td class="text-right">-</td>
                                    <td class="text-right">-</td>
                                    <td class="text-center" colspan="2">{{ trans('attributes.rent_roll_list.vacancy_rate') }}：<br>{{numberFormatWithUnit(divisionNumber(round($sumContractArea - $sumContractAreaNoEmpty, FLAG_TWO), round($sumContractArea, FLAG_TWO)) * FLAG_ONE_HUNDRED, '' . trans('attributes.common.percent'), FLAG_ONE)}}</td>
                                    <td class="border-0" colspan="9"></td>
                                </tr>
                                <tr class="content">
                                    <td class="text-center"><span class="rent-btn rent-general-btn">{{ trans('attributes.rent_roll_list.effective_total') }}</span></td>
                                    <td class="text-nowrap">{{ numberFormatWithUnit($sumContractArea,'' . trans('attributes.common.square_meters'), FLAG_TWO) }}<br />
                                        {{ numberFormatWithUnit($sumContractAreaFar,'' . trans('attributes.common.unit2'), FLAG_TWO) }}</td>
                                    <td class="text-right">{{ number_format($sumMonthlyRent) }}</td>
                                    <td class="text-right">-</td>
                                    <td class="text-right">{{ number_format($sumMonthlyService) }}</td>
                                    <td class="text-right">-</td>
                                    <td class="text-right">{{ number_format($sumTotalRentService) }}</td>
                                    <td class="text-right">-</td>
                                    <td class="text-right">{{ number_format($sumDeposit) }}</td>
                                    <td class="text-right">-</td>
                                    <td class="text-right">{{ number_format($sumKeyMoney) }}</td>
                                    <td class="text-right">-</td>
                                    <td class="" colspan="2"></td>
                                    <td class="border-0" colspan="9"></td>
                                </tr>
                                @endif
                                <tr class="content">
                                    <td class="border-0"></td>
                                </tr>
                                @php($j = 0)
                                @foreach($totalRealEstateTypes as $key => $total)
                                    @php($j ++)
                                    @if ($j != count($totalRealEstateTypes))
                                        <tr class="content">
                                            <td class="fw-bold text-center" rowspan="3">{{ trans('attributes.rent_roll_list.application') . $j }}</td>
                                            <td class="w70 text-center"><span class="rent-btn rent-green-btn">{{ trans('attributes.rent_roll_list.the_office') }}</span></td>
                                            <td class="text-nowrap"> {{ numberFormatWithUnit($total[FLAG_ZERO]['contract_area'],'' . trans('attributes.common.square_meters'), FLAG_TWO) }}<br />
                                                {{ numberFormatWithUnit($total[FLAG_ZERO]['contract_area_2'],'' . trans('attributes.common.unit2'), FLAG_TWO) }}</td>
                                            <td class="text-right">{{ number_format($total[FLAG_ZERO]['monthly_rent']) }}</td>
                                            <td class="">{{ number_format(divisionNumber($total[FLAG_TWO]['rental_fee'], round($total[FLAG_ZERO]['contract_area'] * 0.3025, FLAG_TWO))) }}</td>
                                            <td class="text-right">{{ number_format($total[FLAG_ZERO]['monthly_service']) }}</td>
                                            <td class="text-right">{{ number_format(divisionNumber($total[FLAG_TWO]['shared_fee'], round($total[FLAG_ZERO]['contract_area'] * 0.3025, FLAG_TWO))) }}</td>
                                            <td class="">{{ number_format($total[FLAG_ZERO]['monthly_rent'] + $total[FLAG_ZERO]['monthly_service'], FLAG_ZERO) }}</td>
                                            <td class="text-right">{{ number_format(divisionNumber($total[FLAG_TWO]['total_rental'], round($total[FLAG_ZERO]['contract_area'] * 0.3025, FLAG_TWO))) }}</td>
                                            <td class="text-right">{{ number_format($total[FLAG_ZERO]['deposit']) }}</td>
                                            <td class="text-right">{{ number_format(divisionNumber($total[FLAG_ZERO]['deposit'], $total[FLAG_ZERO]['monthly_rent']), FLAG_ONE) }}</td>
                                            <td class="text-right">{{ number_format($total[FLAG_ZERO]['key_money']) }}</td>
                                            <td class="text-right">{{ number_format(divisionNumber($total[FLAG_ZERO]['key_money'], $total[FLAG_ZERO]['monthly_rent']), FLAG_ONE) }}</td>
                                            <td class="text-center" colspan="2">{{ trans('attributes.register_info.item_block.label.crop_yield') }}：<br>{{numberFormatWithUnit(divisionNumber(round($total[FLAG_ZERO]['contract_area'], FLAG_TWO), round($total[FLAG_ZERO]['contract_area'] + $total[FLAG_ONE]['contract_area'], FLAG_TWO)) * FLAG_ONE_HUNDRED, '' . trans('attributes.common.percent'), FLAG_ONE)}}</td>
                                            <td class="border-0" colspan="9"></td>
                                        </tr>

                                        <tr class="content">
                                            <td class="text-center"><span class="rent-btn rent-pink-btn">{{ trans('attributes.rent_roll.room_status') }}</span></td>
                                            <td class="text-nowrap">{{ numberFormatWithUnit($total[FLAG_ONE]['contract_area'],'' . trans('attributes.common.square_meters'), FLAG_TWO) }}<br />
                                                {{ numberFormatWithUnit($total[FLAG_ONE]['contract_area_2'],'' . trans('attributes.common.unit2'), FLAG_TWO) }}</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">-</td>
                                            <td class="text-center" colspan="2">{{ trans('attributes.rent_roll_list.vacancy_rate') }}：<br>{{numberFormatWithUnit(divisionNumber(round($total[FLAG_ONE]['contract_area'], FLAG_TWO), round($total[FLAG_ZERO]['contract_area'] + $total[FLAG_ONE]['contract_area'], FLAG_TWO)) * FLAG_ONE_HUNDRED, '' . trans('attributes.common.percent'), FLAG_ONE)}}</td>
                                            <td class="border-0" colspan="9"></td>
                                        </tr>

                                        <tr class="content">
                                            <td class="text-center"><span class="rent-btn rent-general-btn">{{ trans('attributes.balance.body.meter') }}</span></td>
                                            <td class="text-nowrap">{{ numberFormatWithUnit($total[FLAG_ZERO]['contract_area'] + $total[FLAG_ONE]['contract_area'],'' . trans('attributes.common.square_meters'), FLAG_TWO) }}<br />
                                                {{ numberFormatWithUnit($total[FLAG_ZERO]['contract_area_2'] + $total[FLAG_ONE]['contract_area_2'],'' . trans('attributes.common.unit2'), FLAG_TWO) }}</td>
                                            <td class="text-right">{{ number_format($total[FLAG_ZERO]['monthly_rent'] +$total[FLAG_ONE]['monthly_rent']) }}</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">{{ number_format($total[FLAG_ZERO]['monthly_service'] + $total[FLAG_ONE]['monthly_service']) }}</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">{{ number_format($total[FLAG_ZERO]['monthly_rent'] + $total[FLAG_ZERO]['monthly_service'] + $total[FLAG_ONE]['monthly_rent'] + $total[FLAG_ONE]['monthly_service'], FLAG_ZERO) }}</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">{{ number_format($total[FLAG_ZERO]['deposit'] + $total[FLAG_ONE]['deposit']) }}</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">{{ number_format($total[FLAG_ZERO]['key_money'] + $total[FLAG_ONE]['key_money']) }}</td>
                                            <td class="text-right">-</td>
                                            <td class="" colspan="2"></td>
                                            <td class="border-0" colspan="9"></td>
                                        </tr>
                                        <tr class="content">
                                            <td class="border-0"></td>
                                        </tr>
                                    @else
                                        <tr class="content">
                                            <td class="fw-bold text-center" rowspan="3">{{ trans('attributes.rent_roll_list.application') . $j }}</td>
                                            <td class="w70 text-center"><span class="rent-btn rent-green-btn">{{ trans('attributes.rent_roll_list.the_office') }}</span></td>
                                            <td class="text-nowrap">{{ numberFormatWithUnit($total[FLAG_ZERO]['contract_area'],'' . trans('attributes.common.square_meters'), FLAG_TWO) }}<br />
                                                {{ numberFormatWithUnit($total[FLAG_ZERO]['contract_area_2'],'' . trans('attributes.common.unit2'), FLAG_TWO) }}</td>
                                            <td class="text-right">{{ number_format($total[FLAG_ZERO]['monthly_rent']) }}</td>
                                            <td class="">{{ number_format(divisionNumber($total[FLAG_TWO]['rental_fee'], round($total[FLAG_ZERO]['contract_area'] * 0.3025, FLAG_TWO))) }}</td>
                                            <td class="text-right">{{ number_format($total[FLAG_ZERO]['monthly_service']) }}</td>
                                            <td class="text-right">{{ number_format(divisionNumber($total[FLAG_TWO]['shared_fee'], round($total[FLAG_ZERO]['contract_area'] * 0.3025, FLAG_TWO))) }}</td>
                                            <td class="">{{ number_format($total[FLAG_ZERO]['monthly_rent'] + $total[FLAG_ZERO]['monthly_service'], FLAG_ZERO) }}</td>
                                            <td class="text-right">{{ number_format(divisionNumber($total[FLAG_TWO]['total_rental'], round($total[FLAG_ZERO]['contract_area'] * 0.3025, FLAG_TWO))) }}</td>
                                            <td class="text-right">{{ number_format($total[FLAG_ZERO]['deposit']) }}</td>
                                            <td class="text-right">{{ number_format(divisionNumber($total[FLAG_ZERO]['deposit'], $total[FLAG_ZERO]['monthly_rent']), FLAG_ONE) }}</td>
                                            <td class="text-right">{{ number_format($total[FLAG_ZERO]['key_money']) }}</td>
                                            <td class="text-right">{{ number_format(divisionNumber($total[FLAG_ZERO]['key_money'], $total[FLAG_ZERO]['monthly_rent']), FLAG_ONE) }}</td>
                                            <td class="text-center" colspan="2">{{ trans('attributes.register_info.item_block.label.crop_yield') }}：<br>{{numberFormatWithUnit(divisionNumber(round($total[FLAG_ZERO]['contract_area'], FLAG_TWO), round($total[FLAG_ZERO]['contract_area'] + $total[FLAG_ONE]['contract_area'], FLAG_TWO)) * FLAG_ONE_HUNDRED, '' . trans('attributes.common.percent'), FLAG_ONE)}}</td>
                                            <td class="border-0" colspan="9"></td>
                                        </tr>

                                        <tr class="content">
                                            <td class="text-center"><span class="rent-btn rent-pink-btn">{{ trans('attributes.rent_roll.room_status') }}</span></td>
                                            <td class="text-nowrap">{{ numberFormatWithUnit($total[FLAG_ONE]['contract_area'],'' . trans('attributes.common.square_meters'), FLAG_TWO) }}<br />
                                                {{ numberFormatWithUnit($total[FLAG_ONE]['contract_area_2'],'' . trans('attributes.common.unit2'), FLAG_TWO) }}</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">-</td>
                                            <td class="text-center" colspan="2">{{ trans('attributes.rent_roll_list.vacancy_rate') }}：<br>{{numberFormatWithUnit(divisionNumber(round($total[FLAG_ONE]['contract_area'], FLAG_TWO), round($total[FLAG_ZERO]['contract_area'] + $total[FLAG_ONE]['contract_area'], FLAG_TWO)) * FLAG_ONE_HUNDRED, '' . trans('attributes.common.percent'), FLAG_ONE)}}</td>
                                            <td class="border-0" colspan="9"></td>
                                        </tr>

                                        <tr class="content">
                                            <td class="text-center"><span class="rent-btn rent-general-btn">{{ trans('attributes.balance.body.meter') }}</span></td>
                                            <td class="text-nowrap">{{ numberFormatWithUnit($total[FLAG_ZERO]['contract_area'] + $total[FLAG_ONE]['contract_area'],'' . trans('attributes.common.square_meters'), FLAG_TWO) }}<br />
                                                {{ numberFormatWithUnit($total[FLAG_ZERO]['contract_area_2'] + $total[FLAG_ONE]['contract_area_2'],'' . trans('attributes.common.unit2'), FLAG_TWO) }}</td>
                                            <td class="text-right">{{ number_format($total[FLAG_ZERO]['monthly_rent'] + $total[FLAG_ONE]['monthly_rent']) }}</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">{{ number_format($total[FLAG_ZERO]['monthly_service'] + $total[FLAG_ONE]['monthly_service']) }}</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">{{ number_format($total[FLAG_ZERO]['monthly_rent'] + $total[FLAG_ZERO]['monthly_service'] + $total[FLAG_ONE]['monthly_rent'] + $total[FLAG_ONE]['monthly_service']) }}</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">{{ number_format($total[FLAG_ZERO]['deposit'] + $total[FLAG_ONE]['deposit']) }}</td>
                                            <td class="text-right">-</td>
                                            <td class="text-right">{{ number_format($total[FLAG_ZERO]['key_money'] + $total[FLAG_ONE]['key_money']) }}</td>
                                            <td class="text-right">-</td>
                                            <td class="" colspan="2"></td>
                                            <td class="border-0" colspan="9"></td>
                                        </tr>
                                        <tr class="content">
                                            <td class="border-0"></td>
                                        </tr>
                                    @endif
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>

                <div id="page-22"  class="page-22 print-bg m0">
                    <div class="col-12 m30b p0">
                        <div class="row m-0">
                            <div class="col-6 p0">
                                <div id="parent-chart-room-pre" class="container-preview m0 m15r diagram-analysis">
                                    <div class="p30 diagram-block" style="background: transparent !important; min-height: 365px !important;">
                                        <div class="w-auto">
                                            <div><div id="pre-chart-room"></div></div>
                                            <div class="legend-chart legend-chart1 row m0 p20l">
                                                <div class="margin-auto row col-8 col-lg-5 col-xl-5">
                                                    <div class="col-6 row m-0">
                                                        <div class="col-6"><div class="margin-auto room_no_empty"></div></div>
                                                        <div class="col-6 fs14">{{ trans('attributes.common.room_no_empty') }}</div>
                                                    </div>
                                                    <div class="col-6 row m-0">
                                                        <div class="col-6"><div class="margin-auto room_empty"></div></div>
                                                        <div class="col-6 fs14">{{ trans('attributes.common.room_empty') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 p0">
                                <div id="parent-chart-acreage-pre" class="container-preview m0 m15l diagram-analysis">
                                    <div class="p30 diagram-block" style="background: transparent !important; min-height: 365px !important;">
                                        <div class="w-auto">
                                            <div><div id="pre-chart-acreage"></div></div>
                                            <div class="legend-chart legend-chart2 row m0 p20l">
                                                <div class="margin-auto row col-8 col-lg-5 col-xl-5">
                                                    <div class="col-6 row m-0">
                                                        <div class="col-6"><div class="margin-auto room_no_empty"></div></div>
                                                        <div class="col-6 fs14">{{ trans('attributes.common.room_no_empty') }}</div>
                                                    </div>
                                                    <div class="col-6 row m-0">
                                                        <div class="col-6"><div class="margin-auto room_empty"></div></div>
                                                        <div class="col-6 fs14">{{ trans('attributes.common.room_empty') }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="container-preview" class="container-preview m0 diagram-analysis">
                        <div class="p30">
                            <div class="m20b">
                                <div class="col-12 p0l m0">
                                    <p class="fs16 fw-bold m0">{{ trans('attributes.property.notes') }}</p>
                                </div>
                            </div>

                            <div class="col-12 p0 break-all">
                                @foreach($listRentRoll as $rentRoll)
                                    @if(isset($rentRoll['note']))
                                        <div class="m30b" id="attention-{{$rentRoll['id']}}">
                                            <h5>{{ DisplayNumberFloorAndRooms(BASEMENT_RENT_ROLL[$rentRoll['floor_code']] ?? $rentRoll['floor_code'], $rentRoll['room_code']) }}</h5>
                                            <p class="fs12 m13b">{{ $rentRoll['note'] }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
