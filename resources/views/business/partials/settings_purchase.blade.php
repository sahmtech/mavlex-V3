<!--Purchase related settings -->
<div class="pos-tab-content">
    <div class="row">
    @if(!config('constants.disable_purchase_in_other_currency', true))
    <div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('purchase_in_diff_currency', 1, $business->purchase_in_diff_currency , 
                [ 'class' => 'input-icheck', 'id' => 'purchase_in_diff_currency']); !!} {{ __( 'purchase.allow_purchase_different_currency' ) }}
                </label>
              @show_tooltip(__('tooltip.purchase_different_currency'))
            </div>
        </div>
    </div>
    <div class="col-sm-4 @if($business->purchase_in_diff_currency != 1) hide @endif" id="settings_purchase_currency_div">
        <div class="form-group">
            {!! Form::label('purchase_currency_id', __('purchase.purchase_currency') . ':') !!}
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fas fa-money-bill-alt"></i>
                </span>
                {!! Form::select('purchase_currency_id', $currencies, $business->purchase_currency_id, ['class' => 'form-control select2', 'placeholder' => __('business.currency'), 'required', 'style' => 'width:100% !important']); !!}
            </div>
        </div>
    </div>
    <div class="col-sm-4 @if($business->purchase_in_diff_currency != 1) hide @endif" id="settings_currency_exchange_div">
        <div class="form-group">
            {!! Form::label('p_exchange_rate', __('purchase.p_exchange_rate') . ':') !!}
            @show_tooltip(__('tooltip.currency_exchange_factor'))
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="fa fa-info"></i>
                </span>
                {!! Form::number('p_exchange_rate', $business->p_exchange_rate, ['class' => 'form-control', 'placeholder' => __('business.p_exchange_rate'), 'required', 'step' => '0.001']); !!}
            </div>
        </div>
    </div>
    @endif
    <div class="clearfix"></div>
    <div class="col-sm-6">
        <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('enable_editing_product_from_purchase', 1, $business->enable_editing_product_from_purchase , 
                [ 'class' => 'input-icheck']); !!} {{ __( 'lang_v1.enable_editing_product_from_purchase' ) }}
              </label>
              @show_tooltip(__('lang_v1.enable_updating_product_price_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('enable_purchase_status', 1, $business->enable_purchase_status , [ 'class' => 'input-icheck', 'id' => 'enable_purchase_status']); !!} {{ __( 'lang_v1.enable_purchase_status' ) }}
                </label>
              @show_tooltip(__('lang_v1.tooltip_enable_purchase_status'))
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('enable_lot_number', 1, $business->enable_lot_number , [ 'class' => 'input-icheck', 'id' => 'enable_lot_number']); !!} {{ __( 'lang_v1.enable_lot_number' ) }}
                </label>
              @show_tooltip(__('lang_v1.tooltip_enable_lot_number'))
            </div>
        </div>
    </div>
<div class="clearfix"></div>
    <div class="col-sm-5">
        <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('ep_unit_cost_before_discount', 1, $business->ep_unit_cost_before_discount , 
                [ 'class' => 'input-icheck']); !!} {{ __( 'lang_v1.ep_unit_cost_before_discount' ) }}
              </label>
              @show_tooltip(__('lang_v1.ep_unit_cost_before_discount_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <div class="checkbox">
              <label>
                {!! Form::checkbox('ep_sub_total', 1, $business->ep_sub_total , 
                [ 'class' => 'input-icheck']); !!} {{ __( 'lang_v1.ep_sub_total' ) }}
              </label>
              @show_tooltip(__('lang_v1.ep_sub_total_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('ep_unit_selling_price', 1, $business->ep_unit_selling_price , [ 'class' => 'input-icheck', 'id' => 'ep_unit_selling_price']); !!} {{ __( 'lang_v1.ep_unit_selling_price' ) }}
                </label>
              @show_tooltip(__('lang_v1.ep_unit_selling_price_tooltip'))
            </div>
        </div>
    </div>
<div class="clearfix"></div>
    <div class="col-sm-5">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('ep_unit_cost_price_after_tax', 1, $business->ep_unit_cost_price_after_tax , [ 'class' => 'input-icheck', 'id' => 'ep_unit_cost_price_after_tax']); !!} {{ __( 'lang_v1.ep_unit_cost_price_after_tax' ) }}
                </label>
              @show_tooltip(__('lang_v1.ep_unit_cost_price_after_tax_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('ep_payment_info', 1, $business->ep_payment_info , [ 'class' => 'input-icheck', 'id' => 'ep_payment_info']); !!} {{ __( 'lang_v1.ep_payment_info' ) }}
                </label>
              @show_tooltip(__('lang_v1.ep_payment_info_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('ep_net_total_amount', 1, $business->ep_net_total_amount , [ 'class' => 'input-icheck', 'id' => 'ep_net_total_amount']); !!} {{ __( 'lang_v1.ep_net_total_amount' ) }}
                </label>
              @show_tooltip(__('lang_v1.ep_net_total_amount_tooltip'))
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('ep_discount', 1, $business->ep_discount , [ 'class' => 'input-icheck', 'id' => 'ep_discount']); !!} {{ __( 'lang_v1.ep_discount' ) }}
                </label>
              @show_tooltip(__('lang_v1.ep_discount_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('ep_purchase_tax', 1, $business->ep_purchase_tax , [ 'class' => 'input-icheck', 'id' => 'ep_purchase_tax']); !!} {{ __( 'lang_v1.ep_purchase_tax' ) }}
                </label>
              @show_tooltip(__('lang_v1.ep_purchase_tax_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-5">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('ep_additional_shipping_charges', 1, $business->ep_additional_shipping_charges , [ 'class' => 'input-icheck', 'id' => 'ep_additional_shipping_charges']); !!} {{ __( 'lang_v1.ep_additional_shipping_charges' ) }}
                </label>
              @show_tooltip(__('lang_v1.ep_additional_shipping_charges_tooltip'))
            </div>
        </div>
    </div>
<div class="clearfix"></div>
<div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('ep_purchase_total', 1, $business->ep_purchase_total , [ 'class' => 'input-icheck', 'id' => 'ep_purchase_total']); !!} {{ __( 'lang_v1.ep_purchase_total' ) }}
                </label>
              @show_tooltip(__('lang_v1.ep_purchase_total_tooltip'))
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('ep_shipping_details', 1, $business->ep_shipping_details , [ 'class' => 'input-icheck', 'id' => 'ep_shipping_details']); !!} {{ __( 'lang_v1.ep_shipping_details' ) }}
                </label>
              @show_tooltip(__('lang_v1.ep_shipping_details_tooltip'))
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('common_settings[enable_purchase_order]', 1, !empty($common_settings['enable_purchase_order']) , [ 'class' => 'input-icheck', 'id' => 'enable_purchase_order']); !!} {{ __( 'lang_v1.enable_purchase_order' ) }}
                </label>
              @show_tooltip(__('lang_v1.purchase_order_help_text'))
            </div>
        </div>
    </div>
<div class="clearfix"></div>
    <div class="col-sm-5">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('ep_unit_cost_price_before_tax', 1, $business->ep_unit_cost_price_before_tax , [ 'class' => 'input-icheck', 'id' => 'ep_unit_cost_price_before_tax']); !!} {{ __( 'lang_v1.ep_unit_cost_price_before_tax' ) }}
                </label>
              @show_tooltip(__('lang_v1.ep_unit_cost_price_before_tax_tooltip'))
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <div class="checkbox">
                <label>
                {!! Form::checkbox('ep_sub_total_before_tax', 1, $business->ep_sub_total_before_tax , [ 'class' => 'input-icheck', 'id' => 'ep_sub_total_before_tax']); !!} {{ __( 'lang_v1.ep_sub_total_before_tax' ) }}
                </label>
              @show_tooltip(__('lang_v1.ep_sub_total_before_tax_tooltip'))
            </div>
        </div>
    </div>

    </div>
</div>