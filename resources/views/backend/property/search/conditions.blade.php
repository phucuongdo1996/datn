<input type="hidden" name="screen" value="search_bank">
<div class="p30 border-top row-search">
    <div class="d-flex m25b m0l">
        <p class="fs16 fw-bold m0">{{ __('attributes.search_bank.area_title') }}</p>
    </div>

    <div class="office row m-0">
        @foreach(OFFICE_AREA as $key => $value)
            @if($key == FLAG_ZERO)
                <input name="area[]" id="area1-all" value="{{ $key == FLAG_FIVE ? trans('attributes.search_bank.area.tokyo_metropolitan_area_2') : $value }}"
                       type="checkbox" {{ handlingCheckbox($key == FLAG_FIVE ? trans('attributes.search_bank.area.tokyo_metropolitan_area_2') : $value, $params, 'area') }} class="check-all">
                <label for="area1-all">{{ $value }}</label>
            @else
                <input name="area[]" id="area1-{{$key}}" value="{{ $key == FLAG_FIVE ? trans('attributes.search_bank.area.tokyo_metropolitan_area_2') : $value }}"
                type="checkbox" {{ handlingCheckbox($key == FLAG_FIVE ? trans('attributes.search_bank.area.tokyo_metropolitan_area_2') : $value, $params, 'area') }} class="check-on-off">
                <label for="area1-{{$key}}">{{ $value }}</label>
            @endif
        @endforeach
    </div>

    <div class="housing row m-0">
        @foreach(HOUSE_AREA as $key => $value)
            @if($key == FLAG_ZERO)
                <input name="area[]" id="area2-all" value="{{ $key == FLAG_THREE ? trans('attributes.search_bank.area.tokyo_metropolitan_area_2') : $value }}"
                       type="checkbox" {{ handlingCheckbox($key == FLAG_THREE ? trans('attributes.search_bank.area.tokyo_metropolitan_area_2') : $value, $params, 'area') }} class="check-all">
                <label for="area2-all">{{ $value }}</label>
            @else
                <input name="area[]" id="area2-{{$key}}" value="{{ $key == FLAG_THREE ? trans('attributes.search_bank.area.tokyo_metropolitan_area_2') : $value }}"
                       type="checkbox" {{ handlingCheckbox($key == FLAG_THREE ? trans('attributes.search_bank.area.tokyo_metropolitan_area_2') : $value, $params, 'area') }} class="check-on-off">
                <label for="area2-{{$key}}">{{ $value }}</label>
            @endif
        @endforeach
    </div>

    <div class="shop row m-0">
        @foreach(SHOP_AREA as $key => $value)
            @if($key == FLAG_ZERO)
                <input name="area[]" id="area3-all" value="{{ $value }}" type="checkbox" {{ handlingCheckbox($value, $params, 'area') }} class="check-all"><label for="area3-all">{{ $value }}</label>
            @else
                <input name="area[]" id="area3-{{$key}}" value="{{ $value }}" {{ handlingCheckbox($value, $params, 'area') }} type="checkbox" class="check-on-off"><label for="area3-{{$key}}">{{ $value }}</label>
            @endif
        @endforeach
    </div>

    <div class="logiIndustry row m-0">
        @foreach(INDUSTRY_AND_HOTEL_AREA as $key => $value)
            @if($key == FLAG_ZERO)
                <input name="area[]" id="area4-all" value="{{ $value }}" type="checkbox" {{ handlingCheckbox($value, $params, 'area') }} class="check-all"><label for="area4-all">{{ $value }}</label>
            @else
                <input name="area[]" id="area4-{{$key}}" value="{{ $value }}" {{ handlingCheckbox($value, $params, 'area') }} type="checkbox" class="check-on-off"><label for="area4-{{$key}}">{{ $value }}</label>
            @endif
        @endforeach
    </div>

    <div class="hotel row m-0">
        @foreach(INDUSTRY_AND_HOTEL_AREA as $key => $value)
            @if($key == FLAG_ZERO)
                <input name="area[]" id="area5-all" value="{{ $value }}" type="checkbox" {{ handlingCheckbox($value, $params, 'area') }} class="check-all"><label for="area5-all">{{ $value }}</label>
            @else
                <input name="area[]" id="area5-{{$key}}" value="{{ $value }}" {{ handlingCheckbox($value, $params, 'area') }} type="checkbox" class="check-on-off"><label for="area5-{{$key}}">{{ $value }}</label>
            @endif
        @endforeach
    </div>
</div>

<div class="p30 border-top row-search">
    <div class="d-flex m30b m0l">
        <p class="fs16 fw-bold m0">{{ __('attributes.search_bank.total_floor_area') }}</p>
    </div>

    <div class="office row m-0">
        @foreach(OFFICE_TOTAL_AREA_FLOOR as $key => $value)
            @if($key == FLAG_ZERO)
                <input name="total_floor_area[]" id="architectural_area1-all" value="{{ $value }}" type="checkbox" {{ handlingCheckbox($value, $params, 'total_floor_area') }} class="check-all"><label for="architectural_area1-all">{{ $value }}</label>
            @else
                <input name="total_floor_area[]" id="architectural_area1-{{ $key }}" value="{{ $value }}" type="checkbox" {{ handlingCheckbox($value, $params, 'total_floor_area') }} class="check-on-off"><label for="architectural_area1-{{ $key }}">{{ $value }}</label>
            @endif
        @endforeach
    </div>

    <div class="housing row m-0">
        @foreach(HOUSE_TOTAL_AREA_FLOOR as $key => $value)
            @if($key == FLAG_ZERO)
                <input name="total_floor_area[]" id="architectural_area2-all" value="{{ $value }}" type="checkbox" {{ handlingCheckbox($value, $params, 'total_floor_area') }} class="check-all"><label for="architectural_area2-all">{{ $value }}</label>
            @else
                <input name="total_floor_area[]" id="architectural_area2-{{ $key }}" value="{{ $value }}" type="checkbox" {{ handlingCheckbox($value, $params, 'total_floor_area') }} class="check-on-off"><label for="architectural_area2-{{ $key }}">{{ $value }}</label>
            @endif
        @endforeach
    </div>

    <div class="shop row m-0">
        @foreach(SHOP_TOTAL_AREA_FLOOR as $key => $value)
            @if($key == FLAG_ZERO)
                <input name="total_floor_area[]" id="architectural_area3-all" value="{{ $value }}" type="checkbox" {{ handlingCheckbox($value, $params, 'total_floor_area') }} class="check-all"><label for="architectural_area3-all">{{ $value }}</label>
            @else
                <input name="total_floor_area[]" id="architectural_area3-{{ $key }}" value="{{ $value }}" type="checkbox" {{ handlingCheckbox($value, $params, 'total_floor_area') }} class="check-on-off"><label for="architectural_area3-{{ $key }}">{{ $value }}</label>
            @endif
        @endforeach
    </div>

    <div class="logiIndustry row m-0">
        @foreach(INDUSTRY_AND_HOTEL_TOTAL_AREA_FLOOR as $key => $value)
            @if($key == FLAG_ZERO)
                <input name="total_floor_area[]" id="architectural_area4-all" value="{{ $value }}" type="checkbox" {{ handlingCheckbox($value, $params, 'total_floor_area') }} class="check-all"><label for="architectural_area4-all">{{ $value }}</label>
            @else
                <input name="total_floor_area[]" id="architectural_area4-{{ $key }}" value="{{ $value }}" type="checkbox" {{ handlingCheckbox($value, $params, 'total_floor_area') }} class="check-on-off"><label for="architectural_area4-{{ $key }}">{{ $value }}</label>
            @endif
        @endforeach
    </div>

    <div class="hotel row m-0">
        @foreach(INDUSTRY_AND_HOTEL_TOTAL_AREA_FLOOR as $key => $value)
            @if($key == FLAG_ZERO)
                <input name="total_floor_area[]" id="architectural_area5-all" value="{{ $value }}" type="checkbox" {{ handlingCheckbox($value, $params, 'total_floor_area') }} class="check-all"><label for="architectural_area5-all">{{ $value }}</label>
            @else
                <input name="total_floor_area[]" id="architectural_area5-{{ $key }}" value="{{ $value }}" type="checkbox" {{ handlingCheckbox($value, $params, 'total_floor_area') }} class="check-on-off"><label for="architectural_area5-{{ $key }}">{{ $value }}</label>
            @endif
        @endforeach
    </div>
</div>

<div class="p30 border-top row-search">
    <div class="d-flex m30b m0l">
        <p class="fs16 fw-bold m0">{{ __('attributes.search_bank.age') }}</p>
    </div>

    <div class="office row m-0">
        @foreach(OFFICE_AND_SHOP_AGE as $key => $value)
            @if($key == FLAG_ZERO)
                <input name="house_longevity[]" id="age1-all" value="{{ $value }}" {{ handlingCheckbox($value, $params, 'house_longevity') }} type="checkbox" class="check-all"><label for="age1-all">{{ $value }}</label>
            @else
                <input name="house_longevity[]" id="age1-{{ $key }}" value="{{ $value  }}" {{ handlingCheckbox($value, $params, 'house_longevity') }} type="checkbox" class="check-on-off"><label for="age1-{{ $key }}">{{ $value }}</label>
            @endif
        @endforeach
    </div>

    <div class="housing row m-0">
        @foreach(HOUSE_AGE as $key => $value)
            @if($key == FLAG_ZERO)
                <input name="house_longevity[]" id="age2-all" value="{{ $value }}" {{ handlingCheckbox($value, $params, 'house_longevity') }} type="checkbox" class="check-all"><label for="age2-all">{{ $value }}</label>
            @else
                <input name="house_longevity[]" id="age2-{{ $key }}" value="{{ $value  }}" {{ handlingCheckbox($value, $params, 'house_longevity') }} type="checkbox" class="check-on-off"><label for="age2-{{ $key }}">{{ $value }}</label>
            @endif
        @endforeach
    </div>

    <div class="shop row m-0">
        @foreach(OFFICE_AND_SHOP_AGE as $key => $value)
            @if($key == FLAG_ZERO)
                <input name="house_longevity[]" id="age3-all" value="{{ $value }}" {{ handlingCheckbox($value, $params, 'house_longevity') }} type="checkbox" class="check-all"><label for="age3-all">{{ $value }}</label>
            @else
                <input name="house_longevity[]" id="age3-{{ $key }}" value="{{ $value  }}" {{ handlingCheckbox($value, $params, 'house_longevity') }} type="checkbox" class="check-on-off"><label for="age3-{{ $key }}">{{ $value }}</label>
            @endif
        @endforeach
    </div>

    <div class="logiIndustry row m-0">
        @foreach(INDUSTRY_AND_HOTEL_AGE as $key => $value)
            @if($key == FLAG_ZERO)
                <input name="house_longevity[]" id="age4-all" value="{{ $value }}" {{ handlingCheckbox($value, $params, 'house_longevity') }} type="checkbox" class="check-all"><label for="age4-all">{{ $value }}</label>
            @else
                <input name="house_longevity[]" id="age4-{{ $key }}" value="{{ $value  }}" {{ handlingCheckbox($value, $params, 'house_longevity') }} type="checkbox" class="check-on-off"><label for="age4-{{ $key }}">{{ $value }}</label>
            @endif
        @endforeach
    </div>

    <div class="hotel row m-0">
        @foreach(INDUSTRY_AND_HOTEL_AGE as $key => $value)
            @if($key == FLAG_ZERO)
                <input name="house_longevity[]" id="age5-all" value="{{ $value }}" {{ handlingCheckbox($value, $params, 'house_longevity') }} type="checkbox" class="check-all"><label for="age5-all">{{ $value }}</label>
            @else
                <input name="house_longevity[]" id="age5-{{ $key }}" value="{{ $value  }}" {{ handlingCheckbox($value, $params, 'house_longevity') }} type="checkbox" class="check-on-off"><label for="age5-{{ $key }}">{{ $value }}</label>
            @endif
        @endforeach
    </div>
</div>
