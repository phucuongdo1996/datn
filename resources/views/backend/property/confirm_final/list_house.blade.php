@if($listProperty->count() == 0)
    <li class="m10l text-primary break-all">{{ trans('attributes.tax.empty_house') }}</li>
@else
    @foreach($listProperty as $value)
        <li>
            <a href="#" class="color-title-chart parent-checkbox" data-value="{{ $value->id }}" tabIndex="-1">
                <div class="row m10l">
                    <div class="col-2 p3t div-checkbox-house">
                        <label class="container-input fw-normal borrowing-left">
                            <input style="display: block" data-id="{{ $value->id }}"
                                   @if(isset($data->dataProperty))
                                   {{ in_array($value->id , $data->dataProperty->toArray()) ?  'checked' : '' }}
                                   @endif
                                   class="checkbox-choose-house" type="checkbox"/>
                            <span class="checkmark"></span>
                        </label>
                    </div>
                    <div class="col-9 div-label-house">{{$value->house_name}}</div>
                </div>
            </a>
        </li>
    @endforeach
@endif
