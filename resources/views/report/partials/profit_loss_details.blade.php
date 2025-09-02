<div class="report-head-flex">
    <div class="profit-analytics">
    <div class="profit-item">
            <div class="profit-heading">
                <img src="{{ asset('img/icons/report-icon.svg') }}" alt="report">
                {{--<span>Today</span>--}}
            </div>

            <div class="profit-footer">
                <div class="report-name">
                <h5 data-toggle="tooltip" data-placement="bottom" data-html="true" title="{{ __('lang_v1.cogs_help_text') }}">{{ __('lang_v1.cogs') }}</h5>
                                                                          
                    <h2 class="display_currency" data-currency_symbol="true">{{ ($data['opening_stock'] + $data['total_purchase'] - $data['closing_stock']) }}</h2>
                </div>

                <div class="report-status">
                    
                </div>
            </div>
        </div>
        <!-- Profile -->
        <div class="profit-item">
            <div class="profit-heading">
                <img src="{{ asset('img/icons/report-icon.svg') }}" alt="report">
                {{--<span>Today</span>--}}
            </div>

            <div class="profit-footer">
                <div class="report-name">
                <h5 data-toggle="tooltip" data-placement="bottom" data-html="true" title="
                (@lang('lang_v1.total_sell_price') - @lang('lang_v1.total_purchase_price'))
                 @if(!empty($data['gross_profit_label']))
                  {{-- + {{$data['gross_profit_label']}} --}}
                 @foreach ($data['gross_profit_label'] as $val)
                  + {{$val}}
                 @endforeach
                 @endif">
                 {{ __('lang_v1.gross_profit') }}</h5>
                    <h2 class="display_currency" data-currency_symbol="true">{{$data['gross_profit']}}</h2>
                </div>

                <div class="report-status">
                    
                </div>
            </div>
        </div>
        <!-- End Profit -->

        <!-- Profit -->
        <div class="profit-item">
            <div class="profit-heading">
                <img src="{{ asset('img/icons/report-icon.svg') }}" alt="report">
                {{--<span>Today</span>--}}
            </div>

            <div class="profit-footer">
                <div class="report-name">
                
                <h5 data-toggle="tooltip" data-placement="bottom" data-html="true" title="
                @lang('lang_v1.gross_profit') + (@lang('lang_v1.total_sell_shipping_charge') + @lang('lang_v1.sell_additional_expense') + @lang('report.total_stock_recovered') + @lang('lang_v1.total_purchase_discount') + @lang('lang_v1.total_sell_round_off') 
                @foreach($data['right_side_module_data'] as $module_data)
                 @if(!empty($module_data['add_to_net_profit']))
                + {{$module_data['label']}} 
                @endif
                @endforeach
                ) <br> - ( @lang('report.total_stock_adjustment') + @lang('report.total_expense') + @lang('lang_v1.total_purchase_shipping_charge') + @lang('lang_v1.total_transfer_shipping_charge') + @lang('lang_v1.purchase_additional_expense') + @lang('lang_v1.total_sell_discount') + @lang('lang_v1.total_reward_amount') 
                @foreach($data['left_side_module_data'] as $module_data)
                    @if(!empty($module_data['add_to_net_profit']))
                        + {{$module_data['label']}}
                    @endif 
                @endforeach )">
                {{ __('report.net_profit') }}</h5>
                    <h2 class="display_currency" data-currency_symbol="true">{{$data['net_profit']}}</h2>
                </div>

                <div class="report-status">
                    
                </div>
            </div>
        </div>
        <!-- End Profit -->
    </div>

</div>

<div class="two-table-grid">
    <table class="report-table">
        <caption>@lang('lang_v1.money_in')</caption>
        <thead>
            <tr>
                <th>@lang('report.stock_report')</th>
                <th>@lang('lang_v1.value')</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ __('report.closing_stock') }} (@lang('lang_v1.by_purchase_price'))</td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">{{$data['closing_stock']}}</span>
                </td>
            </tr>
            <tr>
                <td>{{ __('report.closing_stock') }} (@lang('lang_v1.by_sale_price'))</td>
                <td>
                    <span id="closing_stock_by_sp"><i class="fa fa-sync fa-spin fa-fw "></i></span>
                </td>
            </tr>
            <tr>
                <td>{{ __('home.total_sell') }}: <br>
                    <!-- sub type for total sales -->
                    @if(count($data['total_sell_by_subtype']) > 1)
                    <ul>
                        @foreach($data['total_sell_by_subtype'] as $sell)
                            <li>
                                <span class="display_currency" data-currency_symbol="true">
                                    {{$sell->total_before_tax}}    
                                </span>
                                @if(!empty($sell->sub_type))
                                    &nbsp;<small class="text-muted">({{ucfirst($sell->sub_type)}})</small>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                    @endif
                    <small class="text-muted"> 
                        (@lang('product.exc_of_tax'), @lang('sale.discount'))
                    </small>
                </td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">{{$data['total_sell']}}</span>
                </td>
            </tr>
            <tr>
                <td>{{ __('lang_v1.total_sell_shipping_charge') }}</td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">{{$data['total_sell_shipping_charge']}}</span>
                </td>
            </tr>
             <tr>
                <td>{{ __('lang_v1.sell_additional_expense') }}</td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">{{$data['total_sell_additional_expense']}}</span>
                </td>
            </tr>
            <tr>
                <td>{{ __('report.total_stock_recovered') }}</td>
                <td>
                     <span class="display_currency" data-currency_symbol="true">{{$data['total_recovered']}}</span>
                </td>
            </tr>
            <tr>
                <td>{{ __('lang_v1.total_purchase_return') }}</td>
                <td>
                     <span class="display_currency" data-currency_symbol="true">{{$data['total_purchase_return']}}</span>
                </td>
            </tr>
            <tr>
                <td>{{ __('lang_v1.total_purchase_discount') }}</td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">{{$data['total_purchase_discount']}}</span>
                </td>
            </tr> 
            <tr>
                <td>{{ __('lang_v1.total_sell_round_off') }}</td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">{{$data['total_sell_round_off']}}</span>
                </td>
            </tr>
            @foreach($data['right_side_module_data'] as $module_data)
                <tr>
                    <td>{{ $module_data['label'] }}</td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">{{ $module_data['value'] }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <table class="report-table">
        <caption>@lang('lang_v1.money_out')</caption>
        <thead>
            <tr>
            <th>@lang('report.stock_report')</th>
            <th>@lang('lang_v1.value')</th>
            </tr>
        </thead>
        <tbody>
             <tr>
                <td>{{ __('report.opening_stock') }} (@lang('lang_v1.by_purchase_price'))</td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">{{$data['opening_stock']}}</span>
                </td>
            </tr>
            <tr>
                <td>{{ __('report.opening_stock') }} (@lang('lang_v1.by_sale_price'))</td>
                <td>
                    <span id="opening_stock_by_sp"><i class="fa fa-sync fa-spin fa-fw "></i></span>
                </td>
            </tr> 
            <tr>
                <td>{{ __('home.total_purchase') }} (@lang('product.exc_of_tax'), @lang('sale.discount'))</td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">{{$data['total_purchase']}}</span>
                </td>
            </tr>
            <tr>
                <td>{{ __('report.total_stock_adjustment') }}:</td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">{{$data['total_adjustment']}}</span>
                </td>
            </tr> 
            <tr>
                <td>{{ __('report.total_expense') }}</td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">{{$data['total_expense']}}</span>
                </td>
            </tr>
             <tr>
                <td>{{ __('lang_v1.total_purchase_shipping_charge') }}</td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">{{$data['total_purchase_shipping_charge']}}</span>
                </td>
            </tr>
            <tr>
                <td>{{ __('lang_v1.purchase_additional_expense') }}</td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">{{$data['total_purchase_additional_expense']}}</span>
                </td>
            </tr>
            <tr>
                <td>{{ __('lang_v1.total_transfer_shipping_charge') }}</td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">{{$data['total_transfer_shipping_charges']}}</span>
                </td>
            </tr>
            <tr>
                <td>{{ __('lang_v1.total_sell_discount') }}</td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">{{$data['total_sell_discount']}}</span>
                </td>
            </tr>
          <tr>
                <td>{{ __('lang_v1.total_reward_amount') }}</td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">{{$data['total_reward_amount']}}</span>
                </td>
            </tr>
            <tr>
                <td>{{ __('lang_v1.total_sell_return') }}:</td>
                <td>
                    <span class="display_currency" data-currency_symbol="true">{{$data['total_sell_return']}}</span>
                </td>
            </tr>
            @foreach($data['left_side_module_data'] as $module_data)
                <tr>
                    <td>{{ $module_data['label'] }}</td>
                    <td>
                        <span class="display_currency" data-currency_symbol="true">{{ $module_data['value'] }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>