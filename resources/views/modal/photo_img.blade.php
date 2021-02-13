@foreach($articlePhotos as $articlePhoto)
<div class="modal fade photo_modal photo-{{ $articlePhoto['id'] }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="imgTxt">
                    <div class="img">
                        @for($i = FLAG_ONE; $i <= FLAG_THREE; $i++)
                            @if(isset($articlePhoto['image_'. $i]))
                                <div class="img_item">
                                    <img src="{{ asset(STORAGE_LOCATION.$articlePhoto['image_'. $i]) }}" alt="" />
                                </div>
                            @endif
                        @endfor
                    </div>
                    <div class="txt">
                        <div class="flex companyname">
                            <div class="user_img">
                                <img src="{{ $articlePhoto['profile']['avatar_thumbnail'] ? url(PATH_SRC_AVATAR . $articlePhoto['profile']['avatar_thumbnail']) : asset('images/user_default.png') }}" alt="" />
                            </div>
                            <div class="user_txt m15l fs14">
                                <a href="{{ route(MY_PAGE, ['role' => ROLES[$articlePhoto['user']['role']], 'userId' => $articlePhoto['user']['id']]) }}" class="m0">{{ $articlePhoto['profile']['company_name'] ?? '' }}</a>
                            </div>
                        </div>
                        <div class="article_content break-all">
                            <p>{{ date('Y/m/d', strtotime($articlePhoto['created_at'])) }}</p>
                            <p>{{ $articlePhoto['caption'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
