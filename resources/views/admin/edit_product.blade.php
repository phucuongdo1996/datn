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
                                           Sản phẩm mới cập nhật:
                                        </div>
                                    </div>
                                    <div class="row m15t p20l">
                                        <div class="col-12 row m-0">
                                            <table id="table-custom" class="table table-bordered table-striped border m0 table-border-custom">
                                                <thead>
                                                <tr>
                                                    <th class="w-20">Mã sản phẩm</th>
                                                    <th class="w-60">Tên sản phẩm</th>
                                                    <th class="w-20"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(ARRAY_COLOR_1 as $key => $item)
                                                    <tr>
                                                        <td class="text-center">{{ $key }}</td>
                                                        <td>Sản phẩm {{ $key }}</td>
                                                        <td class="text-center">
                                                            <button class="btn btn-danger min-w115"><i class="fas fa-trash-alt"></i> Xoá</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control">
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control">
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-primary min-w115"><i class="fas fa-plus-circle"></i> Thêm</button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="col-6">
                                                <div id="chart-top-sell"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 item-block m5r h-100 p15 p20t m10t">
                                    <div class="row m10t p20l">
                                        <div class="col-12 font-weight-bold fs20">
                                            Sản phẩm bán chạy nhất:
                                        </div>
                                    </div>
                                    <div class="row m15t p20l">
                                        <div class="col-12 row m-0">
                                            <table id="table-custom" class="table table-bordered table-striped border m0 table-border-custom">
                                                <thead>
                                                <tr>
                                                    <th class="w-20">Mã sản phẩm</th>
                                                    <th class="w-60">Tên sản phẩm</th>
                                                    <th class="w-20"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(ARRAY_COLOR_1 as $key => $item)
                                                    <tr>
                                                        <td class="text-center">{{ $key }}</td>
                                                        <td>Sản phẩm {{ $key }}</td>
                                                        <td class="text-center">
                                                            <button class="btn btn-danger min-w115"><i class="fas fa-trash-alt"></i> Xoá</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control">
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control">
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-primary min-w115"><i class="fas fa-plus-circle"></i> Thêm</button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="col-6">
                                                <div id="chart-top-sell"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 item-block m5r h-100 p15 p20t m10t">
                                    <div class="row m10t p20l">
                                        <div class="col-12 font-weight-bold fs20">
                                            Sản phẩm đáng chú ý:
                                        </div>
                                    </div>
                                    <div class="row m15t p20l">
                                        <div class="col-12 row m-0">
                                            <table id="table-custom" class="table table-bordered table-striped border m0 table-border-custom">
                                                <thead>
                                                <tr>
                                                    <th class="w-20">Mã sản phẩm</th>
                                                    <th class="w-60">Tên sản phẩm</th>
                                                    <th class="w-20"></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach(ARRAY_COLOR_1 as $key => $item)
                                                    <tr>
                                                        <td class="text-center">{{ $key }}</td>
                                                        <td>Sản phẩm {{ $key }}</td>
                                                        <td class="text-center">
                                                            <button class="btn btn-danger min-w115"><i class="fas fa-trash-alt"></i> Xoá</button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control">
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" class="form-control">
                                                    </td>
                                                    <td class="text-center">
                                                        <button class="btn btn-primary min-w115"><i class="fas fa-plus-circle"></i> Thêm</button>
                                                    </td>
                                                </tr>
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
