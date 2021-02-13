<div class="card-header">
    <h3 class="card-title">{{ __('attributes.user_detail.title_10') }}</h3>
    <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i>
        </button>
    </div>
</div>
<div class="card-body p-0">
    <div class="row m0 br10 bg-white">
        <div class="table-responsive">
            <table id="table-property" class="table table-bordered table-striped border-0 m0">
                <tr class="table-head">
                    <td class="border-0 wp60"><div>{{ __('attributes.user_detail.content_24') }}</div></td>
                    <td class="border-top-0"><div>{{ __('attributes.user_detail.content_25') }}</div></td>
                    <td class="border-top-0"><div class="w20"></div></td>
                </tr>
                @php($index = FLAG_ZERO)
                @forelse($topics as $topic)
                    @php($index ++)
                    <tr class="table">
                        <td class="border-left-0 break-all"><a href="{{ route(ADMIN_TOPIC_EDIT, [$topic->id, 'screen' => 'user-detail']) }}">{{ setMaxLength($topic->title, FLAG_TWO_HUNDRED) }}</a></td>
                        <td class="border-left-0 text-left">{{ $topic->category_name }}</td>
                        <td class="border-left-0 border-right-0 text-center"><a data-id="{{ $topic->id }}" href="javascript:;" class="remove_topics"><i class="far fa-trash-alt"></i></a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="border-left-0 text-center">{{ trans('attributes.admin.photo.no_data') }}</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
</div>
@if($index == LIMIT_RECORD_DEFAULT)
    <div class="card-footer">
        <a href="{{ route(ADMIN_SHOW_LIST_TOPIC_SCREEN) }}" class="btn btn-default float-right">{{ __('attributes.user_detail.btn_all_topic') }}</a>
    </div>
@endif
