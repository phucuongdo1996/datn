@extends('layout.base_top')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/top/top.css') }}">
@endsection
@section('content')
    @include('layout.new_header')
    <div id="mainWrap" class="p80t">
        <div id="main">
            <div id="kvWrap" style="padding-left: 10%; padding-right: 10%; background-color: #f4f6f9">
                <div class="row">
                    <div class="col-3">
                        @include('user.menu')
                    </div>

                    <div class="col-9">
                        <div class="p5l">
                            <div class="row m-0 m10b">
                                <div class="col-12 item-block m5r h-100 p15 p20t">
                                    <div class="row m-0">
                                        <div class="col-4 p10lr">
                                            <input class="form-control" type="text" placeholder="Tên sản phẩm...">
                                        </div>
                                        <div class="col-4 p10lr" >
                                            <select class="form-control" name="" id="">
                                                <option value="">Tất cả</option>
                                                <option value="">Alchemit</option>
                                                <option value="">Anti-mage</option>
                                                <option value="">Drow ranger</option>
                                            </select>
                                        </div>
                                        <div class="col-4 p10lr" >
                                            <select class="form-control" name="" id="">
                                                <option value="">Tất cả</option>
                                                <option value="">Alchemit</option>
                                                <option value="">Anti-mage</option>
                                                <option value="">Drow ranger</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row m-0 m15t">
                                        <div class="col-12 d-flex align-items-center justify-content-center">
                                            <button class="btn btn-primary min-w115"><i class="fas fa-search m10r"></i>Lọc</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0">
                                <div class="item-block m5r h-100 p15 p20t">
                                    <div class="row m-0" style="height: 700px; overflow-y: scroll; overflow-x: hidden">
                                        @foreach([1,2,3,4,5,6,7,8,9,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1] as $item)
                                            <div class="col-2 m0 p15b p15r">
                                                <div class="d-flex position-relative hovereffect">
                                                    <img class="w-100 h-110" style="object-fit: fill" src="{{ asset('images/item_dota/item_dota_2.png') }}" alt="">
                                                    <div class="overlay d-flex justify-content-center align-items-center h100">
                                                        <div>
                                                            <button class="btn btn-primary fs18 sell-item" style="min-width: 100px">
                                                                Thu hồi
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-center p5">
                                                   <span class="font-weight-bold">10,000,000</span>
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
@endsection
@section('js')
{{--    <script src="{{ asset('/js/user/user.js') }}"></script>--}}
@endsection
