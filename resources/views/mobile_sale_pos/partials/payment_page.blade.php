@php
$is_mobile = isMobile();
@endphp

<div class="pos-subheader-mobile" style="margin-bottom: 20px;">

    <div class="back">
        <button type="button" id="backToProducts" class="back"><img src="{{ asset('img/icons/back-icon.svg') }}" alt=""></button>
    </div>
    <div class="center">
        <h2>@lang('lang_v1.checkout')</h2>

        @isset($edit)
        @if($edit)
        <p>@lang('sale.invoice_no'): {{$transaction->invoice_no}}</p>
        @endif
        @endisset
    </div>

    <div class="pos-subheader-mobile pull-right">
        @if (in_array('subscription', $enabled_modules))
        {!! Form::checkbox('is_recurring', 1, false, ['class' => 'form-check-input', 'id' => 'is_recurring']) !!}
        <button type="button" data-toggle="modal" data-target="#recurringInvoiceModal" class=" btn-link"><i class="fa fa-external-link-square-alt"></i></button>
        @endif
        @if (empty($edit))
        <button type="button" class="" id="pos-cancel">
            <i class="fas fa-window-close" style="color: red;"></i>
        </button>
        @else
        <button type="button" class="" id="pos-delete" @if (!empty($only_payment)) disabled @endif>
            <i class="fas fa-trash-alt" style="color: red;"></i>
        </button>
        @endif


    </div>
</div>

<div class="clearfix"></div>
<div class="pos-mobile-body">
    <div class="cart-details">
        <!-- POS Data will be displayed here -->
    </div>

    <div class="checkout-footer">
        <div class="row no-print">
            <div class="pos-form-actions">
                @include('sale_pos.partials.pos_form_totals')
                <div>
                    <div class="pos-payment-options" @if($is_mobile) style="margin-top: -40px;" @endif>

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
                                </span>

                                <span id="total_discount"
                                    class="cursor-pointer"
                                    title="@lang('sale.edit_discount')"
                                    aria-hidden="true"
                                    data-toggle="modal"
                                    data-target="#posEditDiscountModal">
                                    0
                                </span>

                                <input type="hidden" id="total_discount_input" value="">
                                <input type="hidden" name="discount_type" id="discount_type" value="@if (empty($edit)) {{ 'percentage' }}@else{{ $transaction->discount_type }} @endif" data-default="percentage">
                                <input type="hidden" name="discount_amount" id="discount_amount" value="@if (empty($edit)) {{ @num_format($business_details->default_sales_discount) }} @else {{ @num_format($transaction->discount_amount) }} @endif" data-default="{{ $business_details->default_sales_discount }}">
                                <input type="hidden" name="rp_redeemed" id="rp_redeemed" value="@if (empty($edit)) {{ '0' }}@else{{ $transaction->rp_redeemed }} @endif">
                                <input type="hidden" name="rp_redeemed_amount" id="rp_redeemed_amount" value="@if (empty($edit)) {{ '0' }}@else {{ $transaction->rp_redeemed_amount }} @endif">
                            </div>

                            <div class="divider"></div>
                            <div class="discount-btn">
                                <span>@lang('sale.shipping')(+):
                                    <span id="shipping_charges_amount"
                                        class="cursor-pointer"
                                        title="@lang('sale.shipping')"
                                        aria-hidden="true"
                                        data-toggle="modal"
                                        data-target="#posShippingModal">
                                        0
                                    </span>
                                </span>
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
                                    <span id="order_tax"
                                        class="cursor-pointer"
                                        title="@lang('sale.edit_order_tax')"
                                        aria-hidden="true"
                                        data-toggle="modal"
                                        data-target="#posEditOrderTaxModal">
                                        @if (empty($edit))
                                        0
                                        @else
                                        {{ $transaction->tax_amount }}
                                        @endif
                                    </span>
                                </span>
                                <input type="hidden" id="order_tax_input" value="">
                                <input type="hidden" name="tax_rate_id" id="tax_rate_id" value="@if (empty($edit)) {{ $business_details->default_sales_tax }} @else {{ $transaction->tax_id }} @endif" data-default="{{ $business_details->default_sales_tax }}">
                                <input type="hidden" name="tax_calculation_amount" id="tax_calculation_amount" value="@if (empty($edit)) {{ @num_format($business_details->tax_calculation_amount) }} @else {{ @num_format(optional($transaction->tax)->amount) }} @endif" data-default="{{ $business_details->tax_calculation_amount }}">

                            </div>

                            @if (in_array('types_of_service', $enabled_modules))
                            <div class="divider"></div>
                            <div class="discount-btn">
                                <span>@lang('lang_v1.packing_charge')(+):</span>
                                <span id="packing_charge_text"
                                    class="cursor-pointer"
                                    title="@lang('sale.edit_packing_charge')"
                                    aria-hidden="true"
                                    data-toggle="modal"
                                    data-target="#posPackingChargeModal">
                                    0
                                </span>
                                <input type="hidden" id="packing_charge_input" value="">
                            </div>
                            @endif
                        </div>
                        <div class="total-payable">
                            <input type="hidden" name="final_total" id="final_total_input" value=0>
                            <h2>@lang('sale.total_payable'): <span id="total_payable">0</span></h2>
                            @moduleEnabled('CurrencyExchangeRate')
                            <div class="total-payable-target" style="display: none;">
                                <input type="hidden" name="final_total_target" id="final_total_target_input" value="0">
                                <h3>@lang('sale.total_payable'): <span id="currency_code"></span> <span id="total_payable">0</span></h3>
                            </div>
                            @endmoduleEnabled
                        </div>
                        <!-- Exchange Rate Module -->
                    </div>

                    <div class="pos-buttons-mobile" style="margin-top: 10px;">
                        <div class="button-container">
                            @if (!Gate::check('disable_pay_checkout') || auth()->user()->can('superadmin') || auth()->user()->can('admin'))
                            <button type="button" class="multipay btn btn-flat no-print @if ($pos_settings['disable_pay_checkout'] != 0) hide @endif" id="pos-finalize" title="@lang('lang_v1.tooltip_checkout_multi_pay')">
                                <i class="fas fa-money-check-alt" aria-hidden="true"></i> @lang('lang_v1.checkout_multi_pay')
                            </button>
                            @endif

                            @if (!Gate::check('disable_express_checkout') || auth()->user()->can('superadmin') || auth()->user()->can('admin'))
                            <button type="button" class="cash btn btn-flat no-print @if ($pos_settings['disable_express_checkout'] != 0 || !array_key_exists('cash', $payment_types)) hide @endif pos-express-finalize" data-pay_method="cash" title="@lang('tooltip.express_checkout')">
                                <i class="fas fa-money-bill-alt" aria-hidden="true"></i> @lang('lang_v1.express_checkout_cash')
                            </button>
                            @endif
                            @if( $restaurant_settings['enable_restaurant_module'] == "1" && $restaurant_settings['enable_kot'] == "1")
                            <button type="button" class="placeorder btn btn-flat pos-express-finalize order-2" data-pay_method="kot" title="@lang('lang_v1.print_kot')" style=" justify-content: center; white-space: nowrap;">
                                @lang('lang_v1.print_kot')
                            </button>
                            @endif



                        </div>
                        <div class="button-container-small">
                            @if (!Gate::check('disable_draft') || auth()->user()->can('superadmin') || auth()->user()->can('admin'))
                            <button type="button"
                                class="draft btn-pos-small order-1"
                                id="pos-draft" @if (!empty($only_payment)) disabled @endif>
                                <i class="fas fa-edit icon-background"></i> @lang('sale.draft')
                            </button>
                            @endif

                            @if (!Gate::check('disable_quotation') || auth()->user()->can('superadmin') || auth()->user()->can('admin'))
                            <button type="button"
                                class="quotation btn-pos-small order-2"
                                id="pos-quotation" @if (!empty($only_payment)) disabled @endif>
                                <i class="fas fa-edit icon-background"></i> @lang('lang_v1.quotation')
                            </button>
                            @endif

                            @if (!Gate::check('disable_suspend_sale') || auth()->user()->can('superadmin') || auth()->user()->can('admin'))
                            @if (empty($pos_settings['disable_suspend']))
                            <button type="button"
                                class="btn-suspend btn-pos-small pos-express-finalize order-3"
                                data-pay_method="suspend" title="@lang('lang_v1.tooltip_suspend')"
                                @if (!empty($only_payment)) disabled @endif>
                                <i class="fas fa-pause icon-background" aria-hidden="true"></i>
                                @lang('lang_v1.suspend')
                            </button>
                            @endif
                            @endif

                            @if (!Gate::check('disable_credit_sale') || auth()->user()->can('superadmin') || auth()->user()->can('admin'))
                            @if (empty($pos_settings['disable_credit_sale_button']))
                            <input type="hidden" name="is_credit_sale" value="0" id="is_credit_sale">
                            <button type="button"
                                class="credit-sale btn-pos-small pos-express-finalize order-4"
                                data-pay_method="credit_sale" title="@lang('lang_v1.tooltip_credit_sale')"
                                @if (!empty($only_payment)) disabled @endif>

                                <i class="fas fa-check icon-background" aria-hidden="true"></i>
                                <span class="no-wrap">@lang('lang_v1.credit_sale')
                                </span>
                            </button>
                            @endif
                            @endif

                            @if (!Gate::check('disable_card') || auth()->user()->can('superadmin') || auth()->user()->can('admin'))
                            <button type="button"
                                class="card-pay btn-pos-small  @if(!empty($pos_settings['disable_suspend'])) @endif pos-express-finalize @if(!array_key_exists('card', $payment_types)) hide @endif order-5"
                                data-pay_method="card" title="@lang('lang_v1.tooltip_express_checkout_card')">
                                <i class="fas fa-credit-card icon-background" aria-hidden="true"></i> @lang('lang_v1.express_checkout_card')
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
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