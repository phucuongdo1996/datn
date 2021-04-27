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
                    <input id="user-id" type="hidden" name="user_id" value="{{ $currentUser->id }}">
                    <div class="col-9">
                        <div class="p5l">
                            <div class="row m-0 m10b">
                                <div class="col-12 item-block m5r h-100 p15 p20t">
                                    <div class="row m0">
                                        @php($thu = $userHistory->whereIn('type', [USER_HISTORY_SELL_ITEM, USER_HISTORY_RECHARGE_MONEY])->sum('purchase_money'))
                                        @php($chi = $userHistory->where('type', USER_HISTORY_BUY_ITEM)->sum('purchase_money'))
                                            <div class="col-4 row m0">
                                                <div class="col-4 d-flex align-items-center justify-content-center">
                                                    <label class="fs18">Tổng thu</label>
                                                </div>
                                                <div class="col-8 p15r">
                                                    <input type="text" value="{{ number_format($thu, 2) }}" class="form-control text-right" style="color: green" disabled>
                                                </div>
                                            </div>
                                            <div class="col-4 row m0">
                                                <div class="col-4 d-flex align-items-center justify-content-center">
                                                    <label class="fs18">Tổng chi</label>
                                                </div>
                                                <div class="col-8 p15r">
                                                    <input type="text" value="{{ number_format($chi, 2) }}" class="form-control text-right" style="color: red" disabled>
                                                </div>
                                            </div>
                                            <div class="col-4 row m0">
                                                <div class="col-4 d-flex align-items-center justify-content-center">
                                                    <label class="fs18">Chênh lệch</label>
                                                </div>
                                                <div class="col-8 p15r">
                                                    <input type="text" value="{{ number_format($thu-$chi, 2) }}" class="form-control text-right" style="color: {{ $thu-$chi > 0 ? 'green' : 'red' }}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>

                            <div class="row m-0">
                                <div class="col-12 item-block h-100 p15 p20t">
                                    <div style="height: 700px; overflow-y: auto; overflow-x: hidden">
                                        @foreach($userHistory as $item)
                                            @include('user.history_item', ['data' => $item])
                                        @endforeach
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
    <script src="{{ asset('js/user/history.js') }}"></script>
@endsection
