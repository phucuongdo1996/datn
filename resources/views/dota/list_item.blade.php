@extends('layouts.base')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dota/common.css') }}">
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
                                <form action="{{ route(DOTA_LIST_ITEM) }}" method="GET" class="col-12 row item-block m5r h-100 p20">
                                    <div class="col-6 p10lr m10b">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-4 d-flex align-items-center"><label class="fs18">Tên sản phẩm</label></div>
                                                <div class="col-8"><input name="product_name" class="form-control" type="text" value="{{ $params['product_name'] ?? '' }}"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 p10lr m10b">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-4 d-flex align-items-center"><label class="fs18">Tướng sở hữu</label></div>
                                                <div class="col-8">
                                                    <select name="hero_id" class="form-control">
                                                        @foreach($listHero as $item)
                                                        <option value="{{ $item['id'] }}" @if(isset($params['hero_id']) && $params['hero_id'] == $item['id']) selected @endif>{{ $item['name'] }}</option>
                                                        @endforeach
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
                                                        <input name="price_from" type="text" class="form-control text-right convert-data" value="{{ $params['price_from'] ?? '' }}" placeholder="1,000">
                                                    </div>
                                                    <div class="w-10 d-flex justify-content-center align-items-center"> ~ </div>
                                                    <div class="w-45">
                                                        <input name="price_to" type="text" class="form-control text-right convert-data" value="{{ $params['price_to'] ?? '' }}" placeholder="1,000,000">
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center m10t">
                                        <button type="submit" class="btn btn-primary"> <i class="fas fa-search"></i> Kết quả</button>
                                    </div>
                                </form>
                            </div>
                            <div class="row m-0">
                                <div class="col-12 item-block m5r h-100 p15 p20t">
                                    <div id="paginate" class="d-flex justify-content-end m10t m20b">
                                        {{ $listItems->links() }}
                                    </div>
                                    <div class="row m-0" style="height: 700px; overflow-y: auto; overflow-x: hidden">
                                        @forelse($listItems as $item)
                                            <div class="col-2 p15l p15b">
                                                <div class="d-flex zoom-hover" style="width: 100%; height: 100px">
                                                    <img style="object-fit: fill" src="{{ asset(URL_DOTA_IMAGES_ITEM . $item->productBase->image) }}" alt="">
                                                </div>
                                                <div class="p5t font-weight-bold">{{ $item->productBase->name }}</div>
                                                <a href="#" class="p5t hero-hover"> - {{ $item->productBase->hero->name ?? '' }}</a>
                                                <div class="p5t font-weight-bold text-blue">{{ number_format($item->price) }}</div>
                                            </div>
                                        @empty
                                            <div class="col-12 d-flex justify-content-center p15l p15b">
                                               <span class="fs20">Không có dữ liệu phù hợp</span>
                                            </div>
                                        @endforelse
                                    </div>
                                    <div id="paginate" class="d-flex justify-content-end p20t p10b">
                                        {{ $listItems->links() }}
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
