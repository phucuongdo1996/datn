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
                                    <div class="row m20t p20l p10b">
                                        <div class="col-12">
                                            <div id="chart-income"></div>
                                        </div>
                                        <div class="col-12 row m0 m10t">
                                            <div class="col-6 row">
                                                <div class="col-6 d-flex justify-content-center align-items-center font-weight-bold">
                                                    Tổng doanh thu tháng này:
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" class="form-control" value="150,000,000">
                                                </div>
                                            </div>
                                            <div class="col-6 row">
                                                <div class="col-6 d-flex justify-content-center align-items-center font-weight-bold">
                                                    Tổng doanh thu tháng trước:
                                                </div>
                                                <div class="col-6">
                                                    <input type="text" class="form-control" value="150,000,000">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-0 m10t">
                                <div class="col-12 item-block m5r h-100 p15 p20t">
                                    <div class="row m20t p20l">
                                        <div class="col-12 font-weight-bold fs20">
                                           Sản phẩm giao dịch nhiều nhất:
                                        </div>
                                    </div>
                                    <div class="row m15t p20l">
                                        <div class="col-12 row m-0">
                                            <div class="col-6 d-flex align-items-center">
                                                    <table id="table-custom" class="table table-bordered table-striped border m0 table-border-custom">
                                                        <thead>
                                                        <tr>
                                                            <th class="w-20">STT</th>
                                                            <th class="w-40">Tên sản phẩm</th>
                                                            <th class="w-40">Số giao dịch</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach(ARRAY_COLOR_1 as $key => $item)
                                                            <tr>
                                                                <td class="text-center">{{ $key }}</td>
                                                                <td><i class="fas fa-circle m10r" style="color: {{ $item }}"></i> Sản phẩm {{ $key }}</td>
                                                                <td class="text-right">{{ 1000 - $key*10 }}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                            </div>
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
