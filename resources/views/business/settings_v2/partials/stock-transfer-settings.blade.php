<div class="pos-tab-content">
           {!! Form::hidden('is_stock_transfer_setting', 1) !!}
           <div class="row">
    
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="es_unit_price">
                    {!! Form::checkbox('es_unit_price', 1, $business->es_unit_price , 
            [ 'id' => 'es_unit_price']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.es_unit_price' ) }}</p>@show_tooltip(__('lang_v1.es_unit_price_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="es_sub_total">
                    {!! Form::checkbox('es_sub_total', 1, $business->es_sub_total , ['id' => 'es_sub_total']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.es_sub_total' ) }}</p>@show_tooltip(__('lang_v1.es_sub_total_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="es_net_total_amount">
                    {!! Form::checkbox('es_net_total_amount', 1, $business->es_net_total_amount , [ 'id' => 'es_net_total_amount']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.es_net_total_amount' ) }}</p>@show_tooltip(__('lang_v1.es_net_total_amount_tooltip'))
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="es_additional_shipping_charges">
                    {!! Form::checkbox('es_additional_shipping_charges', 1, $business->es_additional_shipping_charges , 
                [ 'id' => 'es_additional_shipping_charges']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.es_additional_shipping_charges' ) }}</p>@show_tooltip(__('lang_v1.es_additional_shipping_charges_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="es_purchase_total">
                    {!! Form::checkbox('es_purchase_total', 1, $business->es_purchase_total , 
                [ 'id' => 'es_purchase_total']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.es_purchase_total' ) }}</p>@show_tooltip(__('lang_v1.es_purchase_total_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="es_approved_by">
                    {!! Form::checkbox('es_approved_by', 1, $business->es_approved_by , ['id' => 'es_approved_by']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.es_approved_by' ) }}</p>@show_tooltip(__('lang_v1.es_approved_by_tooltip'))
            </div>
        </div>
    </div>

    </div>
</div>
