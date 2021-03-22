@extends('layouts.base')
@section('styles')
@endsection
@section('content')
    @include('layouts.admin_header')
    <div id="mainWrap" class="p80t">
        <div id="main">
            <div id="kvWrap" style="padding-left: 10%; padding-right: 10%; background-color: #f4f6f9">
                <div class="row">
                    <div class="col-3">
                        @include('admin.menu')
                    </div>

                    <div class="col-9">
                        <div class="p5l">
                            <div class="row m-0">
                                <div class="col-12 item-block m5r h-100 p15 p20t">
                                    <div class="row m10t p20l">
                                        <div class="col-12 font-weight-bold fs20">
                                           Thêm thẻ Steam code:
                                        </div>
                                    </div>
                                    <div class="row m15t p20l">
                                        <div class="col-12 row m-0">
                                            <div class="col-4">
                                                <div class="p10r">
                                                    <input type="text" class="form-control" placeholder="Mã thẻ nạp">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="p10r">
                                                    <input type="text" class="form-control" placeholder="Số seri">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="p10r">
                                                    <select name="" id="" class="form-control">
                                                        <option value="">Mệnh giá</option>
                                                        <option value="">100,000</option>
                                                        <option value="">200,000</option>
                                                        <option value="">500,000</option>
                                                        <option value="">1,000,000</option>
                                                        <option value="">2,000,000</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 m10t d-flex justify-content-center">
                                                <button class="btn btn-primary"><i class="fas fa-plus-circle"></i> Thêm thẻ</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 item-block m5r h-100 p15 p20t m10t">
                                    <div class="row m10t p20l">
                                        <div class="col-12 font-weight-bold fs20">
                                           Danh sách thẻ
                                        </div>
                                    </div>
                                    <div class="row m15t p20l">
                                        <div class="col-12 row m0">
                                            <div class="col-4">
                                                <div class="p10r">
                                                    <input type="text" class="form-control" placeholder="Mã thẻ, số seri">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="p10r">
                                                    <select name="" id="" class="form-control">
                                                        <option value="">Mệnh giá</option>
                                                        <option value="">100,000</option>
                                                        <option value="">200,000</option>
                                                        <option value="">500,000</option>
                                                        <option value="">1,000,000</option>
                                                        <option value="">2,000,000</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="p10r">
                                                    <button class="btn btn-primary"><i class="fas fa-search"></i> Tìm kiếm</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 row m-0 m15t overflow-auto" style="height: 400px">
                                            <table id="table-custom" class="table table-bordered table-striped border m0 table-border-custom">
                                                <thead>
                                                <tr>
                                                    <th class="w-10">STT</th>
                                                    <th class="w-25">Mã thẻ</th>
                                                    <th class="w-25">Số seri</th>
                                                    <th class="w-20">Mệnh giá</th>
                                                    <th class="w-20"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(ARRAY_COLOR as $key => $item)
                                                    <tr>
                                                        <td class="text-center">{{ $key }}</td>
                                                        <td class="text-center">
                                                            {{ rand(1111, 9999) }} {{ rand(1111, 9999) }} {{ rand(1111, 9999) }} {{ rand(1111, 9999) }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ rand(1111, 9999) }} {{ rand(1111, 9999) }} {{ rand(1111, 9999) }} {{ rand(1111, 9999) }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{ ['100,000', '200,000', '500,000'][array_rand(['100,000', '200,000', '500,000'], 1)] }}
                                                        </td>
                                                        <td class="text-center">
                                                            <button class="btn btn-danger min-w115"><i class="fas fa-trash-alt"></i> Xoá</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <div class="col-6">
                                                <div id="chart-top-sell"></div>
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
    <script src="{{ asset('js/admin/index.js') }}"></script>
@endsection
