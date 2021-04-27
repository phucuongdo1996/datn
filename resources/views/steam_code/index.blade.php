@extends('layouts.base')
@section('styles')
@endsection
@section('content')
    @include('layouts.header')
    <div id="mainWrap" class="p80t">
        <div id="main">
            <div id="kvWrap" style="padding-left: 10%; padding-right: 10%; background-color: #f4f6f9">
                <div class="row">
                    <input id="user-id" type="hidden" value="{{ $currentUser ? $currentUser->id : '' }}">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <div class="p5l">
                            <div class="row m-0">
                                <div class="item-block m5r h-100 p15 p20t">
                                    <div class="row m-0" style="">
                                        @foreach(STEAM_CODE_ARRAY as $key => $value)
                                        <div class="col-xl-3 col-lg-4 col-6  m0 p15b p15r" style="">
                                            <div class="d-flex position-relative hovereffect h-365 border-radius-10">
                                                <img class="w-100" style="object-fit: fill" src="{{ asset('images/steam_codes/' . $value) }}" alt="">
                                                <div class="overlay d-flex justify-content-center align-items-center">
                                                    @if($data[$key]['count_record'] > 0)
                                                        <div>
                                                            <button class="btn btn-primary fs18 buy-steam-code" style="width: 200px">
                                                                <span><i class="fas fa-coins"></i> {{ number_format(STEAM_CODE_MONEY[$key]) }}</span>
                                                            </button>
                                                        </div>
                                                    @else
                                                        <div class="fs18 color-white" >
                                                            Hết hàng
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
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

    <!-- Modal xác thực mua item -->
    <div class="modal fade" id="modal-buy-steam-code" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
            <form id="form-buy-item" class="modal-content">
                <input type="hidden" name="steam_code_type" value="">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bold" id="exampleModalCenterTitle">Mua sản phẩm</h5>
                    <button type="button" class="close btn btn-zoom-hover" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="row m0 m20t col-12">
                            <div class="row m0 col-12 border p10t p10b fs18">
                                <div class="col-12 font-weight-bold fs20 m10t"> Thông tin thanh toán</div>
                                <div class="row m0 col-12 m10t form-group">
                                    <div class="col-6 d-flex align-items-center">Tài khoản hiện có</div>
                                    <div class="form-control col-6 text-right fs20">{{ $currentUser ? number_format($currentUser->money_own) : FLAG_ZERO }}</div>
                                </div>
                                @php($rest = 1000000)
                                <div class="row m0 col-12 m10t form-group">
                                    <div class="col-6 d-flex align-items-center">Giá sản phẩm (đã bao gồm VAT)</div>
                                    <div class="form-control col-6 text-right fs20" style="color: {{ $rest > 0 ? 'green' : 'red' }}">1000000</div>
                                </div>
                                <div class="row m0 col-12 m10t form-group">

                                    <div class="col-6 d-flex align-items-center">Tài khoản còn lại</div>
                                    <div class="form-control col-6 text-right fs20" style="color: {{ $rest > 0 ? 'green' : 'red' }}">1000000</div>
                                </div>
                            </div>
                        </div>
                        <div class="row m0 m20t col-12 p25l">
                            @if($rest > 0)
                                <input id="check-submit" name="check_submit" type="checkbox" style="display: block; width: unset; transform: scale(1.5)">
                                <div class="m10l fs16 font-weight-bold pointer-event"><label for="check-submit">Đồng ý và tiến hành rao bán</label></div>
                                <p class="error-message" data-error="check_submit"></p>
                            @else
                                <div class="m10l fs16 font-weight-bold pointer-event"><label class="error-message">Tài khoản hiện có không đủ để thực hiện giao dịch này!</label></div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="pay-submit" type="button" class="btn m-0 btn-load-more" disabled><span><i class="fas fa-shopping-cart m5r"></i> Thanh toán</span></button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Đăng nhập -->
    <div class="modal fade" id="login-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 750px">
            <div class="modal-content">
                <div class="modal-body" style="">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fas fa-times-circle"></i></button>
                    <div class="row" style="min-height: 500px">
                        <div class="col-6 d-flex">
                            <img class="w-100 object-fit-contain" style="border-radius: 20px" src="{{ asset('images/dota_images/bg_login.jpeg') }}" alt="">
                        </div>
                        <form id="form-login" class="col-6">
                            @csrf
                            <div class="d-flex justify-content-center" style="padding-top: 90px; padding-bottom: 30px">
                                <div class="d-flex justify-content-center align-items-center" style="width: 80px; height: 80px; padding: 10px; border-radius: 50%; background-color: grey">
                                    <i class="fas fa-user" style="font-size: 40px"></i>
                                </div>
                            </div>
                            <div>
                                <div class="fail-login" style="display: none;">
                                    <p class="m0">Email hoặc mật khẩu không đúng.</p>
                                    <p class="m0">Vui lòng kiểm tra lại!</p>
                                </div>
                                <input type="text" name="email" class="form-control" placeholder="Tài khoản">
                                <p class="error-message p10t" data-error="email"></p>
                                <input type="password" name="password" class="form-control 15t" placeholder="Mật khẩu">
                                <p class="error-message p10t" data-error="password"></p>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button type="button" id="button-login" class="btn" style="padding: 10px 30px; background-color: grey; border-radius: 32px"><span>Đăng nhập</span></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/dota/steam_code.js') }}"></script>
@endsection
