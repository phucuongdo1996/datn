<div class="row p15r p15l">
    <div class="col-12 text-center p0 m40t m30b">
        <div class="progress-info h-auto">
            <div class="row m15t m15b p40l p40r">
                <div class="col-7 col-sm-8 text-left p0 lh2">
                    <span class="fs14 fw-bold">{{ __('attributes.profile.footer.label_progress_bar') }}</span>
                    <div class="progress-full m5t">
                        <div id="progress-current" class="progress-current"></div>
                    </div>
                </div>
                <div class="col-5 col-sm-4 p0 keep-all block-percent">
                    <span class="num-percent">{{ __('attributes.profile.footer.number_percent') }}</span>
                    <span class="text-percent ">{{ __('attributes.profile.footer.text_percent') }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 text-center">
        @if(isset($profile))
            <button type="button" id="update-info" class="btn border-0 custom-top-btn-primary update-info">{{ __('attributes.profile.footer.button_update') }}</button>
        @else
            <button type="button" id="import-info" class="btn border-0 custom-top-btn-primary import-info">{{ __('attributes.profile.footer.button_save') }}</button>
        @endif
    </div>
</div>
