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
                                        @php($chi = $userHistory->whereIn('type', [USER_HISTORY_BUY_ITEM, USER_HISTORY_BUY_STEAM_CODE])->sum('purchase_money'))
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

    <div class="modal fade" id="steam-code-info" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 700px">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold fs25" id="exampleModalCenterTitle">Thông tin thẻ</h5>
                    <button type="button" class="close btn btn-zoom-hover" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row m0 col-12 p10b">
                        <div class="row m0 col-12 m10t form-group fs20">
                            <div class="col-4 d-flex align-items-center">Mã thẻ</div>
                            <div id="steam-code" class="form-control col-8 text-right fs20"></div>
                        </div>
                        <div class="row m0 col-12 m10t form-group fs20">
                            <div class="col-4 d-flex align-items-center">Số Seri</div>
                            <div id="steam-seri" class="form-control col-8 text-right fs20"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/user/history.js') }}"></script>
@endsection
