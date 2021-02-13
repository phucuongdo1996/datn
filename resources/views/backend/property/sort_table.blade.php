@extends('layout.home.master')

@section('content')
    <div class="container-fluid container-wrapper container-sort-table">
        <div class="row title-sort-table m0 p0 media-575-p20l media-575-p20r m0lr-sp">
            <div class="col-9 fs28 p0">{{ __('attributes.sort_table.title') }}</div>
            <div class="col-3 fs14 p0 div-save-sort-block d-none d-md-block">
                <button type="button" class="text-white btn-save-sort custom-btn-primary fs15 fs14-sp">{{ __('attributes.sort_table.btn-save') }}</button>
            </div>
        </div>
        @include('partials.flash_messages')
        <div class="row m0 m30t m30b br10 bg-white">
            <div class="table-responsive fs14 portfolio-table">
                <table id="table-sort" class="table table-bordered table-striped table-sort border-0 m0">
                    <tr class="table-head">
                        <td class="border-0">
                            <div class="centered-vertical">
                                <span>No.</span>
                            </div>
                        </td>
                        <td class="border-top-0 p120r">
                            <div class="centered-vertical">
                                <span>{{ __('attributes.table_list_house.table_head.td_1') }}</span>
                            </div>
                        </td>
                        <td class="border-top-0">
                            <div class="centered-vertical">
                                <span>{{ __('attributes.table_list_house.table_head.td_2_sort') }}</span>
                                <span class="sort-icon"></span>
                            </div>
                        </td>
                        <td class="border-top-0">
                            <div class="centered-vertical">
                                <span>{{ __('attributes.table_list_house.table_head.td_2') }}</span>
                            </div>
                        </td>
                        <td class="border-top-0 p0t vertical-base">
                            <span class="number-li m10b">1</span>
                            <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_3') }}</p>
                                    </span>
                            </div>
                            <span class="fs11">(㎡)</span>
                        </td>
                        <td class="border-top-0 p0t vertical-base">
                            <span class="number-li m10b">2</span>
                            <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_4') }}</p>
                                    </span>
                            </div>
                            <span class="fs11">(円/m²)</span>
                        </td>
                        <td class="border-top-0 p0t vertical-base">
                            <div class="centered-vertical m10b">
                                <span class="centered-vertical fs10 fw-normal">(<span
                                        class="number-li li-small">1</span>x<span
                                        class="number-li li-small">2</span>)</span>
                            </div>
                            <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_5_1') }}<br><span>{{ __('attributes.table_list_house.table_head.td_5_2') }}</span><br><span
                                                class="fs11">(円)</span>
                                        </p>
                                    </span>
                            </div>
                        </td>
                        <td class="border-top-0">
                            <div class="centered-vertical">
                                <p class="m0">{{ __('attributes.table_list_house.table_head.td_new_1_1') }}<br><span>{{ __('attributes.table_list_house.table_head.td_new_1_2') }}</span><br><span class="fs11">(円)</span></p>
                            </div>
                        </td>
                        <td class="border-top-0 p0t vertical-base">
                            <div class="centered-vertical m10b">
                                <span class="number-li m0b m3r">3</span>
                            </div>
                            <div class="centered-vertical">
                                <p class="m0">{{ __('attributes.table_list_house.table_head.td_new_2_1') }}<br><span>{{ __('attributes.table_list_house.table_head.td_new_2_2') }}</span><br><span class="fs11">(円)</span></p>
                            </div>
                        </td>
                        <td class="border-top-0">
                            <div class="centered-vertical">
                                <span>{{ __('attributes.table_list_house.table_head.td_6') }}</span>
                            </div>
                        </td>
                        <td class="border-top-0 p0t vertical-base">
                            <div class="centered-vertical m10b">
                                <span class="number-li m0b m3r">4</span>
                            </div>
                            <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_7_1') }}<br><span>{{ __('attributes.table_list_house.table_head.td_7_2') }}</span><br><span
                                                class="fs11">({{ __('attributes.common.yen') }})</span></p>
                                    </span>
                            </div>
                        </td>
                        <td class="border-top-0">
                            <div class="centered-vertical">
                                <span>{{ __('attributes.table_list_house.table_head.td_8') }}</span>
                            </div>
                        </td>
                        <td class="border-top-0 p0t vertical-base">
                            <div class="centered-vertical m25b">
                                <span class="number-li m0b m3r">5</span>
                            </div>
                            <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_9') }}</p>
                                    </span>
                            </div>
                        </td>
                        <td class="border-top-0 p0t vertical-base">
                            <div class="centered-vertical m10b">
                                <span class="number-li m0b m3r">6</span>
                                <span class="centered-vertical fs10 fw-normal">(<span
                                        class="number-li li-small">3</span>+<span
                                        class="number-li li-small">4</span>x<span
                                        class="number-li li-small">5</span>)</span>
                            </div>
                            <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_10') }}</p>
                                    </span>
                            </div>
                            <span class="fs11">({{ __('attributes.common.yen') }})</span>
                        </td>
                        <td class="border-top-0">
                            <div class="centered-vertical">
                                <span>{{ __('attributes.table_list_house.table_head.td_11_1') }}</span>
                            </div>
                            <span>({{ __('attributes.table_list_house.table_head.td_11_2') }})</span><br>
                            <span class="fs11">({{ __('attributes.common.yen') }})</span>
                        </td>
                        <td class="border-top-0">
                            <div class="centered-vertical">
                                <span>{{ __('attributes.table_list_house.table_head.td_12_1') }}</span>
                            </div>
                            <span>− {{ __('attributes.table_list_house.table_head.td_12_2') }}</span><br>
                            <span class="fs11">({{ __('attributes.common.yen') }})</span>
                        </td>
                        <td class="border-top-0 p0t p60r vertical-base">
                            <span class="number-li m10b">7</span>
                            <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">NOI</p>
                                    </span>
                            </div>
                            <span class="fs11">({{ __('attributes.common.yen') }})</span>
                        </td>
                        <td class="border-top-0 p0t vertical-base">
                            <span class="number-li m25b">8</span>
                            <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_14') }}</p>
                                    </span>
                            </div>
                        </td>
                        <td class="border-top-0 p0t p60r vertical-base">
                            <div class="centered-vertical m10b">
                                <span class="centered-vertical fs10 fw-normal">(<span
                                        class="number-li li-small">7</span>÷<span
                                        class="number-li li-small">8</span>)</span>
                            </div>
                            <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_15') }}</p>
                                    </span>
                            </div>
                            <span class="fs11">({{ __('attributes.common.yen') }})</span>
                        </td>
                        <td class="border-top-0">
                            <div class="centered-vertical">
                                <p class="m0">{{ __('attributes.table_list_house.table_head.td_16_1') }}</p>
                            </div>
                            <span>− {{ __('attributes.table_list_house.table_head.td_16_2') }}</span><br>
                            <span class="fs11">({{ __('attributes.common.yen') }})</span>
                        </td>
                        <td class="border-top-0 p0t p30r vertical-base">
                            <div class="centered-vertical m10b">
                                <span class="number-li m0b m3r">9</span>
                            </div>
                            <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_17') }}</p>
                                    </span>
                            </div>
                            <span class="fs11">({{ __('attributes.common.yen') }})</span>
                        </td>
                        <td class="border-top-0 p0t vertical-base">
                            <div class="centered-vertical m10b">
                                <span class="number-li m0b m3r">10</span>
                                <span class="centered-vertical fs10 fw-normal">(<span
                                        class="number-li li-small">7</span>/<span
                                        class="number-li li-small">9</span>*100)</span>
                            </div>
                            <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_18_1') }}</p>
                                    </span>
                            </div>
                            <span>{{ __('attributes.table_list_house.table_head.td_18_2') }}</span><br><span
                                class="fs11">({{ __('attributes.common.yen') }})</span>
                        </td>
                        <td class="border-top-0">
                            <div class="centered-vertical">
                                <span>{{ __('attributes.table_list_house.table_head.td_19') }}</span>
                            </div>
                        </td>
                        <td class="border-top-0 p0t vertical-base">
                            <div class="centered-vertical m10b">
                                <span class="number-li m0b m3r">11</span>
                            </div>
                            <div class="centered-vertical">
                                    <span class="centered">
                                        <p class="m0">{{ __('attributes.table_list_house.table_head.td_20_1') }}</p>
                                    </span>
                            </div>
                            <span>（{{ __('attributes.table_list_house.table_head.td_20_2') }}）</span>
                        </td>
                        <td class="border-top-0 p30r">
                            <span>{{ __('attributes.table_list_house.table_head.td_21_1') }}</span><br>
                            <span>{{ __('attributes.table_list_house.table_head.td_21_2') }}</span>
                        </td>
                        <td class="border-top-0 p120r">
                            <span>{{ __('attributes.table_list_house.table_head.td_23') }}</span>
                        </td>
                        <td class="border-top-0 p70r">
                            <span>{{ __('attributes.table_list_house.table_head.td_24') }}</span>
                        </td>
                        <td class="border-top-0 p100r">
                            <span>{{ __('attributes.table_list_house.table_head.td_25') }}</span>
                        </td>
                    </tr>
                    <form id="sort-property" action="">
                        @csrf
                        @foreach($listProperty as $key => $value)
                            @if(!$value['loan'] || !$value['contract_loan_period'] || !$value['loan_date'] || getMonthDifferenceNow($value['loan_date']) == 0)
                                @php($debtBalance = FLAG_ZERO)
                            @else @php($debtBalance=round($value['loan'] - ($value['loan'] * 12 / ($value['contract_loan_period']*getMonthDifferenceNow($value['loan_date']))), FLAG_TWO))
                            @endif
                            <tr class="keep-all" data-order="{{ $value->order }}" data-id="{{ $value->id }}">
                                <td class="border-left-0">
                                    <div class="centered-vertical">
                                        <span>{{ $key + FLAG_ONE }}</span>
                                    </div>
                                </td>
                                <td class="border-top-0 name-color property-code fw-bold sort-tooltip" data-id="{{ $value->property_code}}">
                                    {{ !empty($value->house_name) ? $value->house_name : "" }}
                                </td>
                                <td class="td-sort">
                                    <div class="row">
                                        <div class="col-6 up"><img class="pointer" src="{{ asset('images/sort_up.png') }}"></div>
                                        <div class="col-6 down"><img class="pointer" src="{{ asset('images/sort_down.png') }}"></div>
                                    </div>
                                </td>
                                <td class="border-top-0 sort-tooltip">
                                    {{ $value->status ? STATUS_HOUSE[$value->status] : "" }}
                                </td>
                                <td class="border-top-0 text-right sort-tooltip">
                                    {{ !empty($value->ground_area) ? number_format($value->ground_area, 2) : "0.00" }}
                                </td>
                                <td class="border-top-0 text-right sort-tooltip">
                                    {{ !empty($value->portfolioAnalysis) ? !empty($value->portfolioAnalysis->route_price) ? number_format($value->portfolioAnalysis->route_price) : "0" : "0" }}
                                </td>
                                <td class="border-top-0 text-right sort-tooltip">
                                    {{ !empty($value->portfolioAnalysis) ? !empty($value->portfolioAnalysis->tax_land_price) ? number_format($value->portfolioAnalysis->tax_land_price) : "0" : "0" }}
                                </td>
                                <td class="border-top-0 text-right sort-tooltip">
                                    {{ number_format($value->portfolioAnalysis['land_tax_assessment']) }}
                                </td>
                                <td class="border-top-0 text-right sort-tooltip">
                                    {{ number_format($value->portfolioAnalysis['estimate_inheritance_tax_valuation']) }}
                                </td>
                                <td class="border-top-0 sort-tooltip">
                                    {{ !empty($value->portfolioAnalysis) ? !empty($value->portfolioAnalysis->land_evaluation_note) ? $value->portfolioAnalysis->land_evaluation_note : "ー" : "ー" }}
                                </td>
                                <td class="border-top-0 text-right sort-tooltip">
                                    {{ !empty($value->portfolioAnalysis) ? !empty($value->portfolioAnalysis->tax_valuation) ? number_format($value->portfolioAnalysis->tax_valuation) : "0" : "0" }}
                                </td>
                                <td class="border-top-0 sort-tooltip">
                                    {{ !empty($value->portfolioAnalysis) ? !empty($value->portfolioAnalysis->building_selection) ? $value->portfolioAnalysis->building_selection : "ー" : "ー" }}
                                </td>
                                <td class="border-top-0 sort-tooltip">
                                    {{ !empty($value->portfolioAnalysis) ? !empty($value->portfolioAnalysis->correction_factor) ? $value->portfolioAnalysis->correction_factor : "0" : "0" }}
                                </td>
                                <td class="border-top-0 text-right sort-tooltip">
                                    {{ !empty($value->portfolioAnalysis) ? !empty($value->portfolioAnalysis->inheritance_tax_valuation) ? number_format($value->portfolioAnalysis->inheritance_tax_valuation) : "0" : "0" }}
                                </td>
                                <td class="border-top-0 text-right sort-tooltip">
                                    {{ number_format($debtBalance) }}
                                </td>
                                <td class="border-top-0 text-right sort-tooltip">
                                    {{ !empty($value->portfolioAnalysis) ? !empty($value->portfolioAnalysis->inheritance_tax_debt_balance) ? number_format($value->portfolioAnalysis->inheritance_tax_debt_balance) : "0" : "0" }}
                                </td>
                                <td class="border-top-0 text-right sort-tooltip">
                                    {{ number_format($value->total_revenue - $value->total_cost) ?? "0"}}
                                </td>
                                <td class="border-top-0 sort-tooltip">
                                    {{ !empty($value->portfolioAnalysis) ? !empty($value->portfolioAnalysis->noi_yield) ? $value->portfolioAnalysis->noi_yield . '%' : "0.00%" : "0.00%"}}
                                </td>
                                <td class="border-top-0 text-right sort-tooltip">
                                    {{ !empty($value->portfolioAnalysis) ? !empty($value->portfolioAnalysis->assessed_amount) ? number_format($value->portfolioAnalysis->assessed_amount) : "0" : "0" }}
                                </td>
                                <td class="border-top-0 text-right sort-tooltip">
                                    {{ !empty($value->portfolioAnalysis) ? !empty($value->portfolioAnalysis->assessed_amount_debt_balance) ? number_format($value->portfolioAnalysis->assessed_amount_debt_balance) : "0" : "0" }}
                                </td>
                                <td class="border-top-0 text-right sort-tooltip">
                                    {{ !empty($value->money_receive_house) ? number_format($value->money_receive_house) : "0" }}
                                </td>
                                <td class="border-top-0 sort-tooltip">
                                    {{ division(($value->total_revenue - $value->total_cost), $value->money_receive_house) . '%' }}
                                </td>
                                <td class="border-top-0 sort-tooltip">
                                    {{ !empty($value->rental_percentage) ? $value->rental_percentage.' %' : "" }}
                                </td>
                                <td class="border-top-0 sort-tooltip">
                                    {{ !empty($value->synthetic_point) ?  round($value->synthetic_point) . ' points': "0 points" }}
                                </td>
                                <td class="border-top-0 sort-tooltip">
                                    {{ dateTimeFormatBorrowing($value->date_year_registration_revenue, $value->date_month_registration_revenue) }}
                                </td>
                                <td class="border-top-0 sort-tooltip">
                                    {{ !empty($value->detailRealEstateType) ? !empty($value->detailRealEstateType->realEstateTypes) ? $value->detailRealEstateType->realEstateTypes->name : "" : ""}}
                                </td>
                                <td class="border-top-0 sort-tooltip">
                                    {{ !empty($value->detailRealEstateType) ? $value->detailRealEstateType->name : "" }}
                                </td>
                                <td class="border-right-0 sort-tooltip">
                                    @if($value->address_city){{ $value->address_city}}&ensp;{{$value->address_district}} @else {{ 'ー' }}@endif
                                </td>
                            </tr>
                        @endforeach
                    </form>
                </table>
            </div>
        </div>
        <div class="row m0lr-sp">
            <div class="col-9"></div>
            <div class="col-3 fs14 div-save-sort-block p0lr-sp">
                <button type="button" class="text-white btn-save-sort custom-btn-primary fs15 fs14-sp">{{ __('attributes.sort_table.btn-save') }}</button>
            </div>
        </div>
    </div>
@endsection
