<div class="pos-tab-content">
            {!! Form::hidden('is_pos_setting', 1) !!}
            <h4>@lang('business.add_keyboard_shortcuts'):</h4>
            <p class="help-block">@lang('lang_v1.shortcut_help'); @lang('lang_v1.example'): <b>ctrl+shift+b</b>, <b>ctrl+h</b></p>
            <p class="help-block">
                <b>@lang('lang_v1.available_key_names_are'):</b>
                <br> shift, ctrl, alt, backspace, tab, enter, return, capslock, esc, escape, space, pageup, pagedown, end, home, <br>left, up, right, down, ins, del, and plus
            </p>
            <div class="row">
                <div class="col-sm-6">
                    <table class="table table-striped">
                        <tr>
                            <th>@lang('business.operations')</th>
                            <th>@lang('business.keyboard_shortcut')</th>
                        </tr>
                        <tr>
                            <td>{!! __('sale.express_finalize') !!}:</td>
                            <td>
                                {!! Form::text('shortcuts[pos][express_checkout]', 
                                !empty($shortcuts["pos"]["express_checkout"]) ? $shortcuts["pos"]["express_checkout"] : null, ['class' => 'form-control']); !!}
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('sale.finalize'):</td>
                            <td>
                                {!! Form::text('shortcuts[pos][pay_n_ckeckout]', !empty($shortcuts["pos"]["pay_n_ckeckout"]) ? $shortcuts["pos"]["pay_n_ckeckout"] : null, ['class' => 'form-control']); !!}
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('sale.draft'):</td>
                            <td>
                                {!! Form::text('shortcuts[pos][draft]', !empty($shortcuts["pos"]["draft"]) ? $shortcuts["pos"]["draft"] : null, ['class' => 'form-control']); !!}
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('messages.cancel'):</td>
                            <td>
                                {!! Form::text('shortcuts[pos][cancel]', !empty($shortcuts["pos"]["cancel"]) ? $shortcuts["pos"]["cancel"] : null, ['class' => 'form-control']); !!}
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('lang_v1.recent_product_quantity'):</td>
                            <td>
                                {!! Form::text('shortcuts[pos][recent_product_quantity]', !empty($shortcuts["pos"]["recent_product_quantity"]) ? $shortcuts["pos"]["recent_product_quantity"] : null, ['class' => 'form-control']); !!}
                            </td>
                        </tr>
                        
                    </table>
                </div>
                <div class="col-sm-6">
                    <table class="table table-striped">
                        <tr>
                            <th>@lang('business.operations')</th>
                            <th>@lang('business.keyboard_shortcut')</th>
                        </tr>
                        <tr>
                            <td>@lang('sale.edit_discount'):</td>
                            <td>
                                {!! Form::text('shortcuts[pos][edit_discount]', !empty($shortcuts["pos"]["edit_discount"]) ? $shortcuts["pos"]["edit_discount"] : null, ['class' => 'form-control']); !!}
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('sale.edit_order_tax'):</td>
                            <td>
                                {!! Form::text('shortcuts[pos][edit_order_tax]', !empty($shortcuts["pos"]["edit_order_tax"]) ? $shortcuts["pos"]["edit_order_tax"] : null, ['class' => 'form-control']); !!}
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('sale.add_payment_row'):</td>
                            <td>
                                {!! Form::text('shortcuts[pos][add_payment_row]', !empty($shortcuts["pos"]["add_payment_row"]) ? $shortcuts["pos"]["add_payment_row"] : null, ['class' => 'form-control']); !!}
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('sale.finalize_payment'):</td>
                            <td>
                                {!! Form::text('shortcuts[pos][finalize_payment]', !empty($shortcuts["pos"]["finalize_payment"]) ? $shortcuts["pos"]["finalize_payment"] : null, ['class' => 'form-control']); !!}
                            </td>
                        </tr>
                        <tr>
                            <td>@lang('lang_v1.add_new_product'):</td>
                            <td>
                                {!! Form::text('shortcuts[pos][add_new_product]', !empty($shortcuts["pos"]["add_new_product"]) ? $shortcuts["pos"]["add_new_product"] : null, ['class' => 'form-control']); !!}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <h4>@lang('lang_v1.pos_settings'):</h4>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[disable_pay_checkout]', 0) !!}
                            <label class="switch" for="disable_pay_checkout">
                                {!! Form::checkbox('pos_settings[disable_pay_checkout]', 1, $pos_settings['disable_pay_checkout'] ,  [ 'id' => 'disable_pay_checkout']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.disable_pay_checkout' ) }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[disable_draft]', 0) !!}
                            <label class="switch" for="disable_draft">
                                {!! Form::checkbox('pos_settings[disable_draft]', 1,  
                                $pos_settings['disable_draft'] , 
                            [ 'id' => 'disable_draft']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.disable_draft' ) }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[disable_express_checkout]', 0) !!}
                            <label class="switch" for="disable_express_checkout">
                                {!! Form::checkbox('pos_settings[disable_express_checkout]', 1,  
                                $pos_settings['disable_express_checkout'] , 
                            [ 'id' => 'disable_express_checkout']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.disable_express_checkout' ) }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;" >
                            {!! Form::hidden('pos_settings[hide_product_suggestion]', 0) !!}
                            <label class="switch" for="hide_product_suggestion">
                                {!! Form::checkbox('pos_settings[hide_product_suggestion]', 1,  $pos_settings['hide_product_suggestion'] , 
                            [ 'id' => 'hide_product_suggestion']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.hide_product_suggestion' ) }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[hide_recent_trans]', 0) !!}
                            <label class="switch" for="hide_recent_trans">
                                {!! Form::checkbox('pos_settings[hide_recent_trans]', 1,  $pos_settings['hide_recent_trans'] , 
                            [ 'id' => 'hide_recent_trans']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.hide_recent_trans' ) }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[disable_discount]', 0) !!}
                            <label class="switch" for="disable_discount">
                                {!! Form::checkbox('pos_settings[disable_discount]', 1,  $pos_settings['disable_discount'] , 
                            [ 'id' => 'disable_discount']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.disable_discount' ) }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[disable_order_tax]', 0) !!}
                            <label class="switch" for="disable_order_tax">
                                {!! Form::checkbox('pos_settings[disable_order_tax]', 1,  $pos_settings['disable_order_tax'] , 
                            [ 'id' => 'disable_order_tax']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.disable_order_tax' ) }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[is_pos_subtotal_editable]', 0) !!}
                            <label class="switch" for="is_pos_subtotal_editable">
                                {!! Form::checkbox('pos_settings[is_pos_subtotal_editable]', 1,  
                            empty($pos_settings['is_pos_subtotal_editable']) ? 0 : 1 , 
                            [ 'id' => 'is_pos_subtotal_editable']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.is_pos_subtotal_editable' ) }}</p>@show_tooltip(__('lang_v1.subtotal_editable_help_text'))
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[disable_suspend]', 0) !!}
                            <label class="switch" for="disable_suspend">
                                {!! Form::checkbox('pos_settings[disable_suspend]', 1,  
                            empty($pos_settings['disable_suspend']) ? 0 : 1 , 
                            [ 'id' => 'disable_suspend']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.disable_suspend_sale' ) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[enable_transaction_date]', 0) !!}
                            <label class="switch" for="enable_pos_transaction_date">
                                {!! Form::checkbox('pos_settings[enable_transaction_date]', 1,  
                            empty($pos_settings['enable_transaction_date']) ? 0 : 1 , 
                            [ 'id' => 'enable_pos_transaction_date']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.enable_pos_transaction_date' ) }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[inline_service_staff]', 0) !!}
                            <label class="switch" for="inline_service_staff">
                                {!! Form::checkbox('pos_settings[inline_service_staff]', 1,  
                            !empty($pos_settings['inline_service_staff']) ? true : false , 
                            [ 'id' => 'inline_service_staff']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.enable_service_staff_in_product_line' ) }}</p>@show_tooltip(__('lang_v1.inline_service_staff_tooltip'))
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[is_service_staff_required]', 0) !!}
                            <label class="switch" for="is_service_staff_required">
                                {!! Form::checkbox('pos_settings[is_service_staff_required]', 1,  
                            empty($pos_settings['is_service_staff_required']) ? 0 : 1 , 
                            [ 'id' => 'is_service_staff_required']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.is_service_staff_required' ) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[disable_credit_sale_button]', 0) !!}
                            <label class="switch" for="disable_credit_sale_button">
                                {!! Form::checkbox('pos_settings[disable_credit_sale_button]', 1,  
                            empty($pos_settings['disable_credit_sale_button']) ? 0 : 1 , 
                            [ 'id' => 'disable_credit_sale_button']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.disable_credit_sale_button' ) }}</p>@show_tooltip(__('lang_v1.show_credit_sale_btn_help'))
                        </div>
                    </div>
                </div>

                

                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[show_invoice_scheme]', 0) !!}
                            <label class="switch" for="show_invoice_scheme">
                                {!! Form::checkbox('pos_settings[show_invoice_scheme]', 1,  
                               empty($pos_settings['show_invoice_scheme']) ? 0 : 1 , 
                            [ 'id' => 'show_invoice_scheme']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.show_invoice_scheme' ) }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[show_invoice_layout]', 0) !!}
                            <label class="switch" for="show_invoice_layout">
                                {!! Form::checkbox('pos_settings[show_invoice_layout]', 1,  
                                !empty($pos_settings['show_invoice_layout']) , 
                            [ 'id' => 'show_invoice_layout']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.show_invoice_layout' ) }}</p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[print_on_suspend]', 0) !!}
                            <label class="switch" for="print_on_suspend">
                                {!! Form::checkbox('pos_settings[print_on_suspend]', 1,  
                                    
                                !empty($pos_settings['print_on_suspend']) , 
                            [ 'id' => 'print_on_suspend']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.print_on_suspend' ) }}</p>
                        </div>
                    </div>
                </div>
               
                
                <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[show_pricing_on_product_sugesstion]', 0) !!}
                            <label class="switch" for="show_pricing_on_product_sugesstion">
                                {!! Form::checkbox('pos_settings[show_pricing_on_product_sugesstion]', 1,  
                                !empty($pos_settings['show_pricing_on_product_sugesstion']) , 
                            [ 'id' => 'show_pricing_on_product_sugesstion']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.show_pricing_on_product_sugesstion' ) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4" data-toggle="tooltip" data-placement="bottom" title="@lang('lang_v1.show_product_qty_tooltip')"  data-html="true">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[show_product_qty]', 0) !!}
                            <label class="switch" for="show_product_qty">
                                {!! Form::checkbox('pos_settings[show_product_qty]', 1,  
                                !empty($pos_settings['show_product_qty']) , 
                            [ 'id' => 'show_product_qty']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.show_product_qty' ) }}</p>
                        </div>
                    </div>
                </div>
            
            <div class="col-sm-4" data-toggle="tooltip" data-placement="bottom" title="@lang('lang_v1.show_price_check_tooltip')"  data-html="true">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[show_price_check]', 0) !!}
                            <label class="switch" for="show_price_check">
                                {!! Form::checkbox('pos_settings[show_price_check]', 1,  
                                !empty($pos_settings['show_price_check']) , 
                            [ 'id' => 'show_price_check']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.show_price_check' ) }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-4" data-toggle="tooltip" data-placement="bottom" title="@lang('lang_v1.enable_weighing_scale')"  data-html="true">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[enable_weighing_scale]', 0) !!}
                            <label class="switch" for="enable_weighing_scale">
                                {!! Form::checkbox('pos_settings[enable_weighing_scale]', 1,  
                                !empty($pos_settings['enable_weighing_scale']) , 
                            [ 'id' => 'enable_weighing_scale']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.enable_weighing_scale' ) }}</p>
                        </div>
                    </div>
                </div>
           
            @if(Module::has('CurrencyExchangeRate'))
            <div class="col-sm-4" data-toggle="tooltip" data-placement="bottom" title="@lang('lang_v1.disable_currency_exchange_tooltip')"  data-html="true">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">
                            {!! Form::hidden('pos_settings[disable_currency_exchange]', 0) !!}
                            <label class="switch" for="disable_currency_exchange">
                                {!! Form::checkbox('pos_settings[disable_currency_exchange]', 1,  
                                !empty($pos_settings['disable_currency_exchange']) , 
                            [ 'id' => 'disable_currency_exchange']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'lang_v1.disable_currency_exchange' ) }}</p>
                        </div>
                    </div>
                </div>
            @endif
             <div class="col-sm-4">
                    <div class="form-group">
                        <div class="toggle-wrapper" style="display: flex; gap: 10px; margin-top: 1.5rem;">                     
                            {!! Form::hidden('enable_instant_pos', 0) !!}
                            <label class="switch" for="enable_instant_pos">
                                {!! Form::checkbox('enable_instant_pos', 1, $business->enable_instant_pos , ['id' => 'enable_instant_pos']); !!}
                                <div class="sliderCheckbox round"></div>
                            </label>
                            <p>{{ __( 'settings.enable_instant_pos' ) }}</p>@show_tooltip(__('settings.enable_instant_pos_help'))
                        </div>
                    </div>
                </div>
            </div>
</div>