@extends('layout.home.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/preview/simulation.css') }}">
@endsection

@section('content')
    <div class="container-fluid container-wrapper container-simulation p10b">

        <div class="row row-header mb-4">
            <div class="col-12 col-sm-9 title-content-simulation p0lr-sp">
                <div class="row ">
                    <h3 class="fs28 title-simulation mr-3"> {{__('attributes.simulation.content.title_left') }}</h3>
                    <span class="fs14 text-header-right d-none d-md-block"
                          style="align-self: flex-end">{{__('attributes.simulation.content.title_right') }}</span>
                </div>
            </div>

            <div class="has-error-simulation col-12 col-sm-8 col-xl-8 m10t">
                <span class="text-danger">{{__('attributes.simulation.content.has_error') }}</span>
            </div>

            <div class="col-12 col-sm-3 d-none d-sm-flex double-btn-top" style="align-self: center;">
                <div style="width: 100%" class="text-right simulation-button">
                    @if($currentUser)
                        <input id="email-current-user" value="{{ $currentUser->email }}" type="hidden" readonly>
{{--                        <button type="button"--}}
{{--                                class="btn btn-simulation-header text-white btn-save custom-btn-primary m10t fs15">{{__('attributes.simulation.content.text_btn_save') }}</button>--}}
                        <button type="button"
                                class="btn btn-simulation-header text-white btn-report custom-btn-success m10t m5l fs15">{{__('attributes.simulation.content.text_btn_report') }}</button>
                    @endif
                </div>
            </div>
        </div>

        <form id="form-simulation">
            <input type="hidden" name="synthetic_point">
            <div id="content-simulation" class="">



                <div class="row w-100 item-chart m-0">
                    <div class="col-12 col-md-8 ">
                        <div class="item-block-property item-simulation chart-simulation p25 item-7">
                            <div class="row m-0">
                                <div class="col-12 col-xl-6 p0l m10b p0r">
                                    <p class="fs16 fw-bold m0 color-title-chart">{{__('attributes.simulation.content.result_simulation.title') }}
                                        <i class="question-icon far fa-question-circle" aria-hidden="true"></i></p>
                                </div>
                                <div class="col-12 col-xl-6 p0l m10b p0r fs14 option-chart">
                                    <div class="row m-0">
                                        <div class="display-scroll col-5 p0 btn-group fs14">
                                            <button type="button" class="btn dropdown-toggle btn-display-scroll" data-toggle="dropdown">
                                                    <span class="text-center fs14 text-display-chart">{{__('attributes.simulation.content.result_simulation.display_scroll') }}</span>
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item pointer btn-flow-over">{{__('attributes.simulation.content.result_simulation.display_scroll') }}</a>
                                                    <a class="dropdown-item pointer btn-paginate">{{__('attributes.simulation.content.result_simulation.action_2') }}</a>
                                                    <a class="dropdown-item pointer btn-zoom-chart">{{__('attributes.simulation.content.result_simulation.action_3') }}</a>
                                                </div>
                                            </div>
                                            <div class="pagination-simulation col-7 p0r p20l p0r m-0">
                                                <nav aria-label="Page navigation">
                                                    <ul class="pagination pg-simulation keep-all m-0 pointer" style="float: right">
                                                        <li class="page-item">
                                                            <a class="page-link page-link-item text-body pagination-active p10l p10r" data-id="1">1{{__('attributes.simulation.content.result_simulation.page') }}</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a class="page-link page-link-item text-body p10l p10r" data-id="2">2{{__('attributes.simulation.content.result_simulation.page') }}</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a class="page-link page-link-item text-body p10l p10r" data-id="3">3{{__('attributes.simulation.content.result_simulation.page') }}</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a class="page-link page-link-item text-body p10l p10r" data-id="5">5{{__('attributes.simulation.content.result_simulation.page') }}</a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-chart m25t p25r p10b p5l">
                                    <div id="chart-simulation-in-simulation" class="chart-simulation-in-simulation h430"></div>
                                    <div class="cus-paginate text-center m5b" id="pagination" hidden="true">
                                        <button type="button" class="border-0 w35 h40 p0 btn custom-btn-default btn-before" disabled>
                                            <i class="icon-paginate fa fa-angle-left" aria-hidden="true"></i>
                                        </button>
                                        <span class="d-inline-block p10l p10r"><span class="start-paginate"></span>/<span class="total-paginate"></span></span>
                                        <button type="button" class="border-0 w35 h40 p0 btn custom-btn-default btn-after" disabled>
                                            <i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <p class="highcharts-des fs8 highcharts-note" style="display: none">
                                        {{ __('attributes.simulation_charts.note_1') }}<br/>
                                        {{ __('attributes.simulation_charts.note_2') }}
                                    </p>
                                </div>
                            </div>
                    </div>
                    <div class="col-12 col-md-4 item-score">

                        <div class="item-radar">
                            <div class="item-block-property item-point-simulation item-simulation item-col-right item-6">
                                <div class="header-card6">
                                    <div class="header-card6-left p25 p10r">
                                        <p class="fs16 fw-bold m0 color-title-chart">SCOREMAP
                                            <i class="question-icon far fa-question-circle" aria-hidden="true"></i>
                                        </p>
                                    </div>
                                    <div class="header-card6-right p25r fw-bold">
                                        <div class="sum-points text-white text-center">
                                            <div class="fs13 fw-bold p05-rem-top">CYARea!スコア<br>(収支総合評価)</div>
                                            <div id="synthetic-point" class="fs36 fw-bold">0<span class="fs18 fw-bold">points</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="simulation-spiderweb" class="h292"></div>
                            </div>
                        </div>
                    </div>
                </div>


	            <div class="row m-0 mt-3 w-100">

	                <div class="col-12 col-xl-4 block-1 a">
	                    <div class="item-block-property item-simulation p25 fs14 item-1">
	                        <div class="row m0">
	                            <div class="col-11 p0l m10b">
	                                <p class="fs16 fw-bold m0">{{__('attributes.simulation.content.physical_info.title') }}<i class="question-icon far fa-question-circle"
	                                                                  aria-hidden="true"></i></p>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-12 col-md-5 p0l d-flex align-items-center">
	                                <span class="d-inline-block">{{__('attributes.simulation.content.physical_info.name') }}</span>
	                            </div>
	                            <div class="col-12 col-md-7 p0lr-sp">
	                                <input type="text" name="name" class="form-control m5t m5b input-simulation fs14">
	                                <span class="text-red error-simulation error_name m0"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-12 col-md-5 p0l d-flex align-items-center">
	                                <span class="d-inline-block">{{__('attributes.simulation.content.physical_info.zipcode') }}</span>
	                            </div>
	                            <div class="col-12 col-md-7 p0lr-sp">
	                                <input type="text" name="zipcode" class="form-control m5t m5b input-simulation fs14 zip-code">
	                                <span class="text-red error-simulation error_zipcode"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 space-between">
	                            <div class="col-5 col-md-12 row m-0 p0l p0r p5t">
	                                <div class="col-12 col-md-5 p0l d-flex align-items-center">
	                                    <span class="d-inline-block">{{__('attributes.simulation.content.physical_info.province') }}</span>
	                                </div>
	                                <div class="col-12 col-md-7 p0lr-sp">
	                                    <select name="province" class="form-control m5t m5b input-simulation fs14 province" id="provinces">
	                                        <option value="">---</option>
	                                        @foreach($prefectures as $key => $prefecture)
	                                            <option value="{{ $prefecture }}" class="province-{{ $key }}" data-id="{{ $key }}">{{ $prefecture }}</option>
	                                        @endforeach
	                                    </select>
	                                    <span class="text-red error-simulation error_province"></span>
	                                </div>
	                            </div>
	                            <div class="col-5 col-md-12 row m-0 p0l p0r p5t">
	                                <div class="col-12 col-md-5 p0l d-flex align-items-center">
	                                    <span class="d-inline-block">{{__('attributes.simulation.content.physical_info.address') }}</span>
	                                </div>
	                                <div class="col-12 col-md-7 p0lr-sp">
	                                    @foreach($districts as $key => $district)
	                                        <input type="hidden" class="address-{{ (int)substr($key, FLAG_ZERO, FLAG_TWO) }}"
	                                               value="{{ $district }}" data-name="{{ $district }}">
	                                    @endforeach
	                                    <select name="address" class="form-control m5t m5b input-simulation fs14 address">
	                                        <option value="">---</option>
	                                    </select>
	                                    <span class="text-red error-simulation error_address"></span>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-12 col-md-5 p0l d-flex align-items-center">
	                                <span class="d-inline-block">{{__('attributes.simulation.content.physical_info.uses') }}</span>
	                            </div>
	                            <div class="col-12 col-md-7 p0lr-sp">
	                                <select id="uses" class="form-control m5t m5b input-simulation fs14" name="uses">
	                                    <option value="">---</option>
	                                    @foreach($listRealEstateType as $realEstateType)
	                                        <option value="{{ $realEstateType['id'] }}">{{ $realEstateType['name'] }}</option>
	                                    @endforeach
	                                </select>
	                                <span class="text-red error-simulation error_uses"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-12 col-md-5 p0l d-flex align-items-center">
	                                <span class="d-inline-block">{{__('attributes.simulation.content.physical_info.date_of_construction') }}</span>
	                            </div>
	                            <div class="col-12 col-md-7 p0lr-sp">
	                                <input type="text" class="form-control m5t m5b input-simulation fs14 date-time text-center" name="construction_time">
	                                <span class="text-red error-simulation error_construction_time"></span>
	                            </div>
	                        </div>
	                       <div class="row m-0">
	                           <div class="col-6 col-md-12 row m-0 p0l p0r p5t">
	                               <div class="col-12 col-md-5 p0l d-flex align-items-center">
	                                   <span class="d-inline-block">{{__('attributes.simulation.content.physical_info.ground_area') }}</span>
	                               </div>
	                               <div class="col-12 col-md-7 p0r">
	                                   <div class="row">
	                                       <div class="col-7 p0lr-sp">
	                                           <input type="text" name="ground_area" value="0.00" class="form-control m5t m5b input-simulation fs14 convert-number-double-decimal text-right">
	                                       </div>
	                                       <div class="col-5 p0r text-center-in-div">
	                                           {{__('attributes.common.square_meters') }}
	                                       </div>
	                                   </div>
	                                   <span class="text-red error-simulation error_ground_area"></span>
	                               </div>
	                           </div>
	                           <div class="col-6 col-md-12 row m-0 p0l p0r p5t">
	                               <div class="col-12 col-md-5 p0l d-flex align-items-center">
	                                   <span class="d-inline-block">{{__('attributes.simulation.content.physical_info.total_floor_area') }}</span>
	                               </div>
	                               <div class="col-12 col-md-7 p0r">
	                                   <div class="row">
	                                       <div class="col-7 p0lr-sp">
	                                           <input type="text" name="total_area_floors" value="0.00" class="form-control m5t m5b input-simulation fs14 convert-number-double-decimal text-right">
	                                       </div>
	                                       <div class="col-5 p0r text-center-in-div">
	                                           {{__('attributes.common.square_meters') }}
	                                       </div>
	                                   </div>
	                                   <span class="text-red error-simulation error_total_area_floors"></span>
	                               </div>
	                           </div>
	                       </div>
	                    </div>

	                    <div class="item-total mt-3">
	                        <div class="item-block-property item-simulation item-col-right p25  fs14 item-5">
	                            <div class="row m0">
	                                <div class="col-11 p0l m10b">
	                                    <p class="fs16 fw-bold m0">{{__('attributes.simulation.content.investment_conditions.title') }}
	                                        <i class="question-icon far fa-question-circle" aria-hidden="true"></i></p>
	                                </div>
	                            </div>
	                            <div class="row m-0 p5t">
	                                <div class="col-5 p0l d-flex align-items-center">
	                                    <span class="d-inline-block">{{__('attributes.simulation.content.investment_conditions.house_price') }}</span>
	                                </div>
	                                <div class="col-7 p0r">
	                                    <div class="row">
	                                        <div class="col-10">
	                                            <input type="text" name="house_price" class="form-control m5t m5b input-simulation fs14 text-right convert-data d-inline-block" value="0">
	                                        </div>
	                                        <div class="col-2 centered text-flex-start">
	                                            <span class="fs14">{{__('attributes.common.yen') }}</span>
	                                        </div>
	                                    </div>
	                                <span class="text-red error-simulation error_house_price"></span>
	                                </div>
	                            </div>
	                            <div class="row m-0 p5t">
	                                <div class="col-5 p0l d-flex align-items-center">
	                                    <span class="d-inline-block">{{__('attributes.simulation.content.investment_conditions.personal_money_spent') }}</span>
	                                </div>
	                                <div class="col-7 p0r">
	                                    <div class="row">
	                                        <div class="col-10">
	                                            <input type="text" name="personal_money_spent" class="form-control m5t m5b input-simulation fs14 text-right convert-data d-inline-block" value="0">
	                                        </div>
	                                        <div class="col-2 centered text-flex-start">
	                                            <span class="fs14">{{__('attributes.common.yen') }}</span>
	                                        </div>
	                                    </div>
	                                    <span class="text-red error-simulation error_personal_money_spent"></span>
	                                </div>
	                            </div>
	                            <div class="row m-0 p5t">
	                                <div class="col-5 p0l d-flex align-items-center">
	                                    <span class="d-inline-block">{{__('attributes.simulation.content.investment_conditions.loan') }}</span>
	                                </div>
	                                <div class="col-7 p0r">
	                                    <div class="row">
	                                        <div class="col-10">
	                                            <input type="text" name="loan" class="convert-data disable-field fw-bold form-control m5t m5b input-simulation text-right fs18 d-inline-block balance-no-border-radius" id="loan" readonly value="0">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row m-0 p5t">
	                                <div class="col-5 p0l d-flex align-items-center">
	                                    <span class="d-inline-block">{{__('attributes.simulation.content.investment_conditions.interest') }}</span>
	                                </div>
	                                <div class="col-7 p0r">
	                                    <div class="row">
	                                        <div class="col-10">
	                                            <input type="text" name="interest" value="0.00" class="form-control m5t m5b input-simulation fs14 text-right convert-number-double-decimal d-inline-block">
	                                        </div>
	                                        <div class="col-2 centered text-flex-start">
	                                            <span class="fs14">%</span>
	                                        </div>
	                                    </div>
	                                    <span class="text-red error-simulation error_interest"></span>
	                                </div>
	                            </div>
	                            <div class="row m-0 p5t">
	                                <div class="col-5 p0l d-flex align-items-center">
	                                    <span class="d-inline-block">{{__('attributes.simulation.content.investment_conditions.year') }}</span>
	                                </div>
	                                <div class="col-7 p0r">
	                                    <div class="row">
	                                        <div class="col-10 centered">
	                                            <select class="form-control m5t m5b text-right input-simulation fs14 d-inline-block" name="year">
	                                                @for ($yyyy=1; $yyyy<=35; $yyyy++)
	                                                    @if ($yyyy==20)
	                                                        <option value="{{$yyyy}}" selected>{{$yyyy}}</option>
	                                                    @else
	                                                        <option value="{{$yyyy}}">{{$yyyy}}</option>
	                                                    @endif
	                                                @endfor
	                                            </select>
	                                            <span class="text-red error-simulation error_year"></span>
	                                        </div>
	                                        <div class="col-2 centered text-flex-start">
	                                            <span class="fs14">{{__('attributes.common.year') }}</span>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="row m-0 p5t">
	                                <div class="col-5 p0l d-flex align-items-center">
	                                    <span class="d-inline-block">{{__('attributes.simulation.content.investment_conditions.loan_per_year_1') }}
	                                        <br/>{{__('attributes.simulation.content.investment_conditions.loan_per_year_2') }}</span>
	                                </div>
	                                <div class="col-7 p0r">
	                                    <div class="row">
	                                        <div class="col-10">
	                                            <input type="text" name="loan_per_year" readonly value="0" class="convert-data disable-field fw-bold form-control m5t m5b input-simulation text-right fs18 d-inline-block balance-no-border-radius">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	
	                        <div class="row d-flex d-md-none  row-btn-review item-col-right text-white display-center">
	                            <button class="btn btn-review display-center text-center text-white custom-btn-primary fs15 text-center m15b" type="button">
	                                {{__('attributes.simulation.content.text_btn_review') }}
	                            </button>
	                        </div>
	                    </div>

	                </div>

	                <div class="col-12 col-xl-4 block-1 b">
	                    <div class="item-block-property item-simulation  p25 fs14 item-2">
	                        <div class="row m0">
	                            <div class="col-11 p0l m10b">
	                                <p class="fs16 fw-bold m0">{{__('attributes.simulation.content.operating_revenue.title') }}
	                                    <i class="question-icon far fa-question-circle"
	                                                                  aria-hidden="true"></i></p>
	                            </div>
	                            <div class="col-1 p0l d-flex align-items-end justify-content-end p0r">
	                                <p class="fs12 m0">({{__('attributes.common.yen') }})</p>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">0</span>
	                                <span class="d-inline-block">{{ __('attributes.register_info.item_block.label.rent_income') }}<br>
	                                        {{ __('attributes.register_info.item_block.label.rent_income_1') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="revenue_land_taxes" class="form-control m5t m5b input-simulation fs14 text-right operating-revenue convert-data" value="0" readonly>
	                                <span class="text-red error-simulation error_revenue_land_taxes"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">1</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_revenue.number') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="revenue_room_rentals" class="form-control m5t m5b input-simulation fs14 text-right operating-revenue convert-data" value="0">
	                                <span class="text-red error-simulation error_revenue_room_rentals"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">2</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_revenue.general_services') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="revenue_general_services" class="form-control m5t m5b input-simulation fs14 text-right operating-revenue convert-data" value="0">
	                                <span class="text-red error-simulation error_revenue_general_services"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">3</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_revenue.utilities') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="revenue_utilities" class="form-control m5t m5b input-simulation fs14 text-right operating-revenue convert-data" value="0">
	                                <span class="text-red error-simulation error_revenue_utilities"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">4</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_revenue.parking') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="revenue_parking" class="form-control m5t m5b input-simulation fs14 text-right operating-revenue convert-data" value="0">
	                                <span class="text-red error-simulation error_revenue_parking"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">5</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_revenue.income_input_money') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="income_input_money" class="form-control m5t m5b input-simulation fs14 text-right operating-revenue convert-data" value="0">
	                                <span class="text-red error-simulation error_income_input_money"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">6</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_revenue.income_update_house_contract') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="income_update_house_contract" class="form-control m5t m5b input-simulation fs14 text-right operating-revenue convert-data" value="0">
	                                <span class="text-red error-simulation error_income_update_house_contract"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">7</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_revenue.other') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="other_revenue" class="form-control m5t m5b input-simulation fs14 text-right operating-revenue convert-data" value="0">
	                                <span class="text-red error-simulation error_other_revenue"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">8</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_revenue.bad_debt') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="bad_debt" class="form-control m5t m5b input-simulation fs14 text-right operating-revenue convert-data" value="0">
	                                <span class="text-red error-simulation error_bad_debt"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">9</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_revenue.sum') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="total_revenue" readonly value="0"
	                                       class="convert-data disable-field form-control m5t m5b fw-bold input-simulation text-right fs18 balance-no-border-radius">
	                                <p class="error-message m0"></p>
	                            </div>
	                        </div>
	                    </div>
	                </div>

	                <div class="col-12 col-xl-4 block-1 c">

	                    <div class="item-block-property item-simulation  p25 fs14 item-3">
	                        <div class="row m0">
	                            <div class="col-11 p0l m10b">
	                                <p class="fs16 fw-bold m0">{{__('attributes.simulation.content.operating_fee.title') }}
	                                    <i class="question-icon far fa-question-circle"
	                                                                  aria-hidden="true"></i></p>
	                            </div>
	                            <div class="col-1 p0l d-flex align-items-end justify-content-end p0r">
	                                <p class="fs12 m0">({{__('attributes.common.yen') }})</p>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">10</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_fee.maintenance_management') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="maintenance_management_fee" class="form-control m5t m5b input-simulation fs14 text-right operating-fee convert-data" value="0">
	                                <span class="text-red error-simulation error_maintenance_management_fee"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">11</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_fee.utilities') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="fee_utilities" class="form-control m5t m5b input-simulation fs14 text-right operating-fee convert-data" value="0">
	                                <span class="text-red error-simulation error_fee_utilities"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">12</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_fee.repair') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="repair_fee" class="form-control m5t m5b input-simulation fs14 text-right operating-fee convert-data" value="0">
	                                <span class="text-red error-simulation error_repair_fee"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">13</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_fee.intact_reply') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="fee_intact_reply" class="form-control m5t m5b input-simulation fs14 text-right operating-fee convert-data" value="0">
	                                <span class="text-red error-simulation error_fee_intact_reply"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">14</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_fee.property_management') }}
	                                    <br>{{__('attributes.simulation.content.operating_fee.property_management_1') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="fee_property_management" class="form-control m5t m5b input-simulation fs14 text-right operating-fee convert-data" value="0">
	                                <span class="text-red error-simulation error_fee_property_management"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">15</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_fee.recruitment_rental') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="fee_recruitment_rental" class="form-control m5t m5b input-simulation fs14 text-right operating-fee convert-data" value="0">
	                                <span class="text-red error-simulation error_fee_recruitment_rental"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">16</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_fee.tax') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="tax" class="form-control m5t m5b input-simulation fs14 text-right operating-fee convert-data" value="0">
	                                <span class="text-red error-simulation error_tax"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">17</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_fee.damage_insurance') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="loss_insurance" class="form-control m5t m5b input-simulation fs14 text-right operating-fee convert-data" value="0">
	                                <span class="text-red error-simulation error_loss_insurance"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">18</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_fee.land_tax') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="land_tax" class="form-control m5t m5b input-simulation fs14 text-right operating-fee convert-data" value="0">
	                                <span class="text-red error-simulation error_land_tax"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">19</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_fee.other') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="other_fees" class="form-control m5t m5b input-simulation fs14 text-right operating-fee convert-data" value="0">
	                                <span class="text-red error-simulation error_other_fees"></span>
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">20</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.operating_fee.sum') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="total_cost" readonly value="0"
	                                       class="convert-data disable-field form-control m5t m5b fw-bold input-simulation text-right fs18 balance-no-border-radius">
	                            </div>
	                        </div>
	                    </div>

	                    <div class="item-block-property item-simulation mt-3  p25 fs14 item-4">
	                        <div class="row m-0">
	                            <div class="col-5 p0 d-flex align-items-center">
	                                <div class="row m-0">
	                                    <span class="number-li">21</span>
	                                    <span class="d-inline-block">{{__('attributes.simulation.content.operating_total') }}</span>
	                                    <span class="d-flex align-items-center m10l">(<span
	                                            class="number-li m5r m5l">9</span>-<span class="number-li m5r m5l">20</span>)</span>
	                                </div>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input name="operating_expenses" readonly value="0" type="text"
	                                       class="disable-field form-control m5t m5b fw-bold input-simulation text-right fs18 balance-no-border-radius convert-data d-none" id="total_revenue_expenditure_operation">
	                                <input type="text" readonly value="0 円"
	                                       class="disable-field form-control m5t m5b fw-bold input-simulation text-right fs18 balance-no-border-radius" id="total_show">
	                            </div>
	                        </div>
	                        <div class="row m-0 p5t">
	                            <div class="col-5 p0l d-flex align-items-center">
	                                <span class="number-li">22</span>
	                                <span class="d-inline-block">{{__('attributes.simulation.content.net_income') }}</span>
	                            </div>
	                            <div class="col-7 p0r">
	                                <input type="text" name="net_income" readonly value="0.00 %"
	                                       class="disable-field form-control m5t m5b fw-bold input-simulation text-right fs18 balance-no-border-radius">
	                            </div>
	                        </div>
	                    </div>

	                </div>

		            
		            
	            </div>

	            <div class="row m-0 mt-3 w-100">

	                <div class="col-12 p0 block-2">
	
	                    <div class="row display-center m-0 item-button d-none d-sm-block">
	                        <div class="row-chart display-center m40t m35t-sp">
	                            @if($currentUser)
	{{--                                <div class="result-chart text-center m0b-sp">--}}
	{{--                                    <button type="button" class="btn btn-result-chart text-white btn-save custom-btn-primary fs15">--}}
	{{--                                        <span class="fs15w700 text-btn-save">{{__('attributes.simulation.content.text_btn_result_chart') }}</span>--}}
	{{--                                    </button>--}}
	{{--                                </div>--}}
	                                <div class="report-chart">
	                                    <button type="button" class="btn btn-export-chart text-white btn-report custom-btn-success m15l d-none d-sm-block fs15">
	                                        <span class="fs15w700 text-btn-report">{{__('attributes.simulation.content.text_btn_report_chart') }}</span>
	                                    </button>
	                                </div>
	                            @endif
	                        </div>
	                    </div>
	                </div>

	            </div>




            </div>
        </form>
    </div>


	<div class="toast" id="myToast">
	  <div class="toast-header">
	    <span class="mr-auto"><i class="fas fa-chart-bar"></i> シミュレーション結果に反映されました</span>
	    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">
	      <span aria-hidden="true">&times;</span>
	    </button>
	  </div>
	</div>
	<style>
		#myToast {
			position: fixed;
			bottom: 30px;
			right: 30px;
		}
		#myToast .toast-header{
			background-color : #1d5995;
			color : #fff;
			padding : 20px;
		}
		#myToast .toast-header .close{
			color : #fff;
			text-shadow: 0 1px 0 #000;
		}
	</style>


    @include('modal.simulation')
    @include('modal.preview.simulation_preview')
    <div class="modal fade" id="alert-print" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content br8">
                <div class="modal-header fs16">
                    {{ __('attributes.simulation.content.alert_print') }}
                    <button type="button" class="close close-modal-block" data-dismiss="modal">×</button>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn custom-btn-success" data-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/highcharts/exporting.js')}}"></script>
    <script src="{{ asset('js/highcharts/highcharts-regression.js')}}"></script>
    <script src="{{ asset('js/regression/regression.js') }}"></script>
    <script src="{{ asset('dist/js/simulation.min.js') }}"></script>
    <script src="{{ asset('js/highcharts/modules/no-data-to-display.js') }}"></script>
@endsection
