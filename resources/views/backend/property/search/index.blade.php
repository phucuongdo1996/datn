@extends('layout.home.master')
@section('content')
    <div class="container-fluid container-wrapper container-wrapper-bank wrapper-bank-list">
        <div id="main-info-assessment">
            <div class="row row-header m50b">
                <div class="row m0">
                    <div class="col-12 text-center text-md-left p0">
                        <h3 class="m0">{{ __('attributes.search_bank.list.title') }}</h3>
                    </div>
                </div>
            </div>
            <div class="p15lr">
                <form id="form-condition-1" class="row m0 m35b" action="bank-list.html" method="get">
                    <div class="col-8 col-12-sp row m-0 p0">
                        <div id="block-status" class="d-flex spBlock m0l m10r w-auto">
                            <div class="centered first-block p15r p15l">
                                <label class="m0 w90 text-center">{{ __('attributes.search_bank.list.search_condition') }}</label>
                            </div>
                            <div class="centered p0 p18r p18l search-conditions">
                                <div class="fw-normal">
                                    <div>{{ __('attributes.rent_roll.real_estate_type') . ' : ' . REAL_ESTATE_TYPE_SEARCH[$itemSearch[FLAG_ZERO]] }}</div>
                                    <div>{{ __('attributes.search_bank.area_title') . ' : ' . ($itemSearch[FLAG_ONE] == trans('attributes.search_bank.area.tokyo_metropolitan_area_2') ? trans('attributes.search_bank.area.tokyo_metropolitan_area') : $itemSearch[FLAG_ONE]) }}</div>
                                    <div>{{ __('attributes.search_bank.total_floor_area') . ' : ' . $itemSearch[FLAG_TWO] }}</div>
                                    <div>{{ __('attributes.search_bank.age') . ' : ' . $itemSearch[FLAG_THREE] }}</div>
                                </div>
                            </div>
                        </div>
                        <a href="#"  data-toggle="modal" data-target=".myModal" data-keyboard="true" data-backdrop="true" class="btn custom-btn-default fs15 sort-property w110" id="search-conditions_change_btn">{{ __('attributes.search_bank.list.change_conditions') }}</a>
                    </div>

                    <!--0319 add-->
                    <div class="col-4 col-12-sp text-lg-rightp0 text-right group-button-top">
                        <div class="row m0 p0">
                            <div class="col-lg-6 p0">
                                <button type="button" class="btn br8 custom-btn-default dropdown-toggle fs15 fs13-sp" data-toggle="dropdown" aria-expanded="true">{{ __('attributes.search_bank.list.display_item') }}</button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-item checkbox-search"><input id="check-location" value="check1" type="checkbox" class="check-search" checked><label for="check-location">{{ __('attributes.balance.body.location') }}</label></div>
                                    <div class="dropdown-item checkbox-search"><input id="check-main-purpose" value="check2" type="checkbox" class="check-search" checked><label for="check-main-purpose">{{ __('attributes.register_info.item_block.label.main_purpose') }}</label></div>
                                    <div class="dropdown-item checkbox-search"><input id="check-structure" value="check3" type="checkbox" class="check-search" checked><label for="check-structure">{{ __('attributes.register_info.item_block.label.construction') }}</label></div>
                                    <div class="dropdown-item checkbox-search"><input id="check-storey" value="check4" type="checkbox" class="check-search" checked><label for="check-storey">{{ __('attributes.register_info.item_block.label.floor') }}</label></div>
                                    <div class="dropdown-item checkbox-search"><input id="check-ground-area" value="check5" type="checkbox" class="check-search" checked><label for="check-ground-area">{{ __('attributes.balance.body.total_land_area') }}</label></div>
                                    <div class="dropdown-item checkbox-search"><input id="check-floor-area" value="check6" type="checkbox" class="check-search" checked><label for="check-floor-area">{{ __('attributes.register_info.item_block.label.area_floor') }}</label></div>
                                    <div class="dropdown-item checkbox-search"><input id="check-completion-year" value="check7" type="checkbox" class="check-search" checked><label for="check-completion-year">{{ __('attributes.balance.body.table.year_of_completion') }}</label></div>
                                    <div class="dropdown-item checkbox-search"><input id="check-land-rights" value="check8" type="checkbox" class="check-search" checked><label for="check-land-rights">{{ __('attributes.register_info.item_block.label.land_rights') }}</label></div>
                                    <div class="dropdown-item checkbox-search"><input id="check-building-rights" value="check9" type="checkbox" class="check-search" checked><label for="check-building-rights">{{ __('attributes.register_info.item_block.label.building_right') }}</label></div>
                                    <div class="dropdown-item checkbox-search"><input id="check-area-may-rent" value="check10" type="checkbox" class="check-search" checked><label for="check-area-may-rent">{{ __('attributes.register_info.item_block.label.leasable_area') }}</label></div>
                                </ul>
                            </div>
                            <div class="col-lg-6 p0">
                                {{ $listData->appends(array_merge(['option_paginate' => LIMIT_RECORD_SEARCH_DEFAULT], $_GET))->links('partials.simple_paginate', ['totalPage' => $listData->lastPage(), 'search' => true]) }}
                            </div>
                        </div>
                    </div>

                    <!--0319 add-->
                </form>

                <div class="row m0 br10 bg-white">
                    <div class="table-responsive br10">
                        <table id="table-property" class="table table-bordered table-striped border-0 m0">
                            <tr class="table-head">
                                <td class="border-0 text-center">
                                        <label class="container-input p25l">
                                            <input id="all-data" type="checkbox" checked>
                                            <span class="checkmark"></span>
                                            <span>{{ trans('attributes.borrowing.table.no') }}</span>
                                        </label>

                                    </td>
                                <td class="border-top-0 text-center"><div class="w60">{{ __('attributes.register_info.item_block.label.prefectures') }}</div></td>
                                <td class="border-top-0 text-center check-location">
                                    <div class="w60">
                                        <p class="m0">{{ __('attributes.balance.body.location') }}</p>
                                        <p class="m0 fs11 fw-normal">({{ __('attributes.balance.body.table.urban_area') }})</p>
                                    </div>
                                </td>
                                <td class="border-top-0 text-left check-main-purpose"><div class="w120">{{ __('attributes.register_info.item_block.label.main_purpose') }}</div></td>
                                <td class="border-top-0 text-left check-structure"><div class="w170">{{ __('attributes.register_info.item_block.label.construction') }}</div></td>
                                <td class="border-top-0 check-storey">
                                    <div class="w50">
                                        <p class="m0">{{ __('attributes.register_info.item_block.label.floor') }}</p>
                                        <p class="m0 fs11 fw-normal">({{ __('attributes.balance.body.table.ground_floor') }})</p>
                                    </div>
                                </td>
                                <td class="border-top-0 check-ground-area"><div class="w90">{{ __('attributes.balance.body.total_land_area') }}</div></td>
                                <td class="border-top-0 check-floor-area"><div class="w90">{{ __('attributes.register_info.item_block.label.area_floor') }}</div></td>
                                <td class="border-top-0 text-left check-completion-year"><div class="w70">{{ __('attributes.balance.body.table.year_of_completion') }}</div></td>
                                <td class="border-top-0 check-land-rights"><div class="w90">{{ __('attributes.register_info.item_block.label.land_rights') }}</div></td>
                                <td class="border-top-0 check-building-rights"><div class="w60">{{ __('attributes.register_info.item_block.label.building_right') }}</div></td>
                                <td class="border-top-0 check-area-may-rent"><div class="w90">{{ __('attributes.register_info.item_block.label.leasable_area') }}</div></td>
                                <td class="border-top-0">
                                    <div class="w90">
                                        <p class="m0">{{ __('attributes.business_plan.rentable_floor_area_ratio_1') }}</p>
                                        <p class="m0 fs11 fw-normal">{{ __('attributes.business_plan.rentable_floor_area_ratio_2') }}</p>
                                    </div>
                                </td>
                                <td class="border-top-0"><div class="w70">{{ __('attributes.register_info.item_block.label.crop_yield') }}</div></td>
                                <td class="border-top-0">
                                    <div class="w90">
                                        <p class="m0">{{ __('attributes.register_info.item_block.label.rent_income_2') }}</p>
                                        <p class="m0 fs11 fw-normal">({{ __('attributes.balance.body.table.monthly_basis') }})</p>
                                    </div>
                                </td>
                                <td class="border-top-0">
                                    <div class="w90">
                                        <p class="m0">{{ __('attributes.register_info.item_block.title.operating_revenue') }}</p>
                                        <p class="m0 fs11 fw-normal">{{ __('attributes.search_bank.list.year') }}</p>
                                    </div>
                                </td>
                                <td class="border-top-0">
                                    <div class="w90">
                                        <p class="m0">{{ __('attributes.register_info.item_block.label.management_fee') }}</p>
                                        <p class="m0 fs11 fw-normal">{{ __('attributes.search_bank.list.month') }}</p>
                                    </div>
                                </td>
                                <td class="border-top-0">
                                    <div class="w90">
                                        <p class="m0">{{ __('attributes.register_info.item_block.label.repair_fee') }}</p>
                                        <p class="m0 fs11 fw-normal">{{ __('attributes.search_bank.list.year') }}</p>
                                    </div>
                                </td>
                                <td class="border-top-0">
                                    <div class="w90">
                                        <p class="m0">{{ __('attributes.register_info.item_block.label.insurance_premium') }}</p>
                                        <p class="m0 fs11 fw-normal">{{ __('attributes.search_bank.list.year') }}</p>
                                    </div>
                                </td>
                                <td class="border-top-0">
                                    <div class="w90">
                                        <p class="m0">{{ __('attributes.register_info.item_block.title.operating_cost') }}</p>
                                        <p class="m0 fs11 fw-normal">{{ __('attributes.search_bank.list.year') }}</p>
                                    </div>
                                </td>
                                <td class="border-top-0">
                                    <div class="w60">
                                        <p class="m0">{{ __('attributes.balance.body.table.expense_ratio') }}</p>
                                        <p class="m0 fs11 fw-normal">{{ __('attributes.search_bank.list.cost_ratio') }}</p>
                                    </div>
                                </td>
                                <td class="border-top-0">
                                    <div class="w90">
                                        <p class="m0">{{ __('attributes.register_info.item_block.label.operating_balance') }}</p>
                                        <p class="m0 fs11 fw-normal">{{ __('attributes.search_bank.list.year') }}</p>
                                    </div>
                                </td>
                            </tr>

                            @php( $stepNumber = ($listData->currentPage() - FLAG_ONE) * LIMIT_RECORD_SEARCH_DEFAULT)
                            @forelse($listData as $key => $data)
                                <tr class="table">
                                    <td class="border-left-0 text-center">
                                        <label class="container-input p20l fw-normal">
                                            <input class="check-show-on-chart" checked type="checkbox" name="id-chart" data-index="{{ $key }}">
                                            <span class="checkmark"></span>
                                            <span>{{ $stepNumber + $key + FLAG_ONE }}</span>
                                        </label>

                                    </td>
                                    <td class="border-bottom-0 text-center">{{ $data->address_city ?? 'ー' }}</td>
                                    <td class="border-bottom-0 text-center check-location">{{ $data->address_district ?? 'ー' }}</td>
                                    <td class="border-bottom-0 text-left check-main-purpose">{{ $data->realEstateType['name'] ?? ""}}</td>
                                    <td class="border-bottom-0 text-left check-structure">{{ materialFormat($data->houseMaterial['name'], $data->houseRoofType['name'])}}</td>
                                    <td class="border-bottom-0 text-center check-storey">{{ $data->storeys ?? "ー" }}</td>
                                    <td class="border-bottom-0 text-right check-ground-area">{{ number_format(excelRoundDown($data->ground_area)) }} {{ trans('attributes.common.round_square_meters') }} </td>
                                    <td class="border-bottom-0 text-right check-floor-area">{{ getValueByListLimited($data->real_estate_type_id, $data->total_area_floors) }}</td>
                                    <td class="border-bottom-0 text-center check-completion-year">{{ !empty($data->construction_time) ? getDecade($data->construction_time) . ' ' . trans('attributes.common.decade') : "" }}</td>
                                    <td class="border-bottom-0 text-left check-land-rights">{{ $data->landRight['name'] ?? "ー" }}</td>
                                    <td class="border-bottom-0 text-left check-building-rights">{{ $data->buildingRight['name'] ?? "ー" }}</td>
                                    <td class="border-bottom-0 check-area-may-rent">{{ getValueByListLimited($data->real_estate_type_id, $data->area_may_rent) }}</td>
                                    <td class="border-bottom-0">{{ division($data->area_may_rent, $data->total_area_floors) }} {{ trans('attributes.common.percent') }}</td>
                                    <td class="border-bottom-0">{{ number_format($data->rental_percentage, 2) }} {{ trans('attributes.common.percent') }}</td>
                                    <td class="border-bottom-0 text-right">{{ numberFormatWithUnit(divisionNumber($data->revenue_room_rentals / FLAG_MAX_MONTH, $data->total_area_floors * 0.3025), ' ' . trans('attributes.common.unit-3')) }}</td>
                                    <td class="border-bottom-0 text-right">{{ numberFormatWithUnit(divisionNumber($data->total_revenue, $data->total_area_floors), ' ' . trans('attributes.common.unit-4')) }}</td>
                                    <td class="border-bottom-0 text-right">{{ numberFormatWithUnit(divisionNumber($data->maintenance_management_fee, $data->total_area_floors) / FLAG_TWELVE, ' ' . trans('attributes.common.unit-4')) }}</td>
                                    <td class="border-bottom-0 text-right">{{ numberFormatWithUnit(divisionNumber($data->repair_fee, $data->total_area_floors), ' ' . trans('attributes.common.unit-4')) }}</td>
                                    <td class="border-bottom-0 text-right">{{ numberFormatWithUnit(divisionNumber($data->loss_insurance, $data->total_area_floors), ' ' . trans('attributes.common.unit-4')) }}</td>
                                    <td class="border-bottom-0 text-right">{{ numberFormatWithUnit(divisionNumber($data->total_cost, $data->total_area_floors), ' ' . trans('attributes.common.unit-4')) }}</td>
                                    <td class="border-bottom-0">{{ numberFormatWithUnit(divisionNumber($data->total_cost * 100, $data->total_revenue), ' ' . trans('attributes.common.percent'), FLAG_TWO) }}</td>
                                    <td class="border-bottom-0 border-right-0 text-right">{{ numberFormatWithUnit(divisionNumber($data->total_revenue - $data->total_cost, $data->total_area_floors), ' ' . trans('attributes.common.unit-4')) }}</td>
                                </tr>
                            @empty
                                <tr class="table">
                                    <td class="text-left" colspan="24" >{{trans('attributes.search_bank.list.no_data')}}</td>
                                </tr>
                            @endforelse

                        </table>
                    </div>
                </div>
            </div>


            <div class="compete-chart row m0 balance-body m30t">
                <div class="col-12 col-xl-4 m30b p15lr">
                    <div class="diagram-block">
                        <div id="container-1"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 m30b p15lr">
                    <div class="diagram-block">
                        <div id="container-2"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 m30b p15lr">
                    <div class="diagram-block">
                        <div id="container-3"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 m30b p15lr">
                    <div class="diagram-block">
                        <div id="container-4"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 m30b p15lr">
                    <div class="diagram-block">
                        <div id="container-5"></div>
                    </div>
                </div>
                <div class="col-12 col-xl-4 m30b p15lr">
                    <div class="diagram-block">
                        <div id="container-6"></div>
                    </div>
                </div>
            </div>

            <div class="d-flex col-12 text-center text-lg-right m0 p15lr">
                <div class="w-auto text-center text-md-right m0 p0">
                    <a href="{{ buttonBackPages($params) }}" class="btn custom-btn-default fs15 sort-property m0 p18l p18r w-auto">{{ __('attributes.essential_confirm.header.btn_back') }}</a>
                </div>
            </div>
        </div>
    </div>

    <!--0319 add-->
    <div class="modal fade myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-lg">
            <form class="form-search-bank" action="{{ route(USER_PROPERTY_LIST_SEARCH) }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('attributes.search_bank.list.title_change_condition') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="p30">
                            <div class="row m-0 p0">
                                <div class="m30r p0 d-flex align-items-center">
                                    <span class="d-inline-block fs14">{{ __('attributes.search_bank.select_title') }}</span>
                                </div>
                                <div class="w-70 col-12-sp p0">
                                    <div class="w-auto m20r">
                                        <div class="btn wrap-input-option w230 p0 br4">
                                            <select name="real_estate_type_search" class="extraction option-paginate-1 btn form-control hp100 p3 p15r p15l fs14">
                                                @foreach(REAL_ESTATE_TYPE_SEARCH as $key => $item)
                                                    <option class="m20r m20l" value="{{ $key }}"
                                                        @if($key == $itemSearch[FLAG_ZERO])
                                                        {{ 'selected' }}
                                                        @endif
                                                    >{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @include('backend.property.search.conditions')

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="bank-search btn custom-btn-primary fs15 sort-property m0 p18l p18r w-auto">{{ __('attributes.search_bank.search') }}</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!--0319 add-->

@endsection
@section('js')
    <script src="{{ asset('js/highcharts/modules/no-data-to-display.js') }}"></script>
    <script src="{{ asset('dist/js/search.min.js') }}"></script>
    <script type="text/javascript">
        let dataCompeteChart = {!! json_encode($dataCompeteChart) !!};
    </script>
@endsection
