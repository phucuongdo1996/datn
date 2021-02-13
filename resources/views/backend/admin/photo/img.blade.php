@foreach($chunkPhotos as $photo)
<div class="modal fade photo_modal photo-{{ $photo['id'] }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="modal-body">
                <div class="imgTxt">
                    <div class="img">
                        @for($i = FLAG_ONE; $i <= FLAG_THREE; $i++)
                            @if(isset($photo['image_'. $i]))
                                <div class="img_item">
                                    <img src="{{ asset(STORAGE_LOCATION.$photo['image_'. $i]) }}" alt="" />
                                </div>
                            @endif
                        @endfor
                    </div>
                    <div class="txt">
                        <div class="flex companyname">
                            <div class="user_img">
                                <img src="{{ $photo['avatar_thumbnail'] ? url(PATH_SRC_AVATAR . $photo['avatar_thumbnail']) : asset('images/user_default.png') }}" alt="" />
                            </div>
                            <div class="user_txt m15l fs14">
                                <p class="m0">{{ $photo['company_name'] ?? '' }}</p>
                            </div>
                        </div>
                        <div class="article_content break-all">
                            <p>{{ $photo['caption'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
