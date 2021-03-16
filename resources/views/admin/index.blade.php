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
                                <div class="col-12 item-block m5r h-100 p15 p20t" style="min-height: 600px">
                                    <div class="row m20t p20l">
                                        <div class="col-12">
                                            <div id="chart-income"></div>
                                        </div>
                                    </div>
                                    <div class="row m20t p20l">
                                        <div class="col-12 font-weight-bold fs16">
                                           Sản phẩm giao dịch nhiều nhất:
                                        </div>
                                    </div>
                                    <div class="row m15t p20l">
                                        <div class="col-6">
                                            <div class="row m0">
                                                <table id="table-custom" class="table table-bordered table-striped border m0 table-border-custom">
                                                    <thead>
                                                    <tr>
                                                        <th class="w-10">STT</th>
                                                        <th class="w-40">Tên sản phẩm</th>
                                                        <th class="w-20">Số giao dịch</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center">1</td>
                                                            <td>Sản phẩm 1</td>
                                                            <td class="text-right">202</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
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
            </div><!-- kvWrap -->
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/admin/index.js') }}"></script>
@endsection
