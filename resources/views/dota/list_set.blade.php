@extends('layouts.base')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dota/list_set.css') }}">
@endsection
@section('content')
    @include('layouts.header')

    <div id="mainWrap" class="p80t">
        <div id="main">
            <div id="kvWrap" style="padding-left: 10%; padding-right: 10%; background-color: #f4f6f9">
                <div class="row">
                    <div class="col-3">
                        <div class="p5r">
                            <div class="item-block h-100 m5l p15">
                                <div class="row m-0">
                                    <div class="col-12 m10b">
                                        <p class="fs20 fw-bold m-0">TƯỚNG SỞ HỮU</p>
                                    </div>
                                </div>
                                <input type="text" class="form-control m10b" list="list-hero">
                                <datalist id="list-hero">
                                    @foreach($listHero as $hero)
                                        <option value="{{ $hero['name'] }}">
                                    @endforeach
                                </datalist>
                                <div id="category-item-dota">
                                    <ul>
                                        <li class="item-category choose-category">Tất cả</li>
                                        @foreach($listHero as $hero)
                                            <li class="item-category">{{ $hero['name'] }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-9">
                        <div class="p5l">
                            <div class="row m-0">
                                <div class="item-block m5r h-100 p15 p20t">
                                    <div class="row m-0" style="height: 700px; overflow-y: scroll; overflow-x: hidden">
                                        @foreach([1,2,3,4,5,6,7,8,9,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1] as $item)
                                            <div class="col-2 p15l p15b">
                                                <a href="{{ route(DOTA_DETAIL) }}">
                                                    <div class="d-flex zoom-hover" style="width: 100%; height: 100px">
                                                        <img style="object-fit: fill" src="{{ asset('images/item_dota/set_dota_1.jpg') }}" alt="">
                                                    </div>
                                                    <div class="p5t font-weight-bold">Guise of the Winged Bolt</div>
                                                </a>
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
    <script src="{{ asset('/js/dota/dota.js') }}"></script>
@endsection
