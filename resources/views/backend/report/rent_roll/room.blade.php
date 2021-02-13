@extends('layout.home.master')
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-rent p60b container-padding">
        <div id="main-info-assessment">
            <div class="row row-header m50b">
                <div class="row m0">
                    <div class="col-12 text-center text-md-left p0">
                        <h3 class="m0">{{ trans('attributes.rent_roll.room.title') }}</h3>
                    </div>
                </div>
            </div>

            @include('partials.flash_messages')

            @if ($currentUser->role != INVESTOR)
                <form id="form-condition-1" class="row m0 m30b">
                    <div id="block-status" class="block-status row spBlock m0 w-auto">
                        <div class="centered first-block p15r p15l">
                            <label class="m0">{{ trans('attributes.repair_history.owner') }}</label>
                        </div>
                        <div class="centered-vertical p0 p15r p15l w250">
                            <div class="fw-normal">{{ $property->proprietor ?? 'ー' }}</div>
                        </div>
                    </div>
                </form>
            @endif

            <div class="row m0 m20b br10 bg-white">
                <div class="table-responsive fs14 br10">
                    <input type="text" class="d-none property-id" value="{{ $property->id }}">
                    <table id="table-property" class="table-rent-roll-room table table-bordered table-striped border-0 m0">
                        <tr class="table-head">
                            <td class="border-0">
                                <div class="centered-vertical w90">
                                    <span>{{ trans('attributes.user_detail.btn_delete') }}</span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical sort-table-rent-roll-room w90">
                                    <span>{{ trans('attributes.rent_roll_list.Floor_and_room_number') }}</span>
                                    <span class="sort-icon" data-id='1'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                </div>
                            </td>
                            <td class="border-top-0 border-right-0 min-w115">
                                <div class="centered-vertical sort-table-rent-roll-room w70">
                                    <span class="centered">
                                        <p class="m0">{{ trans('attributes.rent_roll.room.original_contract_date') }}</p>
                                        <span class="sort-icon" data-id='2'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical sort-table-rent-roll-room w150">
                                    <span>{{ trans('attributes.rent_roll.room.tenant') }}</span>
                                    <span class="sort-icon" data-id='3'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                </div>
                            </td>
                            <td class="border-top-0 border-right-0">
                                <div class="centered-vertical sort-table-rent-roll-room w100">
                                    <span class="centered">
                                        <p class="m0">{{ trans('attributes.rent_roll_list.current_contract_start_date') }}</p>
                                        <span class="sort-icon" data-id='4'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical sort-table-rent-roll-room w70">
                                    <span class="centered">
                                        <p class="m0">{{ trans('attributes.rent_roll_list.contract_area') }}</p>
                                        <span class="sort-icon" data-id='5'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                </div>
                                <span class="fs11">({{ trans('attributes.common.unit-5') }})</span>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical sort-table-rent-roll-room w70">
                                    <span class="centered">
                                        <p class="m0">{{ trans('attributes.rent_roll_list.monthly_rent') }}</p>
                                        <span class="sort-icon" data-id='6'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                </div>
                                <span class="fs11">({{ trans('attributes.common.yen') }})</span>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical sort-table-rent-roll-room w70">
                                    <span class="centered">
                                        <p class="m0">{{ trans('attributes.rent_roll_list.Rent') }}<br><span class="fs11">({{ trans('attributes.common.yen') }})</span></p>
                                        <span class="sort-icon" data-id='7'><i class="fa-sort-icon fa fa-caret-down m15b" aria-hidden="true"></i></span>
                                    </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical sort-table-rent-roll-room w90">
                                    <p class="m0">{{ trans('attributes.rent_roll_list.monthly_service_fee') }}<br><span class="fs11">({{ trans('attributes.common.yen') }})</span></p>
                                    <span class="sort-icon" data-id='8'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical sort-table-rent-roll-room w90">
                                    <span class="centered">
                                        <p class="m0">{{ trans('attributes.rent_roll_list.utilities') }}<br><span class="fs11">({{ trans('attributes.common.yen') }})</span></p>
                                        <span class="sort-icon" data-id='9'><i class="fa-sort-icon fa fa-caret-down m15b" aria-hidden="true"></i></span>
                                    </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical sort-table-rent-roll-room w100">
                                    <p class="m0">{{ trans('attributes.rent_roll_list.total_rent_month') }}<br><span class="fs11">({{ trans('attributes.common.yen') }})</span></p>
                                    <span class="sort-icon" data-id='10'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical sort-table-rent-roll-room w100">
                                    <span class="centered">
                                        <p class="m0">{{ trans('attributes.rent_roll_list.total_rent') }}<br><span class="fs11">({{ trans('attributes.common.yen') }})</span></p>
                                        <span class="sort-icon" data-id='11'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical sort-table-rent-roll-room w70">
                                    <span class="centered">
                                        <p class="m0">{{ trans('attributes.property.deposit') }}</p>
                                        <span class="sort-icon" data-id='12'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                </div>
                                <span class="fs11">({{ trans('attributes.common.yen') }})</span>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical sort-table-rent-roll-room w70">
                                    <span>{{ trans('attributes.rent_roll_list.monthly_rent') }}</span>
                                    <span class="sort-icon" data-id='13'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                </div>
                                <span class="fs11">({{ trans('attributes.common.months') }})</span>
                            </td>
                            <td class="border-top-0 border-right-0">
                                <div class="centered-vertical sort-table-rent-roll-room w70">
                                    <span class="centered">
                                        <p class="m0">{{ trans('attributes.rent_roll_list.key_money') }}</p>
                                        <span class="sort-icon" data-id='14'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                </div>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical sort-table-rent-roll-room w70">
                                    <span>{{ trans('attributes.rent_roll_list.monthly_rent') }}</span>
                                    <span class="sort-icon" data-id='15'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                </div>
                                <span class="fs11">({{ trans('attributes.common.months') }})</span>
                            </td>
                            <td class="border-top-0">
                                <div class="centered-vertical sort-table-rent-roll-room w70">
                                    <span>{{ trans('attributes.simulation.content.physical_info.uses') }}</span>
                                    <span class="sort-icon" data-id='16'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                </div>
                            </td>
                            <td class="border-top-0 border-right-0">
                                <div class="centered-vertical sort-table-rent-roll-room w70">
                                    <span class="centered">
                                        <p class="m0">{{ trans('attributes.rent_roll_list.contract_type') }}</p>
                                        <span class="sort-icon" data-id='17'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                </div>
                            </td>
                            <td class="border-top-0 border-right-0">
                                <div class="centered-vertical sort-table-rent-roll-room w100">
                                    <span class="centered">
                                        <p class="m0">{{ trans('attributes.rent_roll_list.end_date_of_current_contract') }}</p>
                                        <span class="sort-icon" data-id='18'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                </div>
                            </td>
                            <td class="border-top-0 border-right-0">
                                <div class="centered-vertical sort-table-rent-roll-room w70">
                                    <span>{{ trans('attributes.borrowing.table.agreement_period') }}</span>
                                    <span class="sort-icon" data-id='19'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                </div>
                                <span class="fs11">({{ trans('attributes.common.year') }})</span>
                            </td>
                            <td class="border-top-0 border-right-0">
                                <div class="centered-vertical sort-table-rent-roll-room w70">
                                    <span class="centered">
                                        <p class="m0">{{ trans('attributes.property.contract_update_fee') }}</p>
                                        <span class="sort-icon" data-id='20'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                </div>
                            </td>
                            <td class="border-top-0 border-right-0">
                                <div class="centered-vertical sort-table-rent-roll-room w70">
                                    <span>{{ trans('attributes.rent_roll_list.cancellation_notice') }}</span>
                                    <span class="sort-icon" data-id='21'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                </div>
                                <span class="fs11">({{ trans('attributes.common.months') }})</span>
                            </td>
                            <td class="border-top-0 border-right-0">
                                <div class="centered-vertical sort-table-rent-roll-room w70">
                                    <span class="centered">
                                        <p class="m0">{{ trans('attributes.rent_roll_list.remarks') }}<br />({{ trans('attributes.rent_roll_list.see_attachment') }})</p>
                                        <span class="sort-icon" data-id='22'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                </div>
                            </td>
                            <td class="border-top-0 border-right-0">
                                <div class="centered-vertical sort-table-rent-roll-room w100">
                                    <span class="centered">
                                        <p class="m0">{{ trans('attributes.borrowing.table.rental_condition_score') }}<br />({{ trans('attributes.rent_roll_list.in_the_property') }})</p>
                                        <span class="sort-icon" data-id='23'><i class="fa-sort-icon fa fa-caret-down" aria-hidden="true"></i></span>
                                    </span>
                                </div>
                            </td>
                        </tr>

                        @forelse($dataRooms as $rentRoll)
                            <tr class="table">
                                <td class="border-left-0">
                                    <a class="delete-rent-roll-room pointer" data-id="{{ $rentRoll['id'] }}"><i class="far fa-trash-alt"></i></a>
                                </td>
                                <td class="border-left-0" data-text="{{ displayNumberFloorAndRooms(getIndexSort($rentRoll['floor_code']), $rentRoll['room_code']) }}">
                                    {{ displayNumberFloorAndRooms(BASEMENT_RENT_ROLL[$rentRoll['floor_code']] ?? $rentRoll['floor_code'], $rentRoll['room_code']) }}
                                </td>
                                <td class="border-bottom-0 text-center">{{ $rentRoll['contract_signing_date'] ? dateTimeFormat($rentRoll['contract_signing_date']) : 'ー' }}</td>
                                <td class="border-bottom-0" data-text="{{ $rentRoll['room_status'] == 'no_empty' ? $rentRoll['tenant'] ?? 'ー' : 'ー'}}">
                                    @if($rentRoll['room_status'] == 'no_empty')
                                        {{ $rentRoll['tenant'] ?? 'ー'}}
                                    @else
                                        ー<span class="room-empty">{{ trans('attributes.rent_roll.room_status') }}</span>
                                    @endif
                                </td>
                                <td class="border-bottom-0 text-center">{{ $rentRoll['contract_start_date'] ? dateTimeFormat($rentRoll['contract_start_date']) : 'ー' }}</td>
                                <td class="border-bottom-0 convert-data text-nowrap" data-value="{{$rentRoll['contract_area']}}">
                                    {{ numberFormatWithUnit($rentRoll['contract_area'],'' . trans('attributes.common.square_meters'), FLAG_TWO) }}
                                    <br />{{ numberFormatWithUnit($rentRoll['contract_area'] * 0.3025,'' . trans('attributes.common.unit2'), FLAG_TWO) }}
                                </td>
                                <td class="border-bottom-0 text-right convert-data" data-value="{{$rentRoll['monthly_rent']}}">
                                    {{ number_format($rentRoll['monthly_rent']) }}
                                </td>
                                <td class="border-bottom-0 text-right convert-data" data-value="{{ round(divisionNumber($rentRoll['monthly_rent'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), FLAG_ZERO) }}">
                                    {{ number_format(excelRound(divisionNumber($rentRoll['monthly_rent'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), -FLAG_TWO)) }}
                                </td>
                                <td class="border-bottom-0 text-right convert-data" data-value="{{$rentRoll['monthly_service']}}">
                                    {{ number_format($rentRoll['monthly_service']) }}
                                </td>
                                <td class="border-bottom-0 text-right" data-value="{{ round(divisionNumber($rentRoll['monthly_service'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), FLAG_ZERO) }}">
                                    {{ number_format(excelRound(divisionNumber($rentRoll['monthly_service'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), -FLAG_TWO)) }}
                                </td>
                                <td class="border-bottom-0 text-right" data-value="{{ round($rentRoll['monthly_rent'] + $rentRoll['monthly_service'], FLAG_ZERO) }}">
                                    {{ number_format($rentRoll['monthly_rent'] + $rentRoll['monthly_service'], FLAG_ZERO) }}
                                </td>
                                <td class="border-bottom-0 text-right" data-value="{{ round(divisionNumber($rentRoll['monthly_rent'] + $rentRoll['monthly_service'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), FLAG_ZERO) }}">
                                    {{ number_format(excelRound(divisionNumber($rentRoll['monthly_rent'] + $rentRoll['monthly_service'], round($rentRoll['contract_area'] * 0.3025, FLAG_TWO)), -FLAG_TWO)) }}
                                </td>
                                <td class="border-bottom-0 text-right" data-value="{{$rentRoll['deposit']}}">
                                    {{ number_format($rentRoll['deposit']) }}
                                </td>
                                <td class="border-bottom-0 text-right" data-value="{{$rentRoll['deposit_monthly']}}">
                                    {{ number_format($rentRoll['deposit_monthly'], FLAG_ONE) }}
                                </td>
                                <td class="border-bottom-0 text-right" data-value="{{$rentRoll['key_money']}}">
                                    {{ number_format($rentRoll['key_money']) }}
                                </td>
                                <td class="border-bottom-0 text-right" data-value="{{$rentRoll['key_money_monthly']}}">
                                    {{ number_format($rentRoll['key_money_monthly'], FLAG_ONE) }}
                                </td>
                                <td class="border-bottom-0" data-value="{{ $rentRoll['real_estate_type_id'] ? REAL_ESTATE_TYPE[$rentRoll['real_estate_type_id']] : 'ー' }}">
                                    {{ $rentRoll['real_estate_type_id'] ? REAL_ESTATE_TYPE[$rentRoll['real_estate_type_id']] : 'ー' }}
                                </td>
                                <td class="border-bottom-0" data-value="{{ isset($rentRoll['contract_type']) ? CONTRACT_TYPE[$rentRoll['contract_type']] : 'ー' }}">
                                    {{ isset($rentRoll['contract_type']) ? CONTRACT_TYPE[$rentRoll['contract_type']] : 'ー' }}
                                </td>
                                <td class="border-bottom-0 text-center">{{ $rentRoll['contract_end_date'] ? dateTimeFormat($rentRoll['contract_end_date']) : 'ー' }}</td>
                                <td class="border-bottom-0 text-center" data-value="{{ calculationMonthBetweenTwoTimeParts($rentRoll['contract_start_date'],$rentRoll['contract_end_date']) }}">
                                    {{ calculationMonthBetweenTwoTimeParts($rentRoll['contract_start_date'],$rentRoll['contract_end_date']) }}
                                </td>
                                <td class="border-bottom-0 text-right" data-value="{{ $rentRoll['money_update'] }}">
                                    {{ number_format($rentRoll['money_update'], FLAG_ONE) }}
                                </td>
                                <td class="border-bottom-0 text-right" data-value="{{ $rentRoll['cancellation_notice'] }}">
                                    {{ number_format($rentRoll['cancellation_notice']) }}
                                </td>
                                <td class="border-bottom-0">
                                    @if(isset($rentRoll['note']))
                                        <a href="#">有</a></td>
                                @else
                                    {{ '' }}
                                @endif
                                <td class="border-bottom-0 border-right-0 text-right" data-value="{{ $score[$rentRoll['id']] == FLAG_ZERO ? '' : $score[$rentRoll['id']] }}">
                                    {{ $score[$rentRoll['id']] == FLAG_ZERO ? '' : $score[$rentRoll['id']] }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-left" colspan="26" >{{trans('attributes.rent_roll_list.no_data')}}</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>

            <div class="row col-12 text-center text-lg-right m0 p0">
                <div class="col-6 text-center text-md-right m0 p0 row">
                </div>

                <div class="col-6 text-center text-lg-right p0 text-right">
                    <div class="d-inline-block cus-paginate m15l">
                        {{ $dataRooms->links('partials.text_topic', ['totalPage' => ceil(($dataRooms->total())/($dataRooms->perPage()))]) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('modal.delete.confirm_rent_roll')
@endsection
@section('js')
    <script src="{{ asset('dist/js/rent-roll.min.js') }}"></script>
@endsection
