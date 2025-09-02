@php
$is_mobile = isMobile();
@endphp
<div class="row no-print">
    <div class="pos-form-actions">
    @include('sale_pos.partials.pos_form_totals')
<div @if(!$is_mobile) style="margin-top: 10px;"  @endif>
    <div class="pos-payment-options"   @if($is_mobile) style="margin-top: -40px;"@endif>

        <div class="sec-2">
            <div class="discount-btn">
                <span>
                    @if ($is_discount_enabled)
                    @lang('sale.discount')
                    @endif
                    @if ($is_rp_enabled)
                    {{ session('business.rp_name') }}
                    @endif
                    (-):
                
                @if ($is_discount_enabled)
                
                @if ($edit_discount)
                <img src="{{ asset('img/icons/pencil.svg') }}" @if($is_mobile) style="width: 15px;"@endif class="cursor-pointer" alt="" id="pos-edit-discount" title="@lang('sale.edit_discount')" aria-hidden="true" data-toggle="modal" data-target="#posEditDiscountModal">
                @endif
                </span>
                <span id="total_discount">0</span>
                <input type="hidden" id="total_discount_input" value="">
                @endif

                <input type="hidden" name="discount_type" id="discount_type" value="@if (empty($edit)) {{ 'percentage' }}@else{{ $transaction->discount_type }} @endif" data-default="percentage">
                <input type="hidden" name="discount_amount" id="discount_amount" value="@if (empty($edit)) {{ @num_format($business_details->default_sales_discount) }} @else {{ @num_format($transaction->discount_amount) }} @endif" data-default="{{ $business_details->default_sales_discount }}">
                <input type="hidden" name="rp_redeemed" id="rp_redeemed" value="@if (empty($edit)) {{ '0' }}@else{{ $transaction->rp_redeemed }} @endif">
                <input type="hidden" name="rp_redeemed_amount" id="rp_redeemed_amount" value="@if (empty($edit)) {{ '0' }}@else {{ $transaction->rp_redeemed_amount }} @endif">
            </div>

            <div class="divider"></div>

            <div class="discount-btn">
                <span>@lang('sale.shipping')(+):

                <img src="{{ asset('img/icons/pencil.svg') }}"  @if($is_mobile) style="width: 15px;"@endif class="cursor-pointer" alt="" aria-hidden="true" title="@lang('sale.shipping')" data-toggle="modal" data-target="#posShippingModal">
                </span>
                <span id="shipping_charges_amount">0</span>
                <input type="hidden" name="shipping_details" id="shipping_details" value="@if (empty($edit)) {{ '' }}@else{{ $transaction->shipping_details }} @endif" data-default="">

                <input type="hidden" name="shipping_address" id="shipping_address" value="@if (empty($edit)) {{ '' }}@else{{ $transaction->shipping_address }} @endif">

                <input type="hidden" name="shipping_status" id="shipping_status" value="@if (empty($edit)) {{ '' }}@else{{ $transaction->shipping_status }} @endif">

                <input type="hidden" name="delivered_to" id="delivered_to" value="@if (empty($edit)) {{ '' }}@else{{ $transaction->delivered_to }} @endif">
                
                <input type="hidden" name="delivery_person" id="delivery_person" value="@if(empty($edit)){{''}}@else{{$transaction->delivery_person}}@endif">

                <input type="hidden" name="shipping_charges" id="shipping_charges" value="@if (empty($edit)) {{ @num_format(0.0) }} @else{{ @num_format($transaction->shipping_charges) }} @endif" data-default="0.00">
            </div>

            <div class="divider"></div>

            <div class="discount-btn @if ($pos_settings['disable_order_tax'] != 0) hide @endif">
                <span>@lang('sale.order_tax')(+):
                <img src="{{ asset('img/icons/pencil.svg') }}" @if($is_mobile) style="width: 15px;"@endif class="cursor-pointer" alt="" atitle="@lang('sale.edit_order_tax')" aria-hidden="true" data-toggle="modal" data-target="#posEditOrderTaxModal" id="pos-edit-tax">
                </span>
                <span id="order_tax">
                    @if (empty($edit))
                    0
                    @else
                    {{ $transaction->tax_amount }}
                    @endif
                </span>
                <input type="hidden" id="order_tax_input" value="">

                <input type="hidden" name="tax_rate_id" id="tax_rate_id" value="@if (empty($edit)) {{ $business_details->default_sales_tax }} @else {{ $transaction->tax_id }} @endif" data-default="{{ $business_details->default_sales_tax }}">

                <input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" value="@if (empty($edit)) {{ @num_format($business_details->tax_calculation_amount) }} @else {{ @num_format(optional($transaction->tax)->amount) }} @endif" data-default="{{ $business_details->tax_calculation_amount }}">

            </div>

            @if (in_array('types_of_service', $enabled_modules))
            <div class="divider"></div>

            <div class="discount-btn">
                <span>@lang('lang_v1.packing_charge')(+):</span>
                <img src="{{ asset('img/icons/pencil.svg') }}" @if($is_mobile) style="width: 15px;" @endif class="cursor-pointer service_modal_btn" alt="">
                <span id="packing_charge_text">
                    0
                </span>
                <input type="hidden" id="packing_charge_input" value="">
            </div>
            @endif
            

            @if (!empty($pos_settings['amount_rounding_method']) && $pos_settings['amount_rounding_method'] > 0)
            <div class="divider"></div>

            <div class="discount-btn">
                <span id="round_off">@lang('lang_v1.round_off'):</span> <span id="round_off_text">0</span>
                <input type="hidden" name="round_off_amount" id="round_off_amount" value=0>
            </div>
            @endif

            @if (in_array('subscription', $enabled_modules))
            <label>
                {!! Form::checkbox('is_recurring', 1, false, ['class' => 'form-check-input', 'id' => 'is_recurring']) !!} @lang('lang_v1.subscription')?

                <button type="button" data-toggle="modal" data-target="#recurringInvoiceModal" class="btn btn-link"><i class="fa fa-external-link-square-alt"></i></button>@show_tooltip(__('lang_v1.recurring_invoice_help'))
            </label>
            @endif

        </div>


        <div class="total-payable">
            <input type="hidden" name="final_total" id="final_total_input" value=0>
            <h2 >@lang('sale.total_payable'): <span id="total_payable">0</span></h2>
          
            @moduleEnabled('CurrencyExchangeRate')
            <div class="total-payable-target" style="display: none;">
            <input type="hidden" name="final_total_target" id="final_total_target_input" value="0">
            <h3>@lang('sale.total_payable'): <span id="currency_code"></span> <span id="total_payable">0</span></h3>
            </div>
        @endmoduleEnabled

        </div>
        <!-- Exchange Rate Module -->
    </div>
    
    @if(!$is_mobile)
    <div class="pos-buttons" style="margin-top: 10px;">
        @if (empty($edit))
        <button type="button" class="suspend @if ($is_mobile) @else @endif order-8" id="pos-cancel" style=" justify-content: center; white-space: nowrap;"> @lang('sale.cancel')</button>
        @else
        <button type="button" class="suspend hide @if ($is_mobile) @else @endif order-8" id="pos-delete" style=" justify-content: center; white-space: nowrap;"> @lang('messages.delete')</button>
        @endif
        <button type="button" id="pos-quotation" class="quotation-button order-5" style=" justify-content: center; white-space: nowrap;">
            <span>@lang('lang_v1.quotation')</span>
        </button>

        <button type="button" class="@if ($pos_settings['disable_draft'] != 0) hide @endif draft-button order-6" id="pos-draft" style=" justify-content: center; white-space: nowrap;">
            <span>@lang('sale.draft')</span>
        </button>

        @if (empty($pos_settings['disable_credit_sale_button']))
        <input type="hidden" name="is_credit_sale" value="0" id="is_credit_sale">
        <button type="button" class="multipay pos-express-finalize @if ($is_mobile) col-xs-6 order-7 @endif" data-pay_method="credit_sale" title="@lang('lang_v1.tooltip_credit_sale')" style="background: var(--primary-color);border: 1px solid var(--primary-color);justify-content: center; white-space: nowrap;">
            @lang('lang_v1.credit_sale')
        </button>
        @endif

        @if (empty($pos_settings['disable_suspend']))
        <button type="button" class="multipay pos-express-finalize order-4" data-pay_method="suspend" title="@lang('lang_v1.tooltip_suspend')" style=" justify-content: center; white-space: nowrap;">
            @lang('lang_v1.suspend')
        </button>
        @endif


        <button type="button" class="multipay @if (!$is_mobile)  @endif btn-flat no-print @if ($pos_settings['disable_pay_checkout'] != 0) hide @endif @if ($is_mobile) col-xs-6 @endif order-3" id="pos-finalize" title="@lang('lang_v1.tooltip_checkout_multi_pay')" style="background: var(--secondary-color);border: 1px solid var(--secondary-color); justify-content: center; white-space: nowrap;">
            @lang('lang_v1.checkout_multi_pay')
        </button>
        
        @if( $restaurant_settings['enable_restaurant_module'] == "1" && $restaurant_settings['enable_kot'] == "1")
        <button type="button" class="placeorder pos-express-finalize order-2" data-pay_method="kot" title="@lang('lang_v1.print_kot')" style=" justify-content: center; white-space: nowrap;">
            @lang('lang_v1.print_kot')
        </button>
        @endif
        <button type="button" class="cash @if (!$is_mobile)  @endif btn-flat no-print @if ($pos_settings['disable_express_checkout'] != 0 || !array_key_exists('cash', $payment_types)) hide @endif pos-express-finalize @if ($is_mobile) col-xs-6 @endif order-1" data-pay_method="cash" title="@lang('tooltip.express_checkout')" style="justify-content: center; ">
            @lang('lang_v1.express_checkout_cash')
        </button>

    </div>
    @else
    @include('sale_pos.partials.pos_buttons_mobile')
    @endif
</div>
    </div>
</div>
@if (isset($transaction))
@include('sale_pos.partials.edit_discount_modal', [
'sales_discount' => $transaction->discount_amount,
'discount_type' => $transaction->discount_type,
'rp_redeemed' => $transaction->rp_redeemed,
'rp_redeemed_amount' => $transaction->rp_redeemed_amount,
'max_available' => !empty($redeem_details['points']) ? $redeem_details['points'] : 0,
])
@else
@include('sale_pos.partials.edit_discount_modal', [
'sales_discount' => $business_details->default_sales_discount,
'discount_type' => 'percentage',
'rp_redeemed' => 0,
'rp_redeemed_amount' => 0,
'max_available' => 0,
])
@endif

@if (isset($transaction))
@include('sale_pos.partials.edit_order_tax_modal', ['selected_tax' => $transaction->tax_id])
@else
@include('sale_pos.partials.edit_order_tax_modal', [
'selected_tax' => $business_details->default_sales_tax,
])
@endif

@include('sale_pos.partials.edit_shipping_modal')