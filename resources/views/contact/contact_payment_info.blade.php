<div class="customer-details-wrapper">
    <div class="customer-name">

        <h3>@lang('sale.payment_info')</h3>
    </div>

    <div class="customer-address">
        @if( $contact->type == 'supplier' || $contact->type == 'both')
            <div class="item">
                <span>@lang('report.total_purchase')</span>
                <strong class="display_currency" data-currency_symbol="true">
                    {{ $contact->total_purchase }}
                </strong>
            </div>
            <div class="item">
                <span>@lang('contact.total_purchase_paid')</span>
                <strong class="display_currency" data-currency_symbol="true">
                    {{ $contact->purchase_paid }}
                </strong>
            </div>
            <div class="item">
                <span>@lang('contact.total_purchase_due')</span>
                <strong class="display_currency" data-currency_symbol="true">
                    {{ $contact->total_purchase - $contact->purchase_paid }}
                </strong>
            </div>  
        @endif
        
        @if( $contact->type == 'customer' || $contact->type == 'both')
        @php
        $total_sell = $contact->total_invoice - $contact->total_sell_return;
        $total_sell_payment = $contact->invoice_received  - $contact->sell_return_paid;
        @endphp
            <div class="item">
                <span>@lang('report.total_sell')</span>
                <strong class="display_currency" data-currency_symbol="true">
                    {{ $total_sell }}
                </strong>
               
            </div>

            <div class="item">
                <span>@lang('contact.total_sale_paid')</span>
                <strong class="display_currency" data-currency_symbol="true">
                    {{ $total_sell_payment }}
                </strong>
            </div>
            <div class="item">
                <span>@lang('contact.total_sale_due')</span>
                <strong class="display_currency" data-currency_symbol="true">
                    {{ $contact->total_invoice - $contact->invoice_received }}
                </strong>
            </div>
            
           
            <div class="item">
                <span>@lang('lang_v1.sell_return_due')</span>
                <strong class="display_currency" data-currency_symbol="true">
                    {{ $contact->total_sell_return - $contact->sell_return_paid }}
                </strong>
            </div>

            <div class="item">
                <span>@lang('lang_v1.total_due')</span>
                <strong class="display_currency" data-currency_symbol="true">
                    {{ $total_sell - $total_sell_payment }}
                </strong>
            </div>
            


        @endif
        
        @if(!empty($contact->opening_balance) && $contact->opening_balance != '0.00')
            <div class="item">
                <span>@lang('lang_v1.opening_balance')</span>
                <strong class="display_currency" data-currency_symbol="true">
                    {{ $contact->opening_balance }}
                </strong>
            </div>

            <div class="item">
                <span>@lang('lang_v1.opening_balance_due')</span>
                <strong class="display_currency" data-currency_symbol="true">
                    {{ $contact->opening_balance - $contact->opening_balance_paid }}
                </strong>
            </div>
        @endif

        <div class="item">
            <span>@lang('lang_v1.advance_balance')</span>
            <strong class="display_currency" data-currency_symbol="true">
                {{ $contact->balance }}
            </strong>               
        </div>
    </div>
</div>