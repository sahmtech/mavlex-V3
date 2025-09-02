<div class="row">
    {{-- Toggle for login background image --}}
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper d-flex gap-2 mt-4">
                <p>
                    @lang('settings.enable_custom_bg_image_for_login')
                    @show_tooltip(__('settings.enable_custom_bg_image_for_login_tooltip'))
                </p>
                <label class="switch" for="login_bg_image">
                    {!! Form::checkbox('login_bg_image', 1, $app_settings->login_bg_image, ['id' => 'login_bg_image']) !!}
                    <div class="sliderCheckbox round"></div>
                </label>
            </div>
        </div>
    </div>
    {{-- File input and current image display --}}
    <div class="col-sm-4">
        <div class="form-group">
            <label for="login_bg_image_file">
                @lang('settings.login_bg_image_label')
            </label>
            @show_tooltip(__('settings.login_bg_image_label_tooltip'))
            <input type="file" name="login_bg_image_file" id="login_bg_image_file" accept="image/*">
            @if(!empty($app_settings->login_bg_image_url))
                <div class="mt-2">
                    <img src="{{ upload_asset('uploads/bg_images/' .$app_settings->login_bg_image_url) }}" 
                         alt="@lang('settings.login_bg_image_label')" 
                         class="img-thumbnail" 
                         style="max-height: 150px;">
                </div>
            @endif
        </div>
    </div>
</div>
