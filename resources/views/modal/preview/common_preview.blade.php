<table class="table-wrapper">
    {{--    fixed_header--}}
    <thead><tr><td class="td-header">
            <div class="header-space p30b">
                <div class="centered-vertical">
                    <h6 class="modal-title fs16 w-50 fw-bold">@yield('title')</h6>
                    <span class="text-right w-50">{{getdate()['year'].__('attributes.common.year').getdate()['mon'].__('attributes.common.month').getdate()['mday'].__('attributes.common.day')}}</span>
                </div>
                <p class="text-right m0">{{__('attributes.property.copy_right')}}</p>
            </div>
    </td></tr></thead>
    {{--    body_content--}}
    <tbody><tr><td class="td-body">
            @yield('content_preview')
    </td></tr></tbody>
</table>
