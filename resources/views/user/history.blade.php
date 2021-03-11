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
                                            <input class="form-control date-time" type="text" value="01/01/2021" placeholder="01/01/2021">
                                        </div>
                                        <div class="col-4 p10lr">
                                            <input class="form-control date-time" type="text" value="{{ date('m/d/Y', time()) }}" placeholder="01/01/2021">
                                        </div>
                                        <div class="col-4 p10lr" >
                                            <select class="form-control" name="" id="">
                                                <option value="">Tất cả</option>
                                                <option value="">Bán</option>
                                                <option value="">Mua</option>
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
{{--                                        {{ dd(strtotime('0/01/2021')) }}--}}
{{--                                        {{ rand(1575126000, 1606748400) }}--}}
                                        @foreach([1,2,3,4,5,6,7,8,9,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1] as $item)
                                            @php($random = rand(0, 1))
                                        @php($number = number_format(rand(1, 20) * 10000))
                                        @if($random == 0)
                                            <div class="row col-12 m0 p15 justify-content-between border-bottom">
                                                <div>
                                                    <div class="fs16 m10b">
                                                        <span class="font-weight-bold">Cường</span> đã mua <span class="font-weight-bold">Guise of the Winged Bolt</span> với giá <span class="font-weight-bold">{{ $number }}</span>.
                                                    </div>
                                                    <div class="text-blue fs14">
                                                        {{ date('h:i d/m/Y', rand(1575126000, 1606748400)) }}
                                                    </div>
                                                </div>
                                                <div class="fs18" style="color: green">
                                                    + {{ $number }}
                                                </div>
                                            </div>
                                            @else
                                                <div class="row col-12 m0 p15 justify-content-between border-bottom">
                                                    <div>
                                                        <div class="fs16 m10b">
                                                            <span class="font-weight-bold">Bạn</span> đã mua <span class="font-weight-bold">Guise of the Winged Bolt</span> từ <span class="font-weight-bold">Cường</span> với giá <span class="font-weight-bold">{{ $number }}</span>.
                                                        </div>
                                                        <div class="text-blue fs14">
                                                            {{ date('h:i d/m/Y', rand(1575126000, 1606748400)) }}
                                                        </div>
                                                    </div>
                                                    <div class="fs18" style="color: red">
                                                        - {{ $number }}
                                                    </div>
                                                </div>
                                            @endif
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
