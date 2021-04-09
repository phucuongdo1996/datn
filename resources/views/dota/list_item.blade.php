@extends('layouts.base')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dota/common.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dota/list_item.min.css') }}">
@endsection
@section('content')
    @include('layouts.header')

    <div id="mainWrap" class="p80t">
        <div id="main">
            <div id="kvWrap" style="padding-left: 10%; padding-right: 10%;">
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
                                        <a href="{{ route(DOTA_LIST_ITEM) }}">
                                            <li class="item-category font-weight-bold active">Tất cả</li>
                                        </a>
                                        @foreach($listCategory as $item)
                                            <a href="{{ route(DOTA_LIST_ITEM, ['category_id' => $item['id']]) }}">
                                                <li class="item-category font-weight-bold">{{ $item['name'] }}</li>
                                            </a>
                                        @endforeach
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
                                <div class="col-12 item-block m5r h-100 p15 p20t" style="">
                                    <div id="paginate" class="d-flex justify-content-end m10t m20b">
                                        {{ $listItems->links() }}
                                    </div>
                                    <div style="height: 700px; overflow-y: auto; overflow-x: hidden">
                                        <div class="row m-0" >
                                            @forelse($listItems as $item)
                                                @include('dota.product_item', ['type' => 'collection'])
                                            @empty
                                                <div class="col-12 d-flex justify-content-center p15l p15b">
                                                    <span class="fs20">Không có dữ liệu phù hợp</span>
                                                </div>
                                            @endforelse
                                        </div>
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
