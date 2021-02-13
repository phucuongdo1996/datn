<table id="table-property" class="table table-bordered table-striped border-0 m0">
    <tr class="table-head">
        <td class="border-top-0 border-left-0"><div>{{ trans('attributes.my_page.topic.title') }}</div></td>
        <td class="border-top-0 text-center"><div>{{ trans('attributes.article_photo.user_information_2') }}</div></td>
        <td class="border-top-0 text-center"><div>{{ trans('attributes.my_page.topic.category') }}</div></td>
        <td class="border-top-0 text-center"><div>{{ trans('attributes.my_page.topic.create_at') }}</div></td>
        <td class="border-top-0 border-right-0"><div class="w20"></div></td>
    </tr>
    @forelse($topics as $topic)
        <tr class="table">
            <td class="border-left-0 break-all"><a href="{{ route(ADMIN_TOPIC_EDIT, [$topic->id, 'screen' => 'top']) }}">{{ setMaxLength($topic->title, FLAG_TWO_HUNDRED) }}</a></td>
            <td class="border-left-0 text-left"><a href="{{ route(ADMIN_MANAGE_USER_DETAIL_INDEX, ['userId' => $topic->user_id]) }}">{{ $topic->person_charge_last_name . $topic->person_charge_first_name }}</a></td>
            <td class="border-left-0 text-left">{{ $topic->category_name }}</td>
            <td class="border-left-0 text-center">{{ dateTimeFormat($topic->created_at) }}</td>
            <td class="border-left-0 border-right-0 text-center"><a href="#" data-id="{{ $topic->id }}" class="remove_topics"><i class="far fa-trash-alt"></i></a></td>
        </tr>
    @empty
        <tr class="table">
            <td colspan="5" class="fs13 border-0 break-all text-center">{{ trans('attributes.admin.photo.no_data') }}</td>
        </tr>
    @endforelse
</table>
