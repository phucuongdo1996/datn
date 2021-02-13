@extends('layout.home.master')
@section('styles')
    <link rel="stylesheet" href="{{ asset('/css/preview/property_list_house_preview.css') }}">
@endsection
@section('content')
    <div class="content">
        <div class="list-house">
            <div class="row p0 m0 media-575-p20l media-575-p20r m0lr-sp">
                <div class="col-12 col-sm-4 text-left list-house-title group-btn p0lr-sp">
                    <div class="row m0lr-sp">
                        <div class="col-7 p10t p0">
                            <h3 class="title">{{__('attributes.property.list_house')}}</h3>
                        </div>
                        @if(!$currentUser->isSubUser() || $currentUser->hasPermission(CHANGE_PROPERTY))
                            <div class="col-5 text-right d-block d-sm-none p0">
                                <a href="{{ route(USER_PROPERTY_ADD) }}" class="btn custom-btn-default fs13-sp m5t fs15">{{__('attributes.property.register_info_house')}}</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-12 col-sm-8 text-sm-right text-center group-btn">
                    @if(!$currentUser->isSubUser())
                        <select name="subuser_id" class="btn custom-btn-default fs13-sp m5t d-none d-sm-inline-block fs15 filter-list-house" style="padding-top: .5rem; padding-bottom: .5rem; ">
                            <option value="">{{ trans('attributes.property.filter_sub_user')}}</option>
                            @foreach($listSubUser as $item)
                                <option value="{{ $item['id'] }}" @if(isset($params['subuser_id']) && $params['subuser_id'] == $item['id']) selected @endif>{{ $item['profile']['person_charge_last_name'] . $item['profile']['person_charge_first_name'] }}</option>
                            @endforeach
                        </select>
                    @endif
                    @if(!$currentUser->isSubUser() || $currentUser->hasPermission(CHANGE_PROPERTY))
                        <a href="{{ route(USER_PROPERTY_ADD) }}" class="btn custom-btn-default d-none d-sm-inline-block fs13-sp m7l m5t fs15">{{__('attributes.property.register_info_house')}}</a>
                    @endif
                    <a href="{{ route(USER_PROPERTY_PORTFOLIO_ANALYSIS) }}" class="btn custom-btn-default d-none d-sm-inline-block fs13-sp m7l m5t fs15">{{__('attributes.property.portfolio_analysis')}}</a>
                    <a href="{{ route(USER_BORROWING) }}" class="btn custom-btn-default d-none d-sm-inline-block fs13-sp m7l m5t fs15">{{__('attributes.property.list_status_owe')}}</a>
                    <a href="javascript:;" class="btn custom-btn-success btn-preview-house d-none d-sm-inline-block fs13-sp m7l m5t fs15">{{__('attributes.property.display_preview')}}</a>
                    @if ($properties->hasMorePages())
                        @if ($properties->onFirstPage())
                            <a href="#" onclick="return false;" class="btn custom-btn-pagination disabled m5t m16l">
                                <i class="icon-paginate fa fa-angle-left" aria-hidden="true"></i>
                            </a>
                        @else
                            <a href="{{ $properties->previousPageUrl().'&subuser_id='.$params['subuser_id'].'&proprietor='.$params['proprietor'] }}"
                               class="btn custom-btn-default m5t m16l">
                                <i class="icon-paginate fa fa-angle-left" aria-hidden="true"></i>
                            </a>
                        @endif
                        <span class="btn fs15 text-black m5t">{{ $properties->currentPage() }}/{{ $properties->lastPage() }}</span>
                        <a href="{{ $properties->nextPageUrl().'&subuser_id='.$params['subuser_id'].'&proprietor='.$params['proprietor'] }}" class="btn custom-btn-default m5t"><i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i></a>
                    @else
                        @if ($properties->onFirstPage())
                            <a href="#" onclick="return false;" class="btn custom-btn-pagination disabled m5t m16l">
                                <i class="icon-paginate fa fa-angle-left" aria-hidden="true"></i>
                            </a>
                        @else
                            <a href="{{ $properties->previousPageUrl().'&subuser_id='.$params['subuser_id'].'&proprietor='.$params['proprietor'] }}"
                               class="btn custom-btn-default m5t m16l">
                                <i class="icon-paginate fa fa-angle-left" aria-hidden="true"></i>
                            </a>
                        @endif
                        @if (($countProperty == FLAG_ZERO && $properties->total() > FLAG_ZERO) || $countProperty == FLAG_SEVEN )
                            <span class="btn fs15 text-black m5t">{{ $properties->currentPage() }}/{{ $properties->lastPage() + FLAG_ONE }}</span>
                                @if($properties->currentPage() == $properties->lastPage() + FLAG_ONE)
                                    <a href="#" onclick="return false;" class="btn custom-btn-pagination disabled m5t"><i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i></a>
                                @elseif ($properties->currentPage() == $properties->lastPage())
                                    <a href="{{ route(USER_PROPERTY_INDEX, ['page'=> $properties->lastPage() + FLAG_ONE]) }}" class="btn custom-btn-default m5t"><i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i></a>
                                @else
                                    <a href="{{ $properties->nextPageUrl().'&subuser_id='.$params['subuser_id'].'&proprietor='.$params['proprietor'] }}" class="btn custom-btn-default m5t"><i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i></a>
                                @endif
                        @else
                            <span class="btn fs15 text-black m5t">{{ $properties->currentPage() }}/{{ $properties->lastPage()}}</span>
                                @if($properties->currentPage() == $properties->lastPage())
                                    <a href="#" onclick="return false;" class="btn custom-btn-pagination disabled m5t"><i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i></a>
                                @else
                                    <a href="{{ $properties->nextPageUrl().'&subuser_id='.$params['subuser_id'].'&proprietor='.$params['proprietor'] }}" class="btn custom-btn-default m5t"><i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i></a>
                                @endif
                        @endif
                    @endif
                </div>
            </div>
            @include('partials.flash_messages')
            <div class="d-none">{{ $stepNumber = ($properties->currentPage() - 1) * 7  }}</div>
            <div class="content">
                <table id="table-list-house" class="table-list-house table table-borderless">
                    @include('backend.property.title_table')
                    @if ($countProperty == 0)
                        @for ($i = 0; $i < 7; $i++)
                            @include('backend.property.content_table_default', ['step' =>  $stepNumber + $i + 1 ])
                        @endfor
                    @elseif ($countProperty < 7)
                        @foreach($properties as $property)
                            @include('backend.property.content_table', ['step' =>  $stepNumber + $loop->index + 1 ])
                        @endforeach
                        @for ($i = 0; $i < 7 - $countProperty; $i++)
                                @include('backend.property.content_table_default', ['step' =>  $stepNumber + $countProperty +1 + $i])
                        @endfor
                    @elseif ($countProperty  == 7)
                        @foreach($properties as $property)
                            @include('backend.property.content_table', ['step' =>  $stepNumber + $loop->index + 1 ])
                        @endforeach
                    @endif
                </table>
            </div>

            <div id="pagination-bottom" class="row text-center text-md-left media-575-p20l media-575-p20r m0lr-sp">
                <div class="col-12 text-left d-block d-sm-none p0lr-sp">
                    <a href="{{ route(USER_PROPERTY_PORTFOLIO_ANALYSIS) }}" class="btn custom-btn-default fs13-sp m7r m5t fs15">{{__('attributes.property.portfolio_analysis')}}</a>
                    <a href="{{ route(USER_BORROWING) }}" class="btn custom-btn-default fs13-sp m7r m5t fs15">{{__('attributes.property.list_status_owe')}}</a>
                </div>
                <div class="col-12 text-center text-sm-right group-btn media-575-p20t">
                    @if(!$currentUser->isSubUser() || $currentUser->hasPermission(CHANGE_PROPERTY))
                        <a href="{{ route(USER_PROPERTY_ADD) }}" class="btn custom-btn-default d-none d-sm-inline-block fs13-sp m5t fs15">{{__('attributes.property.register_info_house')}}</a>
                    @endif
                    <a href="{{ route(USER_PROPERTY_PORTFOLIO_ANALYSIS) }}" class="btn custom-btn-default d-none d-sm-inline-block fs13-sp m7l m5t fs15">{{__('attributes.property.portfolio_analysis')}}</a>
                    <a href="{{ route(USER_BORROWING) }}" class="btn custom-btn-default d-none d-sm-inline-block fs13-sp m7l m5t fs15">{{__('attributes.property.list_status_owe')}}</a>
                    <a class="btn custom-btn-success btn-preview-house d-none d-sm-inline-block fs13-sp m5t m7l fs15">{{__('attributes.property.display_preview')}}</a>
                    @if ($properties->hasMorePages())
                        @if ($properties->onFirstPage())
                            <a href="#" onclick="return false;" class="btn custom-btn-pagination disabled m5t m16l">
                                <i class="icon-paginate fa fa-angle-left" aria-hidden="true"></i>
                            </a>
                        @else
                            <a href="{{ $properties->previousPageUrl().'&subuser_id='.$params['subuser_id'].'&proprietor='.$params['proprietor'] }}"
                               class="btn custom-btn-default m5t m16l">
                                <i class="icon-paginate fa fa-angle-left" aria-hidden="true"></i>
                            </a>
                        @endif
                        <span class="btn fs15 text-black m5t">{{ $properties->currentPage() }}/{{ $properties->lastPage() }}</span>
                        <a href="{{ $properties->nextPageUrl() .'&subuser_id='.$params['subuser_id'].'&proprietor='.$params['proprietor'] }}" class="btn custom-btn-default m5t"><i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i></a>
                    @else
                        @if ($properties->onFirstPage())
                            <a href="#" onclick="return false;" class="btn custom-btn-pagination disabled m5t m16l">
                                <i class="icon-paginate fa fa-angle-left" aria-hidden="true"></i>
                            </a>
                        @else
                            <a href="{{ $properties->previousPageUrl().'&subuser_id='.$params['subuser_id'].'&proprietor='.$params['proprietor'] }}"
                               class="btn custom-btn-default m5t m16l">
                                <i class="icon-paginate fa fa-angle-left" aria-hidden="true"></i>
                            </a>
                        @endif
                        @if (($countProperty == FLAG_ZERO && $properties->total() > FLAG_ZERO) || $countProperty == FLAG_SEVEN )
                            <span class="btn fs15 text-black m5t">{{ $properties->currentPage() }}/{{ $properties->lastPage() + FLAG_ONE }}</span>
                            @if($properties->currentPage() == $properties->lastPage() + FLAG_ONE)
                                <a href="#" onclick="return false;" class="btn custom-btn-pagination disabled m5t"><i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i></a>
                            @elseif ($properties->currentPage() == $properties->lastPage())
                                <a href="{{ route(USER_PROPERTY_INDEX, ['page'=> $properties->lastPage() + FLAG_ONE]) }}" class="btn custom-btn-default m5t"><i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i></a>
                            @else
                                <a href="{{ $properties->nextPageUrl().'&subuser_id='.$params['subuser_id'].'&proprietor='.$params['proprietor'] }}" class="btn custom-btn-default m5t"><i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i></a>
                            @endif
                        @else
                            <span class="btn fs15 text-black m5t">{{ $properties->currentPage() }}/{{ $properties->lastPage() }}</span>
                            @if($properties->currentPage() == $properties->lastPage())
                                <a href="#" onclick="return false;" class="btn custom-btn-pagination disabled m5t"><i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i></a>
                            @else
                                <a href="{{ $properties->nextPageUrl().'&subuser_id='.$params['subuser_id'].'&proprietor='.$params['proprietor'] }}" class="btn custom-btn-default m5t"><i class="icon-paginate fa fa-angle-right" aria-hidden="true"></i></a>
                            @endif
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('modal.confirm_delete_house')
    @include('modal.preview.list_house')
@endsection
@section('js')
    <script src="{{ asset('dist/js/property.min.js') }}"></script>
@endsection

