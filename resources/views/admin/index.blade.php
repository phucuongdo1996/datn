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
                                                    <input name="revenue_index_month" type="text" class="form-control convert-data" value="150,000,000" readonly>
                                                </div>
                                            </div>
                                            <div class="col-6 row">
                                                <div class="col-6 d-flex justify-content-center align-items-center font-weight-bold">
                                                    Tổng doanh thu tháng trước:
                                                </div>
                                                <div class="col-6">
                                                    <input name="revenue_last_month" type="text" class="form-control convert-data" value="150,000,000" readonly>
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
                                                            <th class="w-10">STT</th>
                                                            <th class="w-20">Mã sản phẩm gốc</th>
                                                            <th class="w-40">Tên sản phẩm</th>
                                                            <th class="w-30">Số giao dịch</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($dataPieChart as $key => $item)
                                                            <tr>
                                                                <td class="text-center">{{ $key }}</td>
                                                                <td class="text-center">{{ $item->id }}</td>
                                                                <td><i class="fas fa-circle m10r" style="color: {{ $item->color }}"></i>{{ $item->name }}</td>
                                                                <td class="text-right">{{ $item->y}}</td>
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
    <script>
        let dataPieChart = {!! json_encode($dataPieChart) !!}
    </script>
    <script src="{{ asset('js/admin/index.js') }}"></script>
@endsection
