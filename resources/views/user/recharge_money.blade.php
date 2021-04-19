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
                                <div class="col-12 item-block m5r h-100">
                                    <div class="row m-0 fs16">
                                        <div class="col-12 p30">
                                            <div class="row m0 m15b">
                                                <p class="fs20 fw-bold m-0">Chuyển khoản trực tiếp
                                                    <i class="fas fa-info-circle " style="color: #007bff" data-toggle="tooltip" title="Bạn sẽ chuyển khoản trực tiếp đến tài khoản của Admin, Admin sẽ xác nhận và cộng số dư cho tài khoản."></i>
                                                </p>
                                            </div>
                                            <div class="row m0 m15b">
                                               <div class="col-12">Bạn có nạp tiền bằng cách chuyển khoản trực tiếp đến các STK sau đây: </div>
                                            </div>
                                            <div class="row m0">
                                                <div class="col-6 border-right">
                                                    <div class="row m0 border-bottom p10">
                                                        <div class="col-12 row m0 m10b">
                                                            <div class="col-4">Ngân hàng:</div>
                                                            <div class="col-8 font-weight-bold">ACB</div>
                                                        </div>
                                                        <div class="col-12 row m0 m10b">
                                                            <div class="col-4">Số tài khoản:</div>
                                                            <div class="col-8 font-weight-bold">6978397</div>
                                                        </div>
                                                        <div class="col-12 row m0 m10b">
                                                            <div class="col-4">Số thẻ:</div>
                                                            <div class="col-8 font-weight-bold">6978 3978 7854 7852</div>
                                                        </div>
                                                        <div class="col-12 row m0 m10b">
                                                            <div class="col-4">Chi nhánh:</div>
                                                            <div class="col-8 font-weight-bold">Đống Đa (Hà Nội)</div>
                                                        </div>
                                                    </div>
                                                    <div class="row m0 m15t p10">
                                                        <div class="col-12 row m0 m10b">
                                                            <div class="col-4">Ngân hàng:</div>
                                                            <div class="col-8 font-weight-bold">ACB</div>
                                                        </div>
                                                        <div class="col-12 row m0 m10b">
                                                            <div class="col-4">Số tài khoản:</div>
                                                            <div class="col-8 font-weight-bold">6978397</div>
                                                        </div>
                                                        <div class="col-12 row m0 m10b">
                                                            <div class="col-4">Số thẻ:</div>
                                                            <div class="col-8 font-weight-bold">6978 3978 7854 7852</div>
                                                        </div>
                                                        <div class="col-12 row m0 m10b">
                                                            <div class="col-4">Chi nhánh:</div>
                                                            <div class="col-8 font-weight-bold">Đống Đa (Hà Nội)</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 p20l d-flex justify-content-center align-items-center">
                                                    <div>
                                                        <div class="m10b">Bạn vui lòng chuyển khoản với nội dung:</div>
                                                        <div class="d-flex justify-content-center">
                                                            <input class="form-control font-weight-bold w-auto text-center" value="NAPTK {{ strtoupper($currentUser->user_code) }}" disabled>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row m0 m20t">
                                                <div class="text-red" style="font-style: italic">(Sẽ không mất phí. Nhưng sẽ mất khoảng 5-10 phút để xác nhận giao dịch.)</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 m10t m10b">
                                <div class="col-12 item-block m5r h-100">
                                    <div class="row m-0 fs16">
                                        <div class="col-12 p30">
                                            <div class="row m0 m15b">
                                                <p class="fs20 fw-bold m-0">Chuyển khoản qua BAOKIM.VN
                                                    <i class="fas fa-info-circle " style="color: #007bff" data-toggle="tooltip" title="Bạn sẽ thực hiện chuyển khoản qua Bảo Kim. Thực hiện thanh toán thành công số dư sẽ được cộng ngay. Tuy nhiên sẽ mất phí giao dịch."></i>
                                                </p>
                                            </div>
                                            <div class="row m0 m15b">
                                                <div class="col-12">Bạn vui lòng chọn một trong số các mức nạp (Nếu bạn muốn nạp mức cao hơn hãy liên hệ chuyển khoản trực tiếp) </div>
                                            </div>
                                            <div class="row m0 m15b">
                                                <div class="col-3 p10">
                                                    <input type="radio" id="radio-1" name="money_pay" value="100000" class="radio-custom">
                                                    <label for="radio-1" class="form-control d-flex justify-content-center align-items-center label-radio-custom p20" style="border: 2px solid #dee2e6">
                                                        <span class="font-weight-bold">100,000</span>
                                                    </label>
                                                </div>
                                                <div class="col-3 p10">
                                                    <input type="radio" id="radio-2" name="money_pay" value="100000" class="radio-custom">
                                                    <label for="radio-2" class="form-control d-flex justify-content-center align-items-center label-radio-custom p20" style="border: 2px solid #dee2e6">
                                                        <span class="font-weight-bold">200,000</span>
                                                    </label>
                                                </div>
                                                <div class="col-3 p10">
                                                    <input type="radio" id="radio-3" name="money_pay" value="100000" class="radio-custom">
                                                    <label for="radio-3" class="form-control d-flex justify-content-center align-items-center label-radio-custom p20" style="border: 2px solid #dee2e6">
                                                        <span class="font-weight-bold">500,000</span>
                                                    </label>
                                                </div>
                                                <div class="col-3 p10">
                                                    <input type="radio" id="radio-4" name="money_pay" value="100000" class="radio-custom">
                                                    <label for="radio-4" class="form-control d-flex justify-content-center align-items-center label-radio-custom p20" style="border: 2px solid #dee2e6">
                                                        <span class="font-weight-bold">1,000,000</span>
                                                    </label>
                                                </div>
                                                <div class="col-3 p10">
                                                    <input type="radio" id="radio-5" name="money_pay" value="100000" class="radio-custom">
                                                    <label for="radio-5" class="form-control d-flex justify-content-center align-items-center label-radio-custom p20" style="border: 2px solid #dee2e6">
                                                        <span class="font-weight-bold">1,500,000</span>
                                                    </label>
                                                </div>
                                                <div class="col-3 p10">
                                                    <input type="radio" id="radio-6" name="money_pay" value="100000" class="radio-custom">
                                                    <label for="radio-6" class="form-control d-flex justify-content-center align-items-center label-radio-custom p20" style="border: 2px solid #dee2e6">
                                                        <span class="font-weight-bold">2,000,000</span>
                                                    </label>
                                                </div>
                                                <div class="col-3 p10">
                                                    <input type="radio" id="radio-7" name="money_pay" value="100000" class="radio-custom">
                                                    <label for="radio-7" class="form-control d-flex justify-content-center align-items-center label-radio-custom p20" style="border: 2px solid #dee2e6">
                                                        <span class="font-weight-bold">3,000,000</span>
                                                    </label>
                                                </div>
                                                <div class="col-3 p10">
                                                    <input type="radio" id="radio-8" name="money_pay" class="radio-custom">
                                                    <label for="radio-8" class="form-control d-flex justify-content-center align-items-center label-radio-custom p20" style="border: 2px solid #dee2e6">
                                                        <span class="font-weight-bold">5,000,000</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="row m0 justify-content-end m10b">
                                                <button class="btn btn-primary"><i class="fas fa-credit-card"></i> Thanh toán</button>
                                            </div>
                                            <div class="row m0">
                                                <div class="text-red" style="font-style: italic">(Số dư tài khoản sẽ được
                                                    cộng ngay, tuy nhiên sẽ mất phí giao dịch.)
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
    <script src="{{ asset('/js/user/recharge-money.js') }}"></script>
@endsection
