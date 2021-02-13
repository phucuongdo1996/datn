<p class="attention text-center fs12"><i class="fa fa-exclamation-circle" aria-hidden="true"></i>{{ __('attributes.profile.header.attention') }}</p>
<table class="table table-bordered">
    <tr>
        <td class="label-info">{{ __('attributes.profile.header.label_avatar') }}</td>
        <td>
            <div class="row p20l">
                <div class="col-12 col-md-3 p0l m5b">
                    @if(isset($profile) && isset($profile['avatar_thumbnail']))
                        <div id="image-avatar" class="avatar essential-icon-img pointer">
                            <img id="image-check-update" class="img-preview-map" src="{{ asset('storage/' . FOLDER_IMAGES_PROFILE . '/' . $profile['avatar_thumbnail']) }}">
                        </div>
                    @else
                        <div id="image-avatar" class="avatar essential-icon-img pointer">
                            <img src="{{ asset('images/icon-img.png') }}">
                        </div>
                    @endif
                </div>
                <div class="col-md-9 p0l">
                    <p class="fs16 fw-bold m5b">{{ __('attributes.profile.header.note_avatar_1') }}</p>
                    <p class="m5b d-none d-lg-block">{{ __('attributes.profile.header.note_avatar_2') }}</p>
                    <p class="fs10 mb-0">{{ __('attributes.profile.header.note_avatar_3') }}</p>
                    <p class="fs10 mb-0">{{ __('attributes.profile.header.note_avatar_4') }}</p>
                    <p class="fs10 mb-0">{{ __('attributes.profile.header.note_avatar_5') }}</p>
                </div>
                <p class="error-messages" data-error="avatar"></p>
            </div>
        </td>
    </tr>
    <tr>
        <td class="label-info">
            <span>{{ __('attributes.profile.header.label_nickname') }}</span>
            <label class="label-required float-md-right">{{ __('attributes.common.required') }}</label>
        </td>
        <td>
            <div class="row p20l p20r">
                <p class=" note_nickname">{{ __('attributes.profile.header.note_nickname') }}</p>
                <input id="nick_name" type="text" name="nick_name" class="form-control profile-setting progress-calculate" value="{{ $profile['nick_name'] ?? '' }}">
                <p class="error-message p5t" data-error="nick_name"></p>
            </div>
        </td>
    </tr>
</table>
<input id="input-avatar" type="file" name="avatar" class="d-none progress-calculate-avatar">
