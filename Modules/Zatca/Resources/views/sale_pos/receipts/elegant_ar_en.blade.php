@inject('transactionUtil', 'app\Utils\TransactionUtil')
<div class="elegant-table">
    <table class="table" style="">
        <tbody>
            <tr>
                <td>
                    <table class="table">  
                        <tr>
                            @if (!empty($receipt_details->letter_head))
                            <td class="rtl" width="100% !important">
                            <img style="width: 100% !important;" src="{{ $receipt_details->letter_head }}">
                            </td>
                             @endif
                            <td class="rtl" width="33.3%">
                                @if (empty($receipt_details->letter_head))
                                <div class="width-50 f-left" align="center" style="color: #22489B;padding-top: 5px;">
                                    <strong style="font-size: 20px;">
                                        {!! $receipt_details->display_name !!}
                                    </strong>
                                    <div style="font-size: 14px;" align="center">
                                         
                                        {!! $receipt_details->address !!} 
                                        {{-- location custom info --}}

                                        @if (!empty($receipt_details->location_custom_field_2_label) &&
                                        !empty($receipt_details->location_custom_field_2_value))
                                        <br>
                                        {{ $receipt_details->location_custom_field_2_label }} : {!!
                                        $receipt_details->location_custom_field_2_value !!}
                                        @endif

                                        @if (!empty($receipt_details->location_custom_field_3_label) &&
                                        !empty($receipt_details->location_custom_field_3_value))
                                        <br>
                                        {{ $receipt_details->location_custom_field_3_label }} : {!!
                                        $receipt_details->location_custom_field_3_value !!}
                                        @endif

                                        @if (!empty($receipt_details->location_custom_field_4_label) &&
                                        !empty($receipt_details->location_custom_field_4_value))
                                        <br>
                                        {{ $receipt_details->location_custom_field_4_label }} : {!!
                                        $receipt_details->location_custom_field_4_value !!}
                                        @endif
                                    </div>
                                </div>
                            </td>
                            
                            <td class="center" width="33.3%">
                                
                                <!-- Logo -->
                                @if (!empty($receipt_details->logo))
                                    <img style="max-height: 120px; width: auto;" src="{{ $receipt_details->logo }}"
                                        class="img center-block">
                                    <br />
                                @endif
                                @endif
                            </td>
                            <td class="center" width="33.3%">
                                @php
                                $qr_code_text = $receipt_details->qr_code_text;
                                $cleaned_qr_code_text = preg_replace('/<\?xml.*\?>/', '', $qr_code_text);
                                    @endphp
                                    @if ($receipt_details->show_barcode || $receipt_details->show_qr_code)
                                    <div class="text-center" dir="ltr">
                                        @if (isset($receipt_details->is_connected) &&
                                        $receipt_details->is_connected &&
                                        $receipt_details->show_qr_code &&
                                        !empty($receipt_details->qr_code_text))
                                        {!! $cleaned_qr_code_text !!}
                                        @elseif($receipt_details->show_qr_code &&
                                        !empty($receipt_details->qr_code_text))
                                        <img class="center-block" style="width: 200px"
                                            src="data:image/png;base64,{{ DNS2D::getBarcodePNG($receipt_details->qr_code_text, 'QRCODE') }}">
                                        @endif
                                        <!-- Barcode -->
                                        @if ($receipt_details->show_barcode)
                                        <img class="center-block"
                                            src="data:image/png;base64,{{ DNS1D::getBarcodePNG($receipt_details->invoice_no, 'C128', 2, 30, [39, 48, 54], true) }}">
                                        @endif
                                    </div>
                                    @endif


                            </td>
                        </tr>
                    </table>
                </div>
            <h3 class="center"> {{$receipt_details->invoice_heading}} / {{$receipt_details->invoice_heading_en}}</h3>

        <table class="table table-bordered">
            <tr class="gray-bg">
                <td><strong>{{$receipt_details->invoice_no_prefix_en}} <br> {{$receipt_details->invoice_no_prefix}}</strong>
                    <br>
                    @if (!empty($receipt_details->invoice_no))
                    {!! $receipt_details->invoice_no !!}
                    @endif
                </td>
                <td><strong> {{$receipt_details->date_label_en}}<br>{{$receipt_details->date_label}} </strong>
                    <br>
                    {!! $receipt_details->invoice_date !!}
                </td>@if(!empty($receipt_details->due_date_label))
                <td><strong>{{$receipt_details->due_date_label_en}}<b> {{$receipt_details->due_date_label}}</strong>
                    {{ $receipt_details->due_date ?? '' }}
                </td>
                @endif
                {{-- <td> {{@format_date($transaction->due_date) }}</td> --}}
                <td><strong>Payment Terms<br>شروط الدفع</strong>
                    <br>
                    @if (!empty($transaction->pay_term_number) && !empty($transaction->pay_term_type))
                    {{ ucfirst($transaction->pay_term_number) }} {{ ucfirst($transaction->pay_term_type) }}
                    @else
                    N/A
                    @endif
                </td>

            </tr>
        </table>

        <table class="table table-bordered" style="margin-top: 15px;">
            <tr class="gray-bg">
                <td width="50%"><strong> البائع / Seller </strong></td>
                <td width="50%"><strong> المشتري / Buyer</strong></td>
            </tr>
            <tr>
                <td class="border">
                    <address>
                        {{ $receipt_details->crn_name ?? '' }}<br>
                        {{ $receipt_details->street_name ?? '' }}, {{ $receipt_details->building_number ??
                        '' }},
                        {{ $receipt_details->plot_identification ?? '' }}<br>
                        {{ $receipt_details->city_sub_division ?? '' }}, {{ $receipt_details->city ?? '' }},
                        {{ $receipt_details->postal_number ?? '' }}<br>
                        {{ $receipt_details->country ?? '' }} <br>
                        @if (!empty ($receipt_details->contact))
                        {!! $receipt_details->contact !!}
                        <br>
                        @endif
                        {{ __('zatca::lang.vat') }}: {{ $receipt_details->vat_number ?? '' }}<br>
                        {{ __('zatca::lang.crn') }}: {{ $receipt_details->crn_number ?? '' }}
                    </address>
                </td>
                <td class="border">
                    {!! ltrim($receipt_details->customer_info_address, '<br>') !!}
                    @if (!empty($receipt_details->customer_custom_fields))
                    {!! $receipt_details->customer_custom_fields !!}
                    @endif
                    @if(!empty($receipt_details->customer_tax_label))
                    <br />
                    <strong>{{ $receipt_details->customer_tax_label }}</strong> {{ $receipt_details->customer_tax_number }}
                    @endif
                </td>
            </tr>
        </table>

        <div class="description">
            <div class="word-wrap">
                <p class="text-right color-555">
                    @if (!empty($receipt_details->brand_label) || !empty($receipt_details->repair_brand))
                    @if (!empty($receipt_details->brand_label))
                    <span class="pull-left">
                        <strong>{!! $receipt_details->brand_label !!}</strong>
                    </span>
                    @endif
                    {{ $receipt_details->repair_brand }}<br>
                    @endif

                    @if (!empty($receipt_details->device_label) || !empty($receipt_details->repair_device))
                    @if (!empty($receipt_details->device_label))
                    <span class="pull-left">
                        <strong>{!! $receipt_details->device_label !!}</strong>
                    </span>
                    @endif
                    {{ $receipt_details->repair_device }}<br>
                    @endif

                    @if (!empty($receipt_details->model_no_label) || !empty($receipt_details->repair_model_no))
                    @if (!empty($receipt_details->model_no_label))
                    <span class="pull-left">
                        <strong>{!! $receipt_details->model_no_label !!}</strong>
                    </span>
                    @endif
                    {{ $receipt_details->repair_model_no }} <br>
                    @endif

                    @if (!empty($receipt_details->serial_no_label) ||
                    !empty($receipt_details->repair_serial_no))
                    @if (!empty($receipt_details->serial_no_label))
                    <span class="pull-left">
                        <strong>{!! $receipt_details->serial_no_label !!}</strong>
                    </span>
                    @endif

                    {{ $receipt_details->repair_serial_no }}<br>
                    @endif
                    @if (!empty($receipt_details->repair_status_label) ||
                    !empty($receipt_details->repair_status))
                    @if (!empty($receipt_details->repair_status_label))
                    <span class="pull-left">
                        <strong>{!! $receipt_details->repair_status_label !!}</strong>
                    </span>
                    @endif
                    {{ $receipt_details->repair_status }}<br>
                    @endif

                    @if (!empty($receipt_details->repair_warranty_label) ||
                    !empty($receipt_details->repair_warranty))
                    @if (!empty($receipt_details->repair_warranty_label))
                    <span class="pull-left">
                        <strong>{!! $receipt_details->repair_warranty_label !!}</strong>
                    </span>
                    @endif
                    {{ $receipt_details->repair_warranty }}
                    <br>
                    @endif
                </p>
            </div>
        </div>
            @if (!empty($receipt_details->shipping_custom_field_1_label) ||
            !empty($receipt_details->shipping_custom_field_2_label))
            <div class="row">
                <div class="col-xs-6">
                    @if (!empty($receipt_details->shipping_custom_field_1_label))
                    <strong>{!! $receipt_details->shipping_custom_field_1_label !!} :</strong> {!!
                    $receipt_details->shipping_custom_field_1_value ?? '' !!}
                    @endif
                </div>
                <div class="col-xs-6">
                    @if (!empty($receipt_details->shipping_custom_field_2_label))
                    <strong>{!! $receipt_details->shipping_custom_field_2_label !!}:</strong> {!!
                    $receipt_details->shipping_custom_field_2_value ?? '' !!}
                    @endif
                </div>
            </div>
            @endif
            @if (!empty($receipt_details->shipping_custom_field_3_label) ||
            !empty($receipt_details->shipping_custom_field_4_label))
            <div class="row">
                <div class="col-xs-6">
                    @if (!empty($receipt_details->shipping_custom_field_3_label))
                    <strong>{!! $receipt_details->shipping_custom_field_3_label !!} :</strong> {!!
                    $receipt_details->shipping_custom_field_3_value ?? '' !!}
                    @endif
                </div>
                <div class="col-xs-6">
                    @if (!empty($receipt_details->shipping_custom_field_4_label))
                    <strong>{!! $receipt_details->shipping_custom_field_4_label !!}:</strong> {!!
                    $receipt_details->shipping_custom_field_4_value ?? '' !!}
                    @endif
                </div>
            </div>
            @endif
            @if (!empty($receipt_details->shipping_custom_field_5_label))
            <div class="row">
                <div class="col-xs-6">
                    @if (!empty($receipt_details->shipping_custom_field_5_label))
                    <strong>{!! $receipt_details->shipping_custom_field_5_label !!} :</strong> {!!
                    $receipt_details->shipping_custom_field_5_value ?? '' !!}
                    @endif
                </div>
            </div>
            @endif
            @if (!empty($receipt_details->sale_orders_invoice_no) ||
            !empty($receipt_details->sale_orders_invoice_date))
            <div class="row">
                <div class="col-xs-6">
                    <strong>@lang('restaurant.order_no'):</strong> {!! $receipt_details->sale_orders_invoice_no ??
                    '' !!}
                </div>
                <div class="col-xs-6">
                    <strong>@lang('lang_v1.order_dates'):</strong> {!! $receipt_details->sale_orders_invoice_date ??
                    '' !!}
                </div>
            </div>
            @endif

    <table class="table table-bordered table-no-top-cell-border table-slim mb-12 table-1" autosize="1"
        style="width:100%;">
        <thead>
            <tr style="" class="table-no-side-cell-border table-no-top-cell-border text-center">
                <td
                    style="background-color: #f2f2f2 !important; -webkit-print-color-adjust: exact; color: black !important; width: 5% !important">
                    # </td>
                @php
                $p_width = 40;
                @endphp
                @if ($receipt_details->show_cat_code == 1)
                @php
                $p_width -= 10;
                @endphp
                @endif
                @if (!empty($receipt_details->item_discount_label))
                @php
                $p_width -= 10;
                @endphp
                @endif
                <td
                    style="background-color: #f2f2f2!important; -webkit-print-color-adjust: exact; color: black !important; width: {{ $p_width }}% !important">
                    {{ $receipt_details->table_product_label }}
                    <br>{{ $receipt_details->table_product_label_en }}
                </td>

                @if ($receipt_details->show_cat_code == 1)
                <td
                    style="background-color:#f2f2f2 !important; -webkit-print-color-adjust: exact; color: black !important; width: 10% !important;">
                    {{ $receipt_details->cat_code_label }}
                    <br>{{ $receipt_details->cat_code_label_en }}
                </td>
                @endif
                <td
                    style="background-color: #f2f2f2 !important; -webkit-print-color-adjust: exact; color: black !important; width: 15% !important;">
                    {{ $receipt_details->table_qty_label }}
                    <br>{{ $receipt_details->table_qty_label_en }}
                </td>
                <td
                    style="background-color: #f2f2f2 !important; -webkit-print-color-adjust: exact; color: black !important; width: 15% !important;">
                    {{ $receipt_details->table_unit_price_label }}
                    <br>{{ $receipt_details->table_unit_price_label_en }}
                </td>
                @if (!empty($receipt_details->item_discount_label))
                <td
                    style="background-color: #f2f2f2 !important; -webkit-print-color-adjust: exact; color: black !important; width: 10% !important;">
                    {{ $receipt_details->item_discount_label }}
                    <br>{{ $receipt_details->item_discount_label_en }}
                </td>
                @endif
                <td
                    style="background-color: #f2f2f2 !important; -webkit-print-color-adjust: exact; color: black !important; width: 10% !important;">

                    {{$receipt_details->line_tax_label}}<br>{{ $receipt_details->line_tax_label_en }}
                </td>
                <td
                    style="background-color: #f2f2f2 !important; -webkit-print-color-adjust: exact; color: black !important; width: 15% !important;">
                    {{ $receipt_details->table_subtotal_label }}
                    <br>{{ $receipt_details->table_subtotal_label_en }}
                </td>
            </tr>
        </thead>
        <tbody>
            @php 
            $subtotal = 0;
            $total_tax = 0;
            @endphp
            @foreach ($receipt_details->lines as $line)
            <tr>
                <td class="text-center">
                    {{ $loop->iteration }}
                </td>
                <td>
                    @if (!empty($line['image']))
                    <img src="{{ $line['image'] }}" alt="Image" width="50" style="float: left; margin-right: 8px;">
                    @endif
                    {{ $line['name'] }} {{ $line['product_variation'] }}
                    {{ $line['variation'] }}
                    @if (!empty($line['sub_sku']))
                    , {{ $line['sub_sku'] }}
                    @endif @if (!empty($line['brand']))
                    , {{ $line['brand'] }}
                    @endif
                    @if (!empty($line['product_custom_fields']))
                    , {{ $line['product_custom_fields'] }}
                    @endif
                    @if (!empty($line['sell_line_note']))
                    <br>
                    <small>{{ $line['sell_line_note'] }}</small>
                    @endif
                    @if (!empty($line['lot_number']))
                    <br> {{ $line['lot_number_label'] }}:
                    {{ $line['lot_number'] }}
                    @endif
                    @if (!empty($line['product_expiry']))
                    , {{ $line['product_expiry_label'] }}:
                    {{ $line['product_expiry'] }}
                    @endif

                    @if (!empty($line['warranty_name']))
                    <br><small>{{ $line['warranty_name'] }} </small>
                    @endif @if (!empty($line['warranty_exp_date']))
                    <small>- {{ @format_date($line['warranty_exp_date']) }}
                    </small>
                    @endif
                    @if (!empty($line['warranty_description']))
                    <small> {{ $line['warranty_description'] ?? '' }}</small>
                    @endif
                </td>
                @php
                $uf_tax = str_replace(',', '', $line['tax'] ?? 0);
                $uf_line_discount = str_replace(',', '', $line['line_discount'] ?? 0);
                $tax = floatval($uf_tax);
                $quantity = $line['quantity_uf'] ?? 1;
                $unit_price = $line['unit_price_before_discount_uf'] ?? 0;
                $line_discount = $uf_line_discount * $quantity ;
                $line_tax = $tax * $quantity;
                $line_total = $unit_price * $quantity;
                $total_tax += $line_tax;
                $subtotal += $line_total;
                @endphp
                @if ($receipt_details->show_cat_code == 1)
                <td>
                    @if (!empty($line['cat_code']))
                    {{ $line['cat_code'] }}
                    @endif
                </td>
                @endif

                <td class="text-right">
                    {{ $line['quantity'] }} {{ $line['units'] }}
                </td>
                <td class="text-right">
                    {{ $line['unit_price_before_discount'] }}
                </td>
                @if (!empty($receipt_details->item_discount_label))
                <td class="text-right">
                    {{ @num_format($line_discount) ?? '0.00' }}
                </td>
                @endif
                <td class="text-right">
                    {{ ($line_tax ?? 0) == 0
                        ? '0%'
                        : $line_tax . ' @ ' . ($line['tax_percent'] ?? 0) . '%' 
                    }} {{--{{$line['tax_name']}} --}}
                </td>
                <td class="text-right">
                    @php
                    // $line_total = $line['unit_price_uf'] * $line['quantity_uf'];
                    $line_total = $line['line_total'];
                    //$subtotal += $line_total;
                    @endphp
                    {{ $line_total }}
                </td>
            </tr>

            @if (!empty($line['modifiers']))
            @foreach ($line['modifiers'] as $modifier)
            <tr>
                <td class="text-center">
                    &nbsp;
                </td>
                <td>
                    {{ $modifier['name'] }} {{ $modifier['variation'] }}
                    @if (!empty($modifier['sub_sku']))
                    , {{ $modifier['sub_sku'] }}
                    @endif
                    @if (!empty($modifier['sell_line_note']))
                    ({{ $modifier['sell_line_note'] }})
                    @endif
                </td>

                @if ($receipt_details->show_cat_code == 1)
                <td>
                    @if (!empty($modifier['cat_code']))
                    {{ $modifier['cat_code'] }}
                    @endif
                </td>
                @endif

                <td class="text-right">
                    {{ $modifier['quantity'] }} {{ $modifier['units'] }}
                </td>
                <td class="text-right">
                    {{ $modifier['unit_price_exc_tax'] }}
                </td>

                @if (!empty($receipt_details->item_discount_label))
                <td class="text-right">0.00</td>
                @endif

                <td class="text-right">
                    {{ $modifier['line_total'] }}
                </td>
            </tr>
            @endforeach
            @endif
            @endforeach

            @php
            $lines = count($receipt_details->lines);
            @endphp

            @for ($i = $lines; $i < 2; $i++) <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                @if (!empty($receipt_details->item_discount_label))
                <td></td>
                @endif
                <td>&nbsp;</td>
                </tr>
                @endfor

        </tbody>
    </table>
    <div class="invoice-info color-555" style="margin-top: 20px">
        <div class="nvoice-col mb-20">
            <table class="table table-bordered table-slim" autosize="1" style="width:100%;">
                <tbody>
                    <!--Total Quantity -->
                    @if (!empty($receipt_details->total_quantity_label))
                    <tr class="color-555">
                        <td style="width:35%">
                            {!! $receipt_details->total_quantity_label !!}
                        </td>
                        <td class="text-center">
                            {{ $receipt_details->total_quantity }}
                        </td>
                        <td dir="ltr" style="width:35%">
                            {!! $receipt_details->total_quantity_label_en ? $receipt_details->total_quantity_label_en :
                            '' !!}
                        </td>
                    </tr>
                    @endif
                    <!--Subtotal Exc Tax and Discount -->
                    <tr class="color-555">
                        <td style="width:35%">
                            {!! $receipt_details->subtotal_label !!}
                        </td>
                        <td class="text-center">
                            @format_currency($subtotal)
                        </td>
                        <td dir="ltr" style="width:35%">
                            {!! $receipt_details->subtotal_label_en ? $receipt_details->subtotal_label_en : '' !!}
                        </td>
                    </tr>

                    <!-- Shipping Charges -->
                    @if (!empty($receipt_details->shipping_charges))
                    <tr class="color-555">
                        <td style="width:35%">
                            {!! $receipt_details->shipping_charges_label !!}
                        </td>
                        <td class="text-center">
                            {{ $receipt_details->shipping_charges }}
                        </td>
                        <td dir="ltr" style="width:35%">
                            {!! $receipt_details->shipping_charges_label_en ?
                            $receipt_details->shipping_charges_label_en : '' !!}
                        </td>
                    </tr>
                    @endif
                    <!--Packing Charge -->
                    @if (!empty($receipt_details->packing_charge))
                    <tr class="color-555">
                        <td style="width:35%">
                            {!! $receipt_details->packing_charge_label !!}
                        </td>
                        <td class="text-center">
                            {{ $receipt_details->packing_charge }}
                        </td>
                        <td dir="ltr" style="width:35%">
                            {!! $receipt_details->packing_charge_label_en ? $receipt_details->packing_charge_label_en :
                            '' !!}
                        </td>
                    </tr>
                    @endif
                    <!-- Discount -->
                    @if (!empty($receipt_details->discount))
                    <tr class="color-555">
                        <td>
                            {!! $receipt_details->discount_label !!}
                        </td>

                        <td class="text-center">
                            (-) {{ $receipt_details->discount }}
                        </td>
                        <td dir="ltr">
                            {!! $receipt_details->discount_label_en ? $receipt_details->discount_label_en : '' !!}
                        </td>
                    </tr>
                    @endif
                    <!--Total Line Discount-->
                    @if (!empty($receipt_details->total_line_discount))
                    <tr class="color-555">
                        <td>
                            {!! $receipt_details->line_discount_label !!}
                        </td>

                        <td class="text-center">
                            (-) {{ $receipt_details->total_line_discount }}
                        </td>
                        <td dir="ltr">
                            {!! $receipt_details->discount_label_en ? $receipt_details->discount_label_en : '' !!}
                        </td>
                    </tr>
                    @endif
                    <!--Rewards Points -->
                    @if (!empty($receipt_details->reward_point_label))
                    <tr class="color-555">
                        <td>
                            {!! $receipt_details->reward_point_label !!}
                        </td>

                        <td class="text-center">
                            (-) {{ $receipt_details->reward_point_amount }}
                        </td>
                        <td dir="ltr">
                            {!! $receipt_details->reward_point_label_en ? $receipt_details->reward_point_label_en : ''
                            !!}
                        </td>
                    </tr>
                    @endif
                    <!-- Tax -->
                    {{-- @if (!empty($receipt_details->total_item_tax_qty) && $receipt_details->total_item_tax_qty_uf >
                    0)
                    <tr class="color-555">
                        <td style="width:50%">
                            {!! $receipt_details->tax_summary_label !!}
                        </td>
                        <td class="text-right">
                            {{ $receipt_details->total_item_tax_qty }}
                        </td>
                        <td dir="ltr"> {!! $receipt_details->tax_label_en ? $receipt_details->tax_label_en : '' !!}</td>
                    </tr>
                    @elseif (!empty($receipt_details->taxes))
                    @foreach ($receipt_details->taxes as $k => $v)
                    <tr class="color-555">
                        <td>{{ $k }}</td>
                        <td class="text-right">(+) {{ $v }}</td>
                        <td dir="ltr">{{ $k }}</td>
                    </tr>
                    @endforeach

                    @endif
                    <!-- Tax -->
                    @if (!empty($receipt_details->group_tax_details))
                    @foreach ($receipt_details->group_tax_details as $key => $value)
                    <tr class="color-555">
                        <td>
                            {!! $key !!}
                        </td>
                        <td class="text-right">
                            (+)
                            {{ $value }}
                        </td>
                        <td dir="ltr">
                            {!! $key !!}
                        </td>
                    </tr>
                    @endforeach
                    @else
                    @if (!empty($receipt_details->tax))
                    <tr class="color-555">
                        <td>
                            {!! $receipt_details->tax_label !!}
                        </td>
                        <td class="text-right">
                            (+) {{ $receipt_details->tax }}
                        </td>
                        <td dir="ltr">
                            {!! $receipt_details->tax_label_en ? $receipt_details->tax_label_en : '' !!}
                        </td>
                    </tr>
                    @endif
                    @endif --}}

                    <!--Tax Total Inline -->
                    <tr class="color-555">
                        <td>
                            {!! $receipt_details->tax_label !!}
                        </td>
                        <td class="text-center">
                            (+) {{$total_tax}}
                        </td>
                        <td dir="ltr">
                            {!! $receipt_details->tax_label_en ? $receipt_details->tax_label_en : '' !!}
                        </td>
                    </tr>
                    <!--Round Off -->
                    @if ($receipt_details->round_off_amount > 0)
                    <tr class="color-555">
                        <td>
                            {!! $receipt_details->round_off_label !!}
                        </td>
                        <td class="text-center">
                            {{ $receipt_details->round_off }}
                        </td>
                        <td dir="ltr">
                            {!! $receipt_details->round_off_label_en ? $receipt_details->round_off_label_en : '' !!}
                        </td>
                    </tr>
                    @endif
                    <!-- Total -->
                    <tr class="color-555">
                        <td class="font-16 ">
                            {!! $receipt_details->total_label !!}
                        </td>
                        <td class="text-center font-16 ">
                            {{ $receipt_details->total }}
                        </td>
                        <td class="font-16" dir="ltr">
                            {!! $receipt_details->total_label_en ? $receipt_details->total_label_en : '' !!}
                        </td>
                    </tr>
                    <!--Total Paid -->
                    <tr class="color-555">
                        <td>
                            {!! $receipt_details->total_paid_label !!}
                        </td>
                        <td class="text-center">
                            {{ $receipt_details->total_paid }}
                        </td>
                        <td dir="ltr">
                            {!! $receipt_details->total_paid_label_en !!}
                        </td>
                    </tr>

                    <!-- Payment Details-->

                    @if (!empty($receipt_details->payments))
                    @foreach ($receipt_details->payments as $payment)
                    <tr class="color-555">
                        <td>{{ $payment['method'] }}</td>
                        <td class="text-center">{{ $payment['amount'] }}</td>
                        <td class="ltr">{{ $payment['date'] }}</td>
                    </tr>
                    @endforeach
                    @endif

                    <!-- Total Due-->
                    <tr class="color-555">
                        <td>
                            {!! $receipt_details->total_due_label !!}
                        </td>
                        <td class="text-center">
                            {{ $receipt_details->total_due }}
                        </td>
                        <td dir="ltr">
                            {!! $receipt_details->total_due_label_en !!}
                        </td>
                    </tr>
                    <!-- All Due -->
                    @if (!empty($receipt_details->all_due))
                    <tr class="color-555">
                        <td>
                            {!! $receipt_details->all_due !!}
                        </td>
                        <td class="text-center">
                            {{ $receipt_details->total_due }}
                        </td>
                        <td dir="ltr">
                            {!! $receipt_details->all_due_en !!}
                        </td>
                    </tr>
                    @endif
                   
                </tbody>
            </table>
           
            @if (!empty($receipt_details->total_in_words))
            <table class="border">
            <tr>
                <td style="width:50%;">
                    {!! $transactionUtil->numToWord($receipt_details->total_unformatted, 'ar') !!}
                </td>
                
                <td style="width:50%;" dir="ltr">
                    <small>({{ $receipt_details->total_in_words }})</small>
                </td>
            </tr>
            </table>
            @endif
        </div>

        {{-- <b class="pull-left">{{ __('lang_v1.authorized_signatory') }}</b> --}}
    </div>

    <div class=" color-555">
        <div class="col-xs-12">

            <p>{!! nl2br($receipt_details->additional_notes) !!}</p>
        </div>
    </div>
    <div class="color-555">
        @if (!empty($receipt_details->footer_text))
        <div class="text-center">
            {!! $receipt_details->footer_text !!}
        </div>
        @endif
    </div>
    </td>
    </tr>
    </tbody>
    </table>
</div>
<style>
    .elegant-table {
        font-family: Alamari, sans-serif;
        font-size: 10pt;
        margin: 0px !important;
        padding: 0px !important
    }

    .invoice-box {
        width: 100%;
        margin: auto;
        border-collapse: collapse;
    }

    .rtl {
        direction: rtl;
        text-align: right;
    }

    .ltr {
        direction: ltr;
        text-align: left;
    }

    .center {
        text-align: center;
    }

    table {
        width: 100%;
        margin-bottom: 10px;
    }

    td,
    th {

        vertical-align: top;
    }

    .header td {
        font-weight: bold;
    }

    .gray-bg {
        background-color: #f2f2f2;
    }

    .border {
        border: 1px solid #ccc;
    }

    .border th {
        border: 1px solid #ccc;
    }

    /* Custom CSS for MPDF */
    .table {
        width: 100%;
        margin-bottom: 10px;
        border-collapse: collapse;
    }

    .table-bordered {
        border: 1px solid #ccc;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #ccc;
    }
</style>