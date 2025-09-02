<div class="pos-tab-content">
           {!! Form::hidden('is_product_setting', 1) !!}
           <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('sku_prefix', __('business.sku_prefix') . ':') !!}
                 {!! Form::text('sku_prefix', $business->sku_prefix, ['class' => 'form-control text-uppercase']); !!}
            </div>
        </div>
        
        <div class="col-sm-4">
            {!! Form::label('enable_product_expiry', __( 'product.enable_product_expiry' ) . ':') !!}
            @show_tooltip(__('lang_v1.tooltip_enable_expiry'))

            <div class="input-group">
                <span class="input-group-addon">
                    {!! Form::checkbox('enable_product_expiry', 1, $business->enable_product_expiry ); !!} 
                </span>

                <select class="form-control" id="expiry_type"
                    name="expiry_type" 
                    @if(!$business->enable_product_expiry) disabled @endif>
                    <option value="add_expiry" @if($business->expiry_type == 'add_expiry') selected @endif>
                        {{__('lang_v1.add_expiry')}}
                    </option>
                  <option value="add_manufacturing" @if($business->expiry_type == 'add_manufacturing') selected @endif>{{__('lang_v1.add_manufacturing_auto_expiry')}}</option>
                </select>
            </div>
        </div>

        <div class="col-sm-4 @if(!$business->enable_product_expiry) hide @endif" id="on_expiry_div">
            <div class="form-group">
                <div class="multi-input">
                    {!! Form::label('on_product_expiry', __('lang_v1.on_product_expiry') . ':') !!}
                    @show_tooltip(__('lang_v1.tooltip_on_product_expiry'))
                    <br>

                    {!! Form::select('on_product_expiry',     ['keep_selling'=>__('lang_v1.keep_selling'), 'stop_selling'=>__('lang_v1.stop_selling') ], $business->on_product_expiry, ['class' => 'form-control pull-left', 'style' => 'width:60%;']); !!}

                    @php
                        $disabled = '';
                        if($business->on_product_expiry == 'keep_selling'){
                            $disabled = 'disabled';
                        }
                    @endphp

                    {!! Form::number('stop_selling_before', $business->stop_selling_before, ['class' => 'form-control pull-left', 'placeholder' => 'stop n days before', 'style' => 'width:40%;', $disabled, 'required', 'id' => 'stop_selling_before']); !!}
                </div>
            </div>
        </div>
        <div class="col-sm-4 @if(!$business->enable_product_expiry) hide @endif">
            <div class="form-group">
                {!! Form::label('stock_expiry_alert_days', __('lang_v1.stock_expiry_alert_days') . ':') !!}
                @show_tooltip(__('lang_v1.stock_expiry_alert_days_tooltip'))
                {!! Form::number('stock_expiry_alert_days', $business->stock_expiry_alert_days ?? 30, ['class' => 'form-control', 'min' => '0']); !!}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                        {!! Form::hidden('enable_brand', 0) !!}
                        <label class="switch" for="enable_brand">
                            {!! Form::checkbox('enable_brand', 1, $business->enable_brand, 
                    [ 'id' => 'enable_brand']); !!}
                            <div class="sliderCheckbox round"></div>
                        </label>
                        <p>{{ __( 'lang_v1.enable_brand' ) }}</p>
                    </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    {!! Form::hidden('enable_category', 0) !!}
                    <label class="switch" for="enable_category">
                        {!! Form::checkbox('enable_category', 1, $business->enable_category, ['id' => 'enable_category']); !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_category' ) }}</p>
                </div>

            </div>
        </div>

        <div class="col-sm-4 enable_sub_category @if($business->enable_category != 1) hide @endif">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    {!! Form::hidden('enable_sub_category', 0) !!}
                    <label class="switch" for="enable_sub_category">
                        {!! Form::checkbox('enable_sub_category', 1, $business->enable_sub_category, ['id' => 'enable_sub_category']); !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_sub_category' ) }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    {!! Form::hidden('enable_price_tax', 0) !!}
                    <label class="switch" for="enable_price_tax">
                        {!! Form::checkbox('enable_price_tax', 1, $business->enable_price_tax, [ 'id' => 'enable_price_tax']); !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_price_tax' ) }}</p>
                </div>
            </div>
        </div>

      
        <div class="col-sm-4">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    {!! Form::hidden('enable_sub_units', 0) !!}
                    <label class="switch" for="enable_sub_units">
                        {!! Form::checkbox('enable_sub_units', 1, $business->enable_sub_units, [ 'id' => 'enable_sub_units']); !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_sub_units' ) }}</p>@show_tooltip(__('lang_v1.sub_units_tooltip'))
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    {!! Form::hidden('enable_racks', 0) !!}
                    <label class="switch" for="enable_racks">
                        {!! Form::checkbox('enable_racks', 1, $business->enable_racks, [ 'id' => 'enable_racks']); !!} 
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_racks' ) }}</p>@show_tooltip(__('lang_v1.tooltip_enable_racks'))
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    {!! Form::hidden('enable_preparation_time_in_minutes', 0) !!}
                    <label class="switch" for="enable_preparation_time_in_minutes">
                        {!! Form::checkbox('enable_preparation_time_in_minutes', 1, $business->enable_preparation_time_in_minutes, [ 'id' => 'enable_preparation_time_in_minutes']); !!} 
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_preparation_time_in_minutes' ) }}</p>@show_tooltip(__('lang_v1.tooltip_enable_preparation_time_in_minutes'))
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    {!! Form::hidden('enable_row', 0) !!}
                    <label class="switch" for="enable_row">
                        {!! Form::checkbox('enable_row', 1, $business->enable_row, [ 'id' => 'enable_row']); !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_row' ) }}</p>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    {!! Form::hidden('enable_position', 0) !!}
                    <label class="switch" for="enable_position">
                        {!! Form::checkbox('enable_position', 1, $business->enable_position, [ 'id' => 'enable_position']); !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_position' ) }}</p>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    {!! Form::hidden('enable_product_image', 0) !!}
                    <label class="switch" for="enable_product_image">
                        {!! Form::checkbox('enable_product_image', 1, $business->enable_product_image, [ 'id' => 'enable_product_image']); !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_product_image' ) }}</p>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    {!! Form::hidden('enable_product_description', 0) !!}
                    <label class="switch" for="enable_product_description">
                        {!! Form::checkbox('enable_product_description', 1, $business->enable_product_description, [ 'id' => 'enable_product_description']); !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_product_description' ) }}</p>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                    <label class="switch" for="enable_product_warranty">
                        {!! Form::checkbox('common_settings[enable_product_warranty]', 1, !empty($common_settings['enable_product_warranty']) ? true : false, 
                    [ 'id' => 'enable_product_warranty']); !!}
                        <div class="sliderCheckbox round"></div>
                    </label>
                    <p>{{ __( 'lang_v1.enable_product_warranty' ) }}</p>
                </div>
            </div>
        </div>
        
        <div class="clearfix"></div>
        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('default_unit', __('lang_v1.default_unit') . ':') !!}
                {!! Form::select('default_unit', $units_dropdown, $business->default_unit, ['class' => 'form-control select2', 'style' => 'width: 100%;' ]); !!}
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('product_barcode_type', __('product.barcode_type') . ':') !!}
                {!! Form::select('product_barcode_type', $barcodes_dropdown, $business->product_barcode_type, ['class' => 'form-control select2', 'style' => 'width: 100%;' ]); !!}
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('product_link_location', __('Product Link Location') . ':') !!}
                {!! Form::select('product_link_location', $business_locations, $business->product_link_location, ['class' => 'form-control select2', 'style' => 'width: 100%;' ]); !!}
            </div>
        </div>

    </div>
</div>
