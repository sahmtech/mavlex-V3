<style>
    @media (max-width: 768px) {
.pos-wrapper .pos-content .pos-table .pos-buttons .cash {
        border-radius: 8px;
        border: 1px solid #16A34A;
        background: #16A34A;
        font-size: 1rem;
        font-weight: 500;
        color: #ffffff;
        cursor: pointer;
        width: 160px;
        height: 45px;
    }

    .pos-wrapper .pos-content .pos-table .pos-buttons  .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        border-radius: 8px !important;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        flex: 1;
        max-width: calc(33.33% - 10px);
    }

    .multipay {
        background-color: #001f3f;
        color: white;
    }

    .cash {
        border: 1px solid #16A34A;
        background: #16A34A;
        color: white;
    }

    .suspend {
        background-color: #ff4136;
        color: white;
    }

    .btn i {
        margin-right: 5px;
    }

    .button-container-small {
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-wrap: nowrap;
    width: 100%;
    background-color: #f8f9fa; 
    padding: 10px 0; 
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    border-top: 1px solid #ddd;
    z-index: 1000; 
    border-radius: 15px;
    border-top-left-radius: 20px; 
    border-top-right-radius: 20px;
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);

}

.input-group-addon {
border: none;
    padding-right: 37px!important; 
}
.input-group-btn{
   padding: none!important;
}
 .button-container {
    display: flex;
    justify-content: space-around; 
    align-items: center;
    flex-wrap: nowrap;
    max-width: 100%;
    margin-bottom: 100px; 
}
.btn-pos-small {
    display: inline-flex;
    flex-direction: column; 
    align-items: center;
    justify-content: center;
    padding: 5px 10px;
    border-radius: 5px;
    font-size: 12px;
    font-weight: bold;
    cursor: pointer;
    background: none;
    border: none;
    color: #333;
    text-align: center;
    width: 60px;
}
.icon-background {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%; 
    border: 1px solid darkgrey;
    color: white; 
    margin-bottom: 5px;
}
.draft .fa-edit {
    color: #009ce4;
}

.quotation .fa-edit {
    color: #E7A500;
}

.btn-suspend .fa-pause {
    color: #EF4B51;
}

.credit-sale .fa-check {
    color: #5E5CA8;
}


.card-pay .fa-credit-card {
    color: #D61B60;
}

.btn-pos-small i {
    margin-bottom: 3px;
    font-size: 18px; 
}
.no-wrap {
    white-space: nowrap;

}
}
</style>
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
        

        @if (empty($edit))
        <button type="button" class="suspend btn btn-flat" id="pos-cancel">
            <i class="fas fa-window-close"></i> @lang('sale.cancel')
        </button>
        @else
        <button type="button" class="suspend btn btn-flat" id="pos-delete" @if (!empty($only_payment)) disabled @endif>
            <i class="fas fa-trash-alt"></i> @lang('messages.delete')
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