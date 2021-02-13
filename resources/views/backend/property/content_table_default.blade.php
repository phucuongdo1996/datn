<tr>
    <td class="p20b p20t">
        <div class="content-div content-div-default">
            <div class="row">
                <div class="col-6">
                    <label class="label-list fs16">{{__('attributes.property.house')}} {{ $step }}</label>
                </div>
                <div class="col-6 text-right">
                    @if(!$currentUser->isSubUser() || $currentUser->hasPermission(CHANGE_PROPERTY))
                        <a href="{{ route(USER_PROPERTY_ADD) }}" class="pointer sidebar-list">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </a>
                    @endif
                </div>
            </div>
            <div class="div-img-list">
                <img class="img-list" src="{{ asset('images/default.jpg')  }}" alt="">
            </div>
        </div>
    </td>
    <td class="border-top p20b p20t"><div class="div-grey text-center property-code">&nbsp</div></td>
    <td class="border-top p20b p20t"><div class="div-grey text-right">&nbsp</div></td>
    @if(in_array($currentUser->role, [BROKER, EXPERT]))
        <td class="border-top p20b p20t"><div class="div-grey text-center proprietor">&nbsp</div></td>
    @endif
    <td class="border-top"></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center house-name">&nbsp</div></td>
    <td><div class="div-grey text-center address-city">&nbsp</div></td>
    <td><div class="div-grey text-center detail-real-estate-type">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center house-material">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td class="p20b"><div class="div-grey text-center">&nbsp</div></td>
    <td class="border-top"></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td class="p20b"><div class="div-grey text-center">&nbsp</div></td>
    <td class="border-top"></td>
    <td><div class="div-grey text-center type-rental">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td class="p20b"><div class="div-grey text-center">&nbsp</div></td>
    <td class="border-top"><div class="div-grey text-right">&nbsp</div></td>
    <td class="border-top p20t"><div class="div-grey text-right">&nbsp</div></td>
    <td><div class="div-grey text-right">&nbsp</div></td>
    <td><div class="div-grey text-right">&nbsp</div></td>
    <td class="p20b"><div class="div-grey text-right">&nbsp</div></td>
    <td class="border-top p20t p20b"><div class="div-grey text-center">&nbsp</div></td>
    <td class="border-top p20t"><div class="div-grey text-center">&nbsp</div></td>
    <td class="p20b"><div class="div-grey text-center">&nbsp</div></td>
    <td class="border-top p20t p20b"><div class="div-grey text-center">&nbsp</div></td>
    <td class="border-top p20t p20b"><div class="div-grey text-center">&nbsp</div></td>
    <td class="border-top p20t"><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td class="p20b"><div class="div-grey text-center">&nbsp</div></td>
    <td class="border-top p20t"><div class="div-grey text-center">&nbsp</div></td>
    <td><div class="div-grey text-center">&nbsp</div></td>
    <td class="p20b"><div class="div-grey text-center">&nbsp</div></td>
</tr>
