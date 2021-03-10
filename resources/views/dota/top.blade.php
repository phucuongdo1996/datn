@extends('layout.base_top')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/top/top.css') }}">
@endsection
@section('content')
    @include('layout.new_header')

    <div id="mainWrap" class="p80t">
        <div id="main">
            <div id="kvWrap" style="padding-left: 10%; padding-right: 10%; background-color: #f4f6f9">
                <div class="row m10b">
                    <div class="col-8">
                        <div class="item-block m5r">
                            <div class="slide-logo" style="max-height: 350px">
                                <img style="max-height: 350px; object-fit: fill" src="{{ asset('images/dota2_1.png') }}" alt="">
                                <img style="max-height: 350px; object-fit: fill" src="{{ asset('images/logo.png') }}" alt="">
                                <img style="max-height: 350px; object-fit: fill" src="{{ asset('images/logo_steam.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="item-block h-100 m5l p15" style="max-height: 350px">
                            <div class="row m-0">
                                <div class="col-12 m10b">
                                    <p class="fs20 fw-bold m-0">Mới cập nhật
                                        <a href="" aria-hidden="true" data-placement="left" data-toggle="tooltip" title="Item mới cập nhật !"><i class="question-icon far fa-question-circle"></i></a>
                                    </p>
                                </div>
                            </div>
                            <div style="max-height: 290px; overflow-y: scroll">
                                @foreach([1,2,3,4,5,6,7] as $item)
                                <div class="row m-0 m10b h90">
                                    <div class="d-flex h90 zoom-hover">
                                        <img class="object-fit-cover" src="{{ asset('images/dota2_1.png') }}" alt="">
                                    </div>
                                    <div class="p20l">
                                        <div class="font-weight-bold">Guise of the Winged Bolt</div>
                                        <a href="#" class="hero-hover">- Drow Ranger</a>
                                        <div class="font-weight-bold text-blue">10,000</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row m10b">
                    <div class=" row m-0 item-block p15" style="height: 220px; width: 100%">
                        @foreach([1,2,3,4,5,6,7] as $item)
                        <div class="m10l m10r">
                            <div class="d-flex zoom-hover" style="width: 170px; height: 100px">
                                <img style="object-fit: fill" src="{{ asset('images/dota2_1.png') }}" alt="">
                            </div>
                            <div class="p5t font-weight-bold">Guise of the Winged Bolt</div>
                            <a href="#" class="p5t hero-hover"> - Drow Ranger</a>
                            <div class="p5t font-weight-bold text-blue">10,000</div>
                        </div>
                        @endforeach
                    </div>

                </div>

                <div class="row">
                    <div class="col-8">
                        <div class="item-block m10b m5r p15" style="height: 660px">
                            <div class="row m-0">
                                <div class="col-12 m10b d-flex justify-content-between">
                                    <p class="fs20 fw-bold m-0">Item đang bán</p>
                                    <button class="btn btn-primary"><a class="text-white" href="{{ route(DOTA_LIST_ITEM) }}">Xem thêm >></a></button>
                                </div>
                            </div>
                            <div class="row m-0" style="height: 550px; overflow-y: scroll; overflow-x: hidden">
                            @foreach([1,2,3,4,5,6,7,8,9,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1] as $item)
                                <div class="col-2 p15l p15b">
                                    <div class="d-flex zoom-hover" style="width: 100%; height: 90px">
                                        <img style="object-fit: fill" src="{{ asset('images/dota2_1.png') }}" alt="">
                                    </div>
                                    <div class="p5t font-weight-bold">Guise of the Winged Bolt</div>
                                    <a href="#" class="p5t hero-hover"> - Drow Ranger</a>
                                    <div class="p5t font-weight-bold text-blue">10,000</div>
                                </div>
                            @endforeach
                            </div>
                        </div>

                        <div class="item-block m10b m5r p15" style="height: 660px">
                            <div class="row m-0">
                                <div class="col-12 m10b d-flex justify-content-between">
                                    <p class="fs20 fw-bold m-0">Set đang bán</p>
                                    <button class="btn btn-primary">Xem thêm >></button>
                                </div>
                            </div>
                            <div class="row m-0" style="height: 550px; overflow-y: scroll; overflow-x: hidden">
                                @foreach([1,2,3,4,5,6,7,8,9,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1] as $item)
                                    <div class="col-2 p15l p15b">
                                        <div class="d-flex zoom-hover" style="width: 100%; height: 90px">
                                            <img style="object-fit: fill" src="{{ asset('images/dota2_1.png') }}" alt="">
                                        </div>
                                        <div class="p5t font-weight-bold">Guise of the Winged Bolt</div>
                                        <a href="#" class="p5t hero-hover"> - Drow Ranger</a>
                                        <div class="p5t font-weight-bold text-blue">10,000</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="item-block m10b m5l p15" style="height: 660px">
                            <div class="row m-0">
                                <div class="col-12 m10b">
                                    <p class="fs20 fw-bold m-0">Bán chạy nhất<i class="question-icon far fa-question-circle" aria-hidden="true"></i></p>
                                </div>
                            </div>
                            <div style="max-height: 550px; overflow-y: scroll">
                                @foreach([1,2,3,4,5,6,7] as $item)
                                    <div class="row m-0 m10b h90">
                                        <div class="d-flex h90 zoom-hover">
                                            <img class="object-fit-cover" src="{{ asset('images/dota2_1.png') }}" alt="">
                                        </div>
                                        <div class="p20l">
                                            <div class="font-weight-bold">Guise of the Winged Bolt</div>
                                            <a href="#" class="hero-hover">- Drow Ranger</a>
                                            <div class="font-weight-bold text-blue">10,000</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="item-block m10b m5l p15" style="height: 660px">
                            <div class="row m-0">
                                <div class="col-12 m10b">
                                    <p class="fs20 fw-bold m-0">Đáng chú ý<i class="question-icon far fa-question-circle" aria-hidden="true"></i></p>
                                </div>
                            </div>
                            <div style="max-height: 550px; overflow-y: scroll">
                                @foreach([1,2,3,4,5,6,7] as $item)
                                    <div class="row m-0 m10b h90">
                                        <div class="d-flex h90 zoom-hover">
                                            <img class="object-fit-cover" src="{{ asset('images/dota2_1.png') }}" alt="">
                                            <div>
                                                <span>Hot</span>
                                            </div>
                                        </div>
                                        <div class="p20l">
                                            <div class="font-weight-bold">Guise of the Winged Bolt</div>
                                            <a href="#" class="hero-hover">- Drow Ranger</a>
                                            <div class="font-weight-bold text-blue">10,000</div>
                                        </div>
                                    </div>
                                @endforeach
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
    <script>
        $(document).ready(function () {
            $('.slide-logo').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                arrows: false,
            });
        });
    </script>
@endsection
