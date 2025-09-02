<div class="pos-tab-content">
    <div class="row">
        <div class="col-sm-12" data-toggle="tooltip" data-placement="bottom" title="@lang('lang_v1.show_customer_display_tooltip')" data-html="true">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    {!! Form::hidden('pos_settings[show_customer_display]', 0) !!}
                    <label class="switch" for="show_customer_display">
                        {!! Form::checkbox('pos_settings[show_customer_display]', 1,!empty($pos_settings['show_customer_display']) ,[ 'id' => 'show_customer_display']); !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_customer_display_screen' ) }}</p>
                </div>
                <p class="help-block"><i> @lang('lang_v1.customer_display_instruction')</i></p>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::label('display_screen_heading', __('lang_v1.display_screen_heading') . ':') !!}
                <p class="help-block"><i> @lang('lang_v1.display_screen_heading_instruction')</i></p>
                {!! Form::textarea('pos_settings[display_screen_heading]',isset($pos_settings['display_screen_heading']) ? $pos_settings['display_screen_heading'] : null,['class' => 'form-control', 'id' => 'display_screen_heading']); !!}
            </div>
        </div>
        <!-- Start for Rows -->
            <div class="col-sm-12">
                @for ($i = 1; $i <= 10; $i++) 
                        @php 
                            $key="carousel_image_$i" ; 
                            $file=$pos_settings[$key] ?? null; 
                            $src=$file? upload_asset("uploads/carousel_images/$file") : null; 
                        @endphp   
                    <div class="row">
                        <!-- Upload Icon -->
                        <div class="col-sm-6">
                            {!! Form::label($key, __('lang_v1.carousel_image', ['number'=>$i])) !!}
                            {!! Form::file($key,['accept'=>'image/*','class'=>'carousel_image form-control-file','id'=>"file_$key"]) !!}
                            <small class="form-text text-muted">@lang('lang_v1.image_help')</small>
                        </div>
                        <!--upload icon end -->

                        <!-- Thumbnail -->
                        <div class="col-sm-3">
                            @if ($src)
                                <img src="{{ $src }}" class="img-thumbnail" style="width:90px;height:90px;object-fit:cover">
                            @endif
                        </div>
                        <!--Thumbnail End -->

                        <!-- Delete Button -->
                        @if ($src)
                            <div class="col-sm-3">
                                <div class="form-group">
                                    @php 
                                        $chkId = "remove_toggle_$key"; 
                                    @endphp
                                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                                        <label class="switch" for="{{ $chkId }}">
                                            {!! Form::checkbox("remove_$key", 1, false, ['class' => 'remove-toggle ','id'=>$chkId, 'data-target'=>"file_$key"]) !!}
                                            <div class="sliderCheckbox round"></div>
                                        </label>
                                        <p>{{ __('lang_v1.remove') }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif     
                    <!-- Delete Button end -->  
                    </div>
                @endfor
            </div>  
        <!-- End for Rows -->
    </div>
 </div>
 
