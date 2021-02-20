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
                        <div class="p5r">
                            <div class="item-block h-100 m5l p15">
                                <div class="row m-0">
                                    <div class="col-12 m10b">
                                        <p class="fs20 fw-bold m-0">DANH MỤC</p>
                                    </div>
                                </div>
                                <div id="category-item-dota">
                                    <ul>
                                        <li class="item-category">Tất cả</li>
                                        <li class="item-category">Item thường</li>
                                        <li class="item-category">Item có hiệu ứng</li>
                                        <li class="item-category">Taunt</li>
                                        <li class="item-category">Courier thường</li>
                                        <li class="item-category">Unusual Courier </li>
                                        <li class="item-category">Wards</li>
                                        <li class="item-category">Terrain</li>
                                        <li class="item-category">Arcana</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-9">
                        <div class="p5l">
                            <div class="row m-0 m10b">
                                <div class="col-12 row item-block m5r h-100 p20">
                                    <div class="col-6 p10lr m10b">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-4 d-flex align-items-center"><label class="fs18">Tên sản phẩm</label></div>
                                                <div class="col-8"><input class="form-control" type="text"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 p10lr m10b">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-4 d-flex align-items-center"><label class="fs18">Tướng sở hữu</label></div>
                                                <div class="col-8">
                                                    <select class="form-control">
                                                        <option value="">11111</option>
                                                        <option value="">11111</option>
                                                        <option value="">11111</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 p10lr m10b">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-4 d-flex align-items-center"><label class="fs18">Giá</label></div>
                                                <div class="col-8 row">
                                                    <div class="w-45">
                                                        <input type="text" class="form-control text-right" placeholder="1,000">
                                                    </div>
                                                    <div class="w-10 d-flex justify-content-center align-items-center"> ~ </div>
                                                    <div class="w-45">
                                                        <input type="text" class="form-control text-right" placeholder="1,000,000">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center m10t">
                                        <button class="btn btn-primary"> <i class="fas fa-search"></i> Kết quả</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-0">
                                <div class="item-block m5r h-100 p15 p20t">
                                    <div class="row m-0" style="height: 700px; overflow-y: scroll; overflow-x: hidden">
                                        @foreach([1,2,3,4,5,6,7,8,9,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1] as $item)
                                            <div class="col-2 p15l p15b">
                                                <div class="d-flex zoom-hover" style="width: 100%; height: 100px">
                                                    <img style="object-fit: fill" src="{{ asset('images/item_dota/item_dota_2.png') }}" alt="">
                                                </div>
                                                <div class="p5t font-weight-bold">Guise of the Winged Bolt</div>
                                                <a href="#" class="p5t hero-hover"> - Drow Ranger</a>
                                                <div class="p5t font-weight-bold text-blue">10,000</div>
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
@endsection
@section('js')
    <script src="{{ asset('/dist/js/top_index.min.js') }}"></script>
    <script src="{{ asset('/js/top/top.js') }}"></script>
@endsection
