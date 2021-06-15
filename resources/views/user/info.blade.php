@extends('layouts.base')
@section('styles')
@endsection
@section('content')
    @include('layouts.header')
    <div id="mainWrap" class="p80t">
        <div id="main">
            <div id="kvWrap" style="padding-left: 10%; padding-right: 10%; background-color: #f4f6f9">
                <div class="row">
                    <div class="col-3">
                        @include('user.menu')
                    </div>

                    <div class="col-9">
                        <div class="p5l">
                            <div class="row m-0">
                                <div class="col-12 item-block m5r h-100 p15 p20t" style="min-height: 600px">
                                    <div class="row m-0 fs16">
                                        <div class="col-2 d-flex justify-content-center">
                                            <div class="d-flex" style="width: 120px; height: 120px">
                                                <img class="object-fit-cover" style="border-radius: 50%" src="{{ asset(URL_USER_AVATAR . ($currentUser->avatar ?? 'defalut.png')) }}" alt="">
                                            </div>
                                        </div>
                                        <div class="col-10 p20">
                                            <div class="row m0">
                                                <div class="col-3">
                                                    <span class="font-weight-bold">Tên user</span>
                                                </div>
                                                <div class="col-9">
                                                    <span>{{ $currentUser->nick_name }}</span>
                                                </div>
                                            </div>
                                            <div class="row m0 m10t">
                                                <div class="col-3">
                                                    <span class="font-weight-bold">Mã giao dịch</span>
                                                </div>
                                                <div class="col-9">
                                                    <span>{{ strtoupper($currentUser->user_code) }}</span>
                                                </div>
                                            </div>
                                            <div class="row m0 m10t">
                                                <div class="col-3">
                                                    <span class="font-weight-bold">Steam url</span>
                                                </div>
                                                <div class="col-9">
                                                    <div class="" >
                                                        {{ $currentUser->steam_url }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row m20t p20l">
                                        <div class="col-2"></div>
                                        <div class="col-8">
                                            <div class="p10">
                                                <div class="">
                                                    <div class="p10t p10b p20l p20r white-color" style="border-radius: 20px">
                                                        <div class="row m0">
                                                            <div class="col-6 form-control font-weight-bold fs16 d-flex align-items-center">
                                                                Số dư tài khoản:
                                                            </div>
                                                            <div class="col-6 form-control font-weight-bold fs16 d-flex align-items-center">
                                                                <i class="fas fa-coins m10r"></i>{{ number_format($currentUser->money_own) }}
                                                            </div>
                                                        </div>
                                                        <div class="row m0">
                                                            <div class="col-6 form-control font-weight-bold fs16 d-flex align-items-center">
                                                                Tổng tiền đã nạp:
                                                            </div>
                                                            @php($money = $currentUser->userHistory()->where('type', USER_HISTORY_RECHARGE_MONEY)->sum('purchase_money'))
                                                            <div class="col-6 form-control font-weight-bold fs16 d-flex align-items-center">
                                                                <i class="fas fa-coins m10r"></i> {{ number_format($money) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p10">
                                                <div class="">
                                                    <div class="p10t p10b p20l p20r white-color" style="border-radius: 20px">
                                                        <div class="row m0">
                                                            <div class="col-6 form-control font-weight-bold fs16 d-flex align-items-center">
                                                                Số sản phẩm sở hữu:
                                                            </div>
                                                            <div class="col-6 form-control font-weight-bold fs16 d-flex align-items-center text-right">
                                                                {{ $currentUser->products()->count() }}
                                                            </div>
                                                        </div>
                                                        <div class="row m0">
                                                            <div class="col-6 form-control font-weight-bold fs16 d-flex align-items-center">
                                                                Số sản phẩm đang bán:
                                                            </div>
                                                            <div class="col-6 form-control font-weight-bold fs16 d-flex align-items-center">
                                                                {{ $currentUser->marketSeller()->where('status', TRADE_SELLING)->count() }}
                                                            </div>
                                                        </div>
                                                        <div class="row m0">
                                                            <div class="col-6 form-control font-weight-bold fs16 d-flex align-items-center">
                                                                Tổng tiền sản phẩm đang bán:
                                                            </div>
                                                            <div class="col-6 form-control font-weight-bold fs16 d-flex align-items-center">
                                                                <i class="fas fa-coins m10r"></i> {{ number_format($currentUser->marketSeller()->where('status', TRADE_SELLING)->sum('price')) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p10">
                                                <div class="">
                                                    <div class="p10t p10b p20l p20r white-color" style="border-radius: 20px">
                                                        <div class="row m0">
                                                            <div class="col-6 form-control font-weight-bold fs16 d-flex align-items-center">
                                                                Số sản phẩm đã bán:
                                                            </div>
                                                            <div class="col-6 form-control font-weight-bold fs16 d-flex align-items-center">

                                                                {{ $currentUser->marketSeller()->where('status', TRADE_DONE)->count() }}
                                                            </div>
                                                        </div>
                                                        <div class="row m0">
                                                            <div class="col-6 form-control font-weight-bold fs16 d-flex align-items-center">
                                                                Tổng tiền sản phẩm đã bán:
                                                            </div>
                                                            <div class="col-6 form-control font-weight-bold fs16 d-flex align-items-center">
                                                                <i class="fas fa-coins m10r"></i>{{ number_format($currentUser->marketSeller()->where('status', TRADE_DONE)->sum('price')) }}
                                                            </div>
                                                        </div>
                                                        <div class="row m0">
                                                            <div class="col-6 form-control font-weight-bold fs16 d-flex align-items-center">
                                                                Số sản phẩm đã mua:
                                                            </div>
                                                            <div class="col-6 form-control font-weight-bold fs16 d-flex align-items-center">
                                                                {{ number_format($currentUser->marketBuyer()->where('status', TRADE_DONE)->count()) }}
                                                            </div>
                                                        </div>
                                                        <div class="row m0">
                                                            <div class="col-6 form-control font-weight-bold fs16 d-flex align-items-center">
                                                                Tổng tiền sản phẩm đã mua:
                                                            </div>
                                                            <div class="col-6 form-control font-weight-bold fs16 d-flex align-items-center">
                                                                <i class="fas fa-coins m10r"></i>{{ number_format($currentUser->marketBuyer()->where('status', TRADE_DONE)->sum('price')) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div><!-- kvWrap -->
        </div>
    </div>

    <div class="modal fade" id="modal-sell-item" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalCenterTitle">Bán sản phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row m0 h100 col-12">
                            <div class="d-flex h100" style="width: 150px">
                                <img class="w-100 object-fit-contain" src="{{ asset('images/item_dota/set_dota_1.jpg') }}" alt="">
                            </div>
                            <div style="min-width: 450px; max-width: 550px">
                                <div class="d-flex align-items-center font-weight-bold m10l m10b fs20 justify-content-center">Guise of the Winged Bolt</div>
                                <div class="d-flex align-items-center m10l justify-content-center fs16">Drow ranger</div>
                            </div>
                        </div>
                        <div class="row m0 m20t col-12">
                            <div class="w-100 border">
                                <div class="w-100" id="history-pay-chart-sell"></div>
                            </div>
                        </div>

                        <div class="row m0 m20t col-12 p25l">
                           <div class="col-2 d-flex align-items-center font-weight-bold">Giá bán</div>
                           <div class="col-4">
                               <input type="text" class="form-control convert-number-double-decimal text-right" name="amount_sell">
                           </div>
                            <div class="col-2 d-flex align-items-center font-weight-bold">Giá thực nhận</div>
                            <div class="col-4">
                                <input type="text" class="form-control convert-number-double-decimal text-right" name="amount_real">
                            </div>
                        </div>

                        <div class="row m0 m20t col-12 p25l">
                            <input type="checkbox" style="display: block; width: unset">
                            <div class="m10l">Đồng ý và tiến hành rao bán</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    <button id="pay-submit" type="button" class="btn btn-primary">Hoàn tất</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
