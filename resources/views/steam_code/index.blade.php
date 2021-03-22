@extends('layouts.base')
@section('styles')
@endsection
@section('content')
    @include('layouts.header')
    <div id="mainWrap" class="p80t">
        <div id="main">
            <div id="kvWrap" style="padding-left: 10%; padding-right: 10%; background-color: #f4f6f9">
                <div class="row">
                    <div class="col-1">

                    </div>

                    <div class="col-10">
                        <div class="p5l">
                            <div class="row m-0">
                                <div class="item-block m5r h-100 p15 p20t">
                                    <div class="row m-0" style="">
                                        <div class="col-3 m0 p15b p15r" style="">
                                            <div class="d-flex position-relative hovereffect h-365 border-radius-10">
                                                <img class="w-100" style="object-fit: fill" src="{{ asset('images/steam_codes/steam_code_250.jpeg') }}" alt="">
                                                <div class="overlay d-flex justify-content-center align-items-center">
                                                    <div>
                                                        <button class="btn btn-primary fs18 sell-item" style="width: 200px">
                                                            $ 4,000,000
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3 m0 p15b p15r" style="">
                                            <div class="d-flex position-relative h-365 border-radius-10 steam-code-disabled">
                                                <img class="w-100" style="object-fit: fill" src="{{ asset('images/steam_codes/steam_code_200.jpeg') }}" alt="">
                                                <div class="overlay d-flex justify-content-center align-items-center">
                                                    <div class="d-flex justify-content-center align-items-center" style="background-color: #777777; width: 100%; padding-top: 15px; padding-bottom: 15px">
                                                        <div class="fs18 color-white" >
                                                            Hết hàng
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3 m0 p15b p15r" style="">
                                            <div class="d-flex position-relative hovereffect h-365 border-radius-10">
                                                <img class="w-100" style="object-fit: fill" src="{{ asset('images/steam_codes/steam_code_100.jpeg') }}" alt="">
                                                <div class="overlay d-flex justify-content-center align-items-center">
                                                    <div>
                                                        <button class="btn btn-primary fs18 sell-item" style="width: 200px">
                                                            $ 4,000,000
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3 m0 p15b p15r" style="">
                                            <div class="d-flex position-relative hovereffect h-365 border-radius-10">
                                                <img class="w-100" style="object-fit: fill" src="{{ asset('images/steam_codes/steam_code_50.jpeg') }}" alt="">
                                                <div class="overlay d-flex justify-content-center align-items-center">
                                                    <div>
                                                        <button class="btn btn-primary fs18 sell-item" style="width: 200px">
                                                            $ 4,000,000
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3 m0 p15b p15r" style="">
                                            <div class="d-flex position-relative hovereffect h-365 border-radius-10">
                                                <img class="w-100" style="object-fit: fill" src="{{ asset('images/steam_codes/steam_code_20.jpg') }}" alt="">
                                                <div class="overlay d-flex justify-content-center align-items-center">
                                                    <div>
                                                        <button class="btn btn-primary fs18 sell-item" style="width: 200px">
                                                            $ 4,000,000
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3 m0 p15b p15r" style="">
                                            <div class="d-flex position-relative hovereffect h-365 border-radius-10">
                                                <img class="w-100" style="object-fit: fill" src="{{ asset('images/steam_codes/steam_code_10.jpeg') }}" alt="">
                                                <div class="overlay d-flex justify-content-center align-items-center">
                                                    <div>
                                                        <button class="btn btn-primary fs18 sell-item" style="width: 200px">
                                                            $ 4,000,000
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-3 m0 p15b p15r" style="">
                                            <div class="d-flex position-relative hovereffect h-365 border-radius-10">
                                                <img class="w-100" style="object-fit: fill" src="{{ asset('images/steam_codes/steam_code_5.jpg') }}" alt="">
                                                <div class="overlay d-flex justify-content-center align-items-center">
                                                    <div>
                                                        <button class="btn btn-primary fs18 sell-item" style="width: 200px">
                                                            $ 4,000,000
                                                        </button>
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
    <script src="{{ asset('js/user/list_item.js') }}"></script>
@endsection
