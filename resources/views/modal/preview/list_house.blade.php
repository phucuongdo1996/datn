@extends('modal.preview.common_preview')
@section('title', __('attributes.property.list_house') )
@section('content_preview')
    <div id="preview-list-house" class="background-print">
        <div class="content-preview">
            @if($countProperty < 4)
                @include('modal.preview.table_preview_house', ['properties' => $properties, 'indexNo' => $stepNumber + 1, 'start' => 0, 'length' => 4])
            @else
                @php( $subProperty = $properties->chunk(4))
                @include('modal.preview.table_preview_house', ['properties' => $subProperty[0], 'indexNo' => $stepNumber + 1, 'start' => 0, 'length' => 4])
                @if(isset($subProperty[1]))
                    @include('modal.preview.table_preview_house', ['properties' => $subProperty[1], 'indexNo' => $stepNumber + 1 , 'start' => 4, 'length' => 7])
                @endif
            @endif
        </div>
    </div>
@endsection
