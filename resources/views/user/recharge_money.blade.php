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
                                            <form id="form-data" class="row m0 m15b">
                                                <div class="col-3 p10">
                                                    <input type="radio" id="radio-1" name="total_amount" value="100000" class="radio-custom">
                                                    <label for="radio-1" class="form-control d-flex justify-content-center align-items-center label-radio-custom p20" style="border: 2px solid #dee2e6">
                                                        <span class="font-weight-bold">100,000</span>
                                                    </label>
                                                </div>
                                                <div class="col-3 p10">
                                                    <input type="radio" id="radio-2" name="total_amount" value="200000" class="radio-custom">
                                                    <label for="radio-2" class="form-control d-flex justify-content-center align-items-center label-radio-custom p20" style="border: 2px solid #dee2e6">
                                                        <span class="font-weight-bold">200,000</span>
                                                    </label>
                                                </div>
                                                <div class="col-3 p10">
                                                    <input type="radio" id="radio-3" name="total_amount" value="500000" class="radio-custom">
                                                    <label for="radio-3" class="form-control d-flex justify-content-center align-items-center label-radio-custom p20" style="border: 2px solid #dee2e6">
                                                        <span class="font-weight-bold">500,000</span>
                                                    </label>
                                                </div>
                                                <div class="col-3 p10">
                                                    <input type="radio" id="radio-4" name="total_amount" value="1000000" class="radio-custom">
                                                    <label for="radio-4" class="form-control d-flex justify-content-center align-items-center label-radio-custom p20" style="border: 2px solid #dee2e6">
                                                        <span class="font-weight-bold">1,000,000</span>
                                                    </label>
                                                </div>
                                                <div class="col-3 p10">
                                                    <input type="radio" id="radio-5" name="total_amount" value="1500000" class="radio-custom">
                                                    <label for="radio-5" class="form-control d-flex justify-content-center align-items-center label-radio-custom p20" style="border: 2px solid #dee2e6">
                                                        <span class="font-weight-bold">1,500,000</span>
                                                    </label>
                                                </div>
                                                <div class="col-3 p10">
                                                    <input type="radio" id="radio-6" name="total_amount" value="2000000" class="radio-custom">
                                                    <label for="radio-6" class="form-control d-flex justify-content-center align-items-center label-radio-custom p20" style="border: 2px solid #dee2e6">
                                                        <span class="font-weight-bold">2,000,000</span>
                                                    </label>
                                                </div>
                                                <div class="col-3 p10">
                                                    <input type="radio" id="radio-7" name="total_amount" value="3000000" class="radio-custom">
                                                    <label for="radio-7" class="form-control d-flex justify-content-center align-items-center label-radio-custom p20" style="border: 2px solid #dee2e6">
                                                        <span class="font-weight-bold">3,000,000</span>
                                                    </label>
                                                </div>
                                                <div class="col-3 p10">
                                                    <input type="radio" id="radio-8" name="total_amount" value="5000000" class="radio-custom">
                                                    <label for="radio-8" class="form-control d-flex justify-content-center align-items-center label-radio-custom p20" style="border: 2px solid #dee2e6">
                                                        <span class="font-weight-bold">5,000,000</span>
                                                    </label>
                                                </div>
                                            </form>
                                            <p class="error-message" data-error="total_amount"></p>
                                            <div class="row m0 justify-content-end m10b">
                                                <button id="btn-redirect-bao-kim" class="btn btn-primary"><i class="fas fa-credit-card"></i> Thanh toán</button>
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

@endsection
@section('js')
    <script src="{{ asset('js/user/recharge-money.js') }}"></script>
@endsection
