@extends('modal.preview.common_preview')
@section('title', __('attributes.portfolio_analysis.title'))
@section('content_preview')
<div id="pre-print-portfolio" class="background-print">
    <div class="block-page">
        <div class="table-responsive">
        <table id="table-data" class="table table-bordered">
            <thead>
                <tr>
                    <th class="w-2dot3 text-center ">No.</th>
                    <th class="w-5dot2">{{ __('attributes.table_list_house.table_head.td_1') }}</th>
                    <th class="w-4">{{ __('attributes.table_list_house.table_head.td_2') }}</th>
                    <th class="w-4 @if(!in_array($currentUser->role, [BROKER, EXPERT])) d-none @endif">{{ trans('attributes.register_info.item_block.label.proprietor_2') }}</th>
                    <th class="3dot5">{{ __('attributes.table_list_house.table_head.td_3') }}</th>
                    <th class="3dot5">{{ __('attributes.table_list_house.table_head.td_4') }}</th>
                    <th class="w-3dot2">{{ __('attributes.table_list_house.table_head.td_5_1') }}<br>{{ __('attributes.table_list_house.table_head.td_5_2') }}</th>
                    <th class="w-3dot2">{{ __('attributes.table_list_house.table_head.td_new_1_1') }}<br>{{ __('attributes.table_list_house.table_head.td_new_1_2') }}</th>
                    <th class="w-3dot2">{{ __('attributes.table_list_house.table_head.td_new_2_1') }}<br>{{ __('attributes.table_list_house.table_head.td_new_2_2') }}</th>
                    <th class="w-5">{{ __('attributes.table_list_house.table_head.td_6') }}</th>
                    <th class="w-3dot2">{{ __('attributes.table_list_house.table_head.td_7_1') }}<br>{{ __('attributes.table_list_house.table_head.td_7_2') }}</th>
                    <th class="w-3dot2">{{ __('attributes.table_list_house.table_head.td_8') }}</th>
                    <th class="w-3dot2">{{ __('attributes.table_list_house.table_head.td_9') }}</th>
                    <th class="w-3dot2">{{ __('attributes.table_list_house.table_head.td_10') }}</th>
                    <th class="w-3dot2">{{ __('attributes.table_list_house.table_head.td_11_1') }}<br>({{ __('attributes.table_list_house.table_head.td_11_2') }})</th>
                    <th class="w-3dot2">{{ __('attributes.table_list_house.table_head.td_12_1') }}<br>− {{ __('attributes.table_list_house.table_head.td_12_2') }}</th>
                    <th class="w-7dot2">NOI</th>
                    <th class="w-3dot2">{{ __('attributes.table_list_house.table_head.td_14') }}</th>
                    <th class="w-3dot2">{{ __('attributes.table_list_house.table_head.td_15') }}</th>
                    <th class="w-3dot2">{{ __('attributes.table_list_house.table_head.td_16_1') }}ー{{ __('attributes.table_list_house.table_head.td_16_2') }}</th>
                    <th class="w-6">{{ __('attributes.table_list_house.table_head.td_17') }}</th>
                    <th class="w-3dot2">{{ __('attributes.table_list_house.table_head.td_18_1') }}<br>{{ __('attributes.table_list_house.table_head.td_18_2') }}</th>
                    <th class="w-3dot2">{{ __('attributes.table_list_house.table_head.td_19') }}</th>
                    <th class="w-3dot2">{{ __('attributes.table_list_house.table_head.td_20_1') }}<br>（{{ __('attributes.table_list_house.table_head.td_20_2') }}）</th>
                    <th class="w-3dot5">{{ __('attributes.table_list_house.table_head.td_21_1') }}<br>{{ __('attributes.table_list_house.table_head.td_21_2') }}</th>
                    <th class="w-5dot2">{{ __('attributes.table_list_house.table_head.td_23') }}</th>
                    <th class="w-3dot2">{{ __('attributes.table_list_house.table_head.td_24') }}</th>
                    <th class="w-3dot2">{{ __('attributes.table_list_house.table_head.td_25') }}</th>
                </tr>
            </thead>
        </table>
        </div>
    </div>
    <div class="block-page">
        <div id="container-preview" class="text-center"></div>
        <div class="row m13t">
            <div class="col-4">
                <div class="block-diagram-1">
                    <div id="noi-chart-preview" class="p40t"></div>
                </div>
            </div>
            <div class="col-4">
                <div class="block-diagram-1">
                    <div class="centered-vertical">
                        <p class="title-diagram m0 p20b p20t w-100" >{{ __('attributes.portfolio_analysis.chart.title_1') }}</p>
                    </div>
                    <div class="centered-vertical">
                        <div id="parent-chart-room-pre">
                            <div id="pre-chart-room"></div>
                            <div class="legend-chart legend-chart1 row m0 p20l">
                                <div class="margin-auto row col-8 col-lg-8 col-xl-8">
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
                    <div class="fs12 font-weight-bold text-center no-data-chart-room" style="display: none; color:#2C3348;fill:#2C3348; line-height: 200px">{{ trans('attributes.common.no_data') }}</div>
                </div>
            </div>
            <div class="col-4">
                <div class="block-diagram-1">
                    <div class="centered-vertical">
                        <p class="title-diagram m0 p20b p20t w-100" >{{ __('attributes.portfolio_analysis.chart.title_2') }}</p>
                    </div>
                    <div class="centered-vertical">
                        <div id="parent-chart-acreage-pre">
                            <div id="pre-chart-acreage"></div>
                            <div class="legend-chart legend-chart2 row m0 p20l">
                                <div class="margin-auto row col-8 col-lg-8 col-xl-8">
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
                    <div class="fs12 font-weight-bold text-center no-data-chart-acreage" style="display: none; color:#2C3348;fill:#2C3348; line-height: 200px">{{ trans('attributes.common.no_data') }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="block-page">
        <div class="row m0">
            <div class="col-4 block-diagram-2 p15t">
                <div id="container-1-preview"></div>
            </div>
            <div class="col-4 block-diagram-2 p15t">
                <div id="container-2-preview"></div>
            </div>
            <div class="col-4 block-diagram-2 p15t">
                <div id="container-3-preview"></div>
            </div>
            <div class="col-4 block-diagram-2 p15t">
                <div id="container-4-preview"></div>
            </div>
            <div class="col-4 block-diagram-2 p15t">
                <div id="container-5-preview"></div>
            </div>
            <div class="col-4 block-diagram-2 p15t">
                <div id="container-6-preview"></div>
            </div>
            <div class="col-4 block-diagram-2 p15t">
                <div id="container-7-preview"></div>
            </div>
            <div class="col-4 block-diagram-2 p15t">
                <div id="container-8-preview"></div>
            </div>
            <div class="col-4 block-diagram-2 p15t">
                <div id="container-9-preview"></div>
            </div>
        </div>
    </div>
</div>
@endsection
