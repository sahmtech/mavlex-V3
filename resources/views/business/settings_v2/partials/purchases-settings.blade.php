<div class="pos-tab-content">
           {!! Form::hidden('is_purchase_setting', 1) !!}
           <div class="row">
    @if(!config('constants.disable_purchase_in_other_currency', true))
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="purchase_in_diff_currency">
                    {!! Form::checkbox('purchase_in_diff_currency', 1, $business->purchase_in_diff_currency , 
                [ 'id' => 'purchase_in_diff_currency']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'purchase.allow_purchase_different_currency' ) }}</p>@show_tooltip(__('tooltip.purchase_different_currency'))
            </div>
        </div>
    </div>
    <div class="col-sm-4 @if($business->purchase_in_diff_currency != 1) hide @endif" id="settings_purchase_currency_div">
        <div class="form-group">
            {!! Form::label('purchase_currency_id', __('purchase.purchase_currency') . ':') !!}
            {!! Form::select('purchase_currency_id', $currencies, $business->purchase_currency_id, ['class' => 'form-control select2', 'placeholder' => __('business.currency'), 'required', 'style' => 'width:100% !important']); !!}
        </div>
    </div>
    <div class="col-sm-4 @if($business->purchase_in_diff_currency != 1) hide @endif" id="settings_currency_exchange_div">
        <div class="form-group">
            {!! Form::label('p_exchange_rate', __('purchase.p_exchange_rate') . ':') !!}
            @show_tooltip(__('tooltip.currency_exchange_factor'))
            {!! Form::number('p_exchange_rate', $business->p_exchange_rate, ['class' => 'form-control', 'placeholder' => __('business.p_exchange_rate'), 'required', 'step' => '0.001']); !!}
        </div>
    </div>
    @endif
    
  

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                {!! Form::hidden('enable_purchase_status', 0) !!}
                <label class="switch" for="enable_purchase_status">
                    {!! Form::checkbox('enable_purchase_status', 1, $business->enable_purchase_status , [ 'id' => 'enable_purchase_status']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.enable_purchase_status' ) }}</p>@show_tooltip(__('lang_v1.tooltip_enable_purchase_status'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                {!! Form::hidden('enable_lot_number', 0) !!}
                <label class="switch" for="enable_lot_number">
                    {!! Form::checkbox('enable_lot_number', 1, $business->enable_lot_number , [ 'id' => 'enable_lot_number']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.enable_lot_number' ) }}</p>@show_tooltip(__('lang_v1.tooltip_enable_lot_number'))
            </div>
        </div>
    </div>

   

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                {!! Form::hidden('ep_sub_total', 0) !!}
                <label class="switch" for="ep_sub_total">
                    {!! Form::checkbox('ep_sub_total', 1, $business->ep_sub_total , 
                [ 'id' => 'ep_sub_total']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.ep_sub_total' ) }}</p>@show_tooltip(__('lang_v1.ep_sub_total_tooltip'))
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="ep_unit_cost_before_discount">
                    {!! Form::checkbox('ep_unit_cost_before_discount', 1, $business->ep_unit_cost_before_discount , [ 'id' => 'ep_unit_cost_before_discount']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.ep_unit_cost_before_discount' ) }}</p>@show_tooltip(__('lang_v1.ep_unit_cost_before_discount_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="ep_unit_selling_price">
                    {!! Form::checkbox('ep_unit_selling_price', 1, $business->ep_unit_selling_price , [ 'id' => 'ep_unit_selling_price']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.ep_unit_selling_price' ) }}</p>@show_tooltip(__('lang_v1.ep_unit_selling_price_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="ep_unit_cost_price_after_tax">
                    {!! Form::checkbox('ep_unit_cost_price_after_tax', 1, $business->ep_unit_cost_price_after_tax , [ 'id' => 'ep_unit_cost_price_after_tax']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.ep_unit_cost_price_after_tax' ) }}</p> @show_tooltip(__('lang_v1.ep_unit_cost_price_after_tax_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="ep_payment_info">
                    {!! Form::checkbox('ep_payment_info', 1, $business->ep_payment_info , [ 'id' => 'ep_payment_info']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.ep_payment_info' ) }}</p>@show_tooltip(__('lang_v1.ep_payment_info_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="ep_net_total_amount">
                    {!! Form::checkbox('ep_net_total_amount', 1, $business->ep_net_total_amount , [ 'id' => 'ep_net_total_amount']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.ep_net_total_amount' ) }}</p>@show_tooltip(__('lang_v1.ep_net_total_amount_tooltip'))
            </div>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="ep_discount">
                    {!! Form::checkbox('ep_discount', 1, $business->ep_discount , [ 'id' => 'ep_discount']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.ep_discount' ) }}</p>@show_tooltip(__('lang_v1.ep_discount_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="ep_purchase_tax">
                    {!! Form::checkbox('ep_purchase_tax', 1, $business->ep_purchase_tax , [ 'id' => 'ep_purchase_tax']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.ep_purchase_tax' ) }}</p>@show_tooltip(__('lang_v1.ep_purchase_tax_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="ep_additional_shipping_charges">
                    {!! Form::checkbox('ep_additional_shipping_charges', 1, $business->ep_additional_shipping_charges , [ 'id' => 'ep_additional_shipping_charges']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.ep_additional_shipping_charges' ) }}</p>@show_tooltip(__('lang_v1.ep_additional_shipping_charges_tooltip'))
            </div>
        </div>
    </div>

<div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="ep_purchase_total">
                    {!! Form::checkbox('ep_purchase_total', 1, $business->ep_purchase_total , [ 'id' => 'ep_purchase_total']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.ep_purchase_total' ) }}</p>@show_tooltip(__('lang_v1.ep_purchase_total_tooltip'))
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="ep_shipping_details">
                    {!! Form::checkbox('ep_shipping_details', 1, $business->ep_shipping_details , [ 'id' => 'ep_shipping_details']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.ep_shipping_details' ) }}</p>@show_tooltip(__('lang_v1.ep_shipping_details_tooltip'))
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="enable_purchase_order">
                    {!! Form::checkbox('common_settings[enable_purchase_order]', 1, !empty($common_settings['enable_purchase_order']) , [ 'id' => 'enable_purchase_order']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.enable_purchase_order' ) }}</p>@show_tooltip(__('lang_v1.purchase_order_help_text'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="ep_unit_cost_price_before_tax">
                    {!! Form::checkbox('ep_unit_cost_price_before_tax', 1, $business->ep_unit_cost_price_before_tax , [ 'id' => 'ep_unit_cost_price_before_tax']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.ep_unit_cost_price_before_tax' ) }}</p>@show_tooltip(__('lang_v1.ep_unit_cost_price_before_tax_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="ep_sub_total_before_tax">
                    {!! Form::checkbox('ep_sub_total_before_tax', 1, $business->ep_sub_total_before_tax , [ 'id' => 'ep_sub_total_before_tax']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.ep_sub_total_before_tax' ) }}</p>@show_tooltip(__('lang_v1.ep_sub_total_before_tax_tooltip'))
            </div>
        </div>
    </div>
    
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="ep_reference">
                    {!! Form::checkbox('ep_reference', 1, $business->ep_reference , [ 'id' => 'ep_reference']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.ep_reference' ) }}</p>@show_tooltip(__('lang_v1.ep_reference_tooltip'))
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="ep_pay_term">
                    {!! Form::checkbox('ep_pay_term', 1, $business->ep_pay_term , [ 'id' => 'ep_pay_term']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.ep_pay_term' ) }}</p>@show_tooltip(__('lang_v1.ep_pay_term_tooltip'))
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="ep_additional_expenses">
                    {!! Form::checkbox('ep_additional_expenses', 1, $business->ep_additional_expenses , [ 'id' => 'ep_additional_expenses']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.ep_additional_expenses' ) }}</p>@show_tooltip(__('lang_v1.ep_additional_expenses_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="enable_purchase_requisition">
                {!! Form::checkbox('common_settings[enable_purchase_requisition]', 1, !empty($common_settings['enable_purchase_requisition']) , ['id' => 'enable_purchase_requisition']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.enable_purchase_requisition' ) }}</p>@show_tooltip(__('lang_v1.purchase_requisition_help_text'))
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="enable_editing_product_from_purchase">
                    {!! Form::checkbox('enable_editing_product_from_purchase', 1, $business->enable_editing_product_from_purchase , 
                [ 'id' => 'enable_editing_product_from_purchase']); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.enable_editing_product_from_purchase' ) }}</p>@show_tooltip(__('lang_v1.enable_updating_product_price_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4 @if(config('constants.enable_secondary_unit') == false) hide @endif">
        <div class="form-group">
            <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                <label class="switch" for="enable_secondary_unit">
                {!! Form::checkbox('common_settings[enable_secondary_unit]', 1, !empty($common_settings['enable_secondary_unit']) ? true : false); !!}
                    <div class="sliderCheckbox round"></div>
                </label>
                <p>{{ __( 'lang_v1.enable_secondary_unit' ) }}</p>
            </div>
        </div>
    </div>

    </div>
</div>
