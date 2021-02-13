<div class="dropdown-menu dropdown-menu-right set-scrollbar">
    @foreach($listProperty as $value)
        <a href="{{ route(USER_SINGLE_ANALYSIS, ['propertyId' => $value['id']]) }}" class="dropdown-item find-property pointer @if($value['id'] == $property['id']) disabled @endif">{{$value['house_name']}}</a>
    @endforeach
</div>
