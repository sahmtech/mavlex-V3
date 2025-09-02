<div class="pos-tab-content">
            {!! Form::hidden('is_tax_setting', 1) !!}
            <div class="row">
                <div class="col-sm-12">
                    <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                        {!! Form::hidden('enable_inline_tax', 0) !!}
                        <label class="switch" for="enable_inline_tax">
                            {!! Form::checkbox('enable_inline_tax', 1, $business->enable_inline_tax , 
                    [ 'id' => 'enable_inline_tax']); !!} 
                            <div class="sliderCheckbox round"></div>
                        </label>
                        <p>{{ __( 'lang_v1.enable_inline_tax' ) }}</p>
                    </div>

                    
                </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('tax_label_1', __('business.tax_1_name') . ':') !!}
                {!! Form::text('tax_label_1', $business->tax_label_1, ['class' => 'form-control','placeholder' => __('business.tax_1_placeholder')]); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('tax_number_1', __('business.tax_1_no') . ':') !!}
                {!! Form::text('tax_number_1', $business->tax_number_1, ['class' => 'form-control']); !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('tax_label_2', __('business.tax_2_name') . ':') !!}
                {!! Form::text('tax_label_2', $business->tax_label_2, ['class' => 'form-control','placeholder' => __('business.tax_1_placeholder')]); !!}
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('tax_number_2', __('business.tax_2_no') . ':') !!}
                {!! Form::text('tax_number_2', $business->tax_number_2, ['class' => 'form-control']); !!}
            </div>
        </div>
        
    </div>

</div>
