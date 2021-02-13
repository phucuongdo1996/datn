<table id="table-property" class="table table-bordered table-striped border-0 m0">
    <tr class="table-head">
        <th style="width: 30%" class="border-left-0 border-top-0">{{ __('attributes.user_detail.content_7') }}</th>
        <th style="width: 70%" class="border-top-0 border-right-0">{{ __('attributes.user_detail.content_8') }}</th>
    </tr>
    @forelse($property as $item)
    <tr class="table">
        <td class="border-left-0 fs13">{{ $item->property_code }}</td>
        <td class="border-right-0 fs13"><a href="{{ route(ADMIN_PROPERTY_EDIT, $item->id) }}">{{ $item->house_name }}</a></td>
    </tr>
    @empty
        <td colspan="2" class="text-center">{{ __('attributes.common.no_data') }}</td>
    @endforelse
</table>
@if($property->hasPages())
    <div class="card-footer text-right">
        {{ $property->links('partials.simple_paginate', ['totalPage' => $totalPage]) }}
    </div>
@endif
