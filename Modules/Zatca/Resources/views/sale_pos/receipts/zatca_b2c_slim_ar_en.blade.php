@inject('transactionUtil', 'app\Utils\TransactionUtil')
<div class="receipt">
    <div class="ticket">
    <style>
        
        .slim-80mm-receipt {
            width: 100%;
            font-family: Alamari, sans-serif;
            font-size: 8pt;
            margin: 0 auto;
        }
        table { width: 100%; border-collapse: collapse; margin-bottom: 4px; }
        .border, .border th, .border td { border: 1px solid #ccc; }
        .gray-bg { background-color: #f2f2f2; }
        .center { text-align: center; }
        .rtl { direction: rtl; text-align: right; }
        .ltr { direction: ltr; text-align: left; }
        .sep { border-top: 1px dashed #000; margin: 4px 0; }
        th, td { padding: 2px 4px; vertical-align: top; }
        img { max-width: 100%; }
    </style>

    {{-- Letter head --}}
    @if(!empty($receipt_details->letter_head))
        <div class="rtl center">
            <img src="{{ $receipt_details->letter_head }}">
        </div>
    @endif

    {{-- Store Info --}}
    <div class="center" style="margin-bottom:4px;">
        <strong style="font-size:10pt;">{!! $receipt_details->display_name !!}</strong><br>
        <small>{!! nl2br($receipt_details->address) !!}</small><br>
        
        @foreach([2,3,4] as $i)
            @php
                $lbl = "location_custom_field_{$i}_label";
                $val = "location_custom_field_{$i}_value";
            @endphp
            @if(!empty($receipt_details->$lbl) && !empty($receipt_details->$val))
                {!! $receipt_details->$lbl !!}: {!! $receipt_details->$val !!}<br>
            @endif
        @endforeach
    </div>

    {{-- Logo --}}
    @if(empty($receipt_details->letter_head))
    @if(!empty($receipt_details->logo))
        <div class="center" style="margin-bottom:4px;">
            <img src="{{ $receipt_details->logo }}" style="max-height:60px;">
        </div>
    @endif
    @endif

    <div class="sep"></div>

    {{-- Invoice Heading --}}
    {{-- <div class="center">
        <strong>{{ $receipt_details->invoice_heading }}</strong><br>
        <strong>{{ $receipt_details->invoice_heading_en }}</strong>
    </div> --}}
    <div class="center border">
        <strong>فاتورة ضريبية مبسطة</strong><br>
        <strong>Simplied Tax Invoice</strong>
    </div>

    {{-- Invoice Meta --}}
    <table class="border">
        <tr>
            <td>
                <strong>{{ $receipt_details->invoice_no_prefix }} / {{ $receipt_details->invoice_no_prefix_en }} <br>{{ $receipt_details->invoice_no }}</strong>
            </td>
            <td >
                <strong>{{ $receipt_details->date_label }} / {{ $receipt_details->date_label_en}}<br>{{ $receipt_details->invoice_date }}</strong>
            </td>
        </tr>
        @if(!empty($receipt_details->due_date))
        <tr>
            <td>
                <strong>{{ $receipt_details->due_date_label }}<br>{{ $receipt_details->due_date }}</strong>
            </td>
            <td class="ltr">
                <strong>@lang('lang_v1.payment_terms')<br>
                    @if(!empty($transaction->pay_term_number) && !empty($transaction->pay_term_type))
                        {{ ucfirst($transaction->pay_term_number) }} {{ ucfirst($transaction->pay_term_type) }}
                    @else N/A @endif
                </strong>
            </td>
        </tr>
        @endif
    </table>

    <div class="sep"></div>

    {{-- Seller / Buyer --}}
    <table class="border">
        <tr class="gray-bg">
            <th class="center">البائع / Seller</th>
            {{-- <th class="center">المشتري / Buyer</th> --}}
        </tr>
        <tr>
            <td>
                {{ $receipt_details->crn_name ?? '' }}<br>
                {{ $receipt_details->street_name ?? '' }}, {{ $receipt_details->building_number ?? '' }}, {{ $receipt_details->plot_identification ?? '' }}<br>
                {{ $receipt_details->city_sub_division ?? '' }}, {{ $receipt_details->city ?? '' }}, {{ $receipt_details->postal_number ?? '' }}<br>
                {{ $receipt_details->country ?? '' }}<br>
                @if (!empty ($receipt_details->contact))
                {!! $receipt_details->contact !!}
                <br>
                @endif
                {{ __('zatca::lang.vat') }}: {{ $receipt_details->vat_number ?? '' }}<br>
                {{ __('zatca::lang.crn') }}: {{ $receipt_details->crn_number ?? '' }}
            </td>
            {{-- <td>
                {!! ltrim($receipt_details->customer_info_address, '<br>') !!}<br>
                @if(!empty($receipt_details->customer_custom_fields))
                    {!! $receipt_details->customer_custom_fields !!}<br>
                @endif
                @if(!empty($receipt_details->customer_tax_label))
                    <strong>{{ $receipt_details->customer_tax_label }}</strong> {{ $receipt_details->customer_tax_number }}
                @endif
            </td> --}}
        </tr>
    </table>

    <div class="sep"></div>

    {{-- Repair / Device Details --}}
    @if(!empty($receipt_details->brand_label) || !empty($receipt_details->repair_brand) ||
        !empty($receipt_details->device_label) || !empty($receipt_details->repair_device) ||
        !empty($receipt_details->model_no_label) || !empty($receipt_details->repair_model_no) ||
        !empty($receipt_details->serial_no_label) || !empty($receipt_details->repair_serial_no) ||
        !empty($receipt_details->repair_status_label) || !empty($receipt_details->repair_status) ||
        !empty($receipt_details->repair_warranty_label) || !empty($receipt_details->repair_warranty))
        <div style="margin-bottom:4px;">
            @foreach([
                ['lbl'=>'brand_label','val'=>'repair_brand'],
                ['lbl'=>'device_label','val'=>'repair_device'],
                ['lbl'=>'model_no_label','val'=>'repair_model_no'],
                ['lbl'=>'serial_no_label','val'=>'repair_serial_no'],
                ['lbl'=>'repair_status_label','val'=>'repair_status'],
                ['lbl'=>'repair_warranty_label','val'=>'repair_warranty'],
            ] as $d)
                @if(!empty($receipt_details->{$d['lbl']}) || !empty($receipt_details->{$d['val']}))
                    <strong>{!! $receipt_details->{$d['lbl']} !!}</strong> {{ $receipt_details->{$d['val']} }}<br>
                @endif
            @endforeach
        </div>
    @endif

    {{-- Shipping Custom Fields --}}
    @foreach(range(1,5) as $i)
        @php
            $lbl = "shipping_custom_field_{$i}_label";
            $val = "shipping_custom_field_{$i}_value";
        @endphp
        @if(!empty($receipt_details->$lbl))
            <strong>{!! $receipt_details->$lbl !!}</strong> {!! $receipt_details->$val ?? '' !!}<br>
        @endif
    @endforeach

    {{-- Sale Orders --}}
    @if(!empty($receipt_details->sale_orders_invoice_no) || !empty($receipt_details->sale_orders_invoice_date))
        <strong>@lang('restaurant.order_no'):</strong> {!! $receipt_details->sale_orders_invoice_no ?? '' !!}<br>
        <strong>@lang('lang_v1.order_dates'):</strong> {!! $receipt_details->sale_orders_invoice_date ?? '' !!}<br>
    @endif

    <div class="sep"></div>

    {{-- Line Items --}}
    <table class="border">
        <thead>
            <tr class="gray-bg center">
                <th style="width:5%;">#</th>
                <th class="rtl"  style="width:{{ $p_width = (100 - 
                    ($receipt_details->show_cat_code?10:0) - 
                    (!empty($receipt_details->item_discount_label)?10:0)
                ) }}%;">{{ $receipt_details->table_product_label }}<br>{{ $receipt_details->table_product_label_en }}</th>
                @if($receipt_details->show_cat_code)
                    <th style="width:10%;">{{ $receipt_details->cat_code_label }}<br>{{ $receipt_details->cat_code_label_en }}</th>
                @endif
                <th class="rtl" style="width:15%;">{{ $receipt_details->table_qty_label }}<br>{{ $receipt_details->table_qty_label_en }}</th>
                <th class="rtl" style="width:15%;">{{ $receipt_details->table_unit_price_label }}<br>{{ $receipt_details->table_unit_price_label_en }}</th>
                @if(!empty($receipt_details->item_discount_label))
                    <th style="width:10%;">{{ $receipt_details->item_discount_label }}<br>{{ $receipt_details->item_discount_label_en }}</th>
                @endif
                <th class="rtl" style="width:10%;">{{ $receipt_details->line_tax_label }}<br>{{ $receipt_details->line_tax_label_en }}</th>
                <th class="rtl" style="width:15%;">{{ $receipt_details->table_subtotal_label }}<br>{{ $receipt_details->table_subtotal_label_en }}</th>
            </tr>
        </thead>
        <tbody>
            @php $subtotal = $total_tax = 0; @endphp
            @foreach($receipt_details->lines as $line)
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
                <tr>
                    <td class="center">{{ $loop->iteration }}</td>
                    <td>
                        @if(!empty($line['image']))
                            <img src="{{ $line['image'] }}" width="30" style="float:left;margin-right:4px;">
                        @endif
                        {{ $line['name'] }} {{ $line['variation'] ?? '' }}<br>
                        @if(!empty($line['sub_sku'])) SKU: {{ $line['sub_sku'] }}<br>@endif
                        @if(!empty($line['brand'])) Brand: {{ $line['brand'] }}<br>@endif
                        @if(!empty($line['sell_line_note'])) Note: {{ $line['sell_line_note'] }}<br>@endif
                    </td>
                    @if($receipt_details->show_cat_code)
                        <td class="center">{{ $line['cat_code'] ?? '' }}</td>
                    @endif
                    <td class="center">{{ $line['quantity'] }} {{ $line['units'] }}</td>
                    <td class="center">{{ $line['unit_price_before_discount'] }}</td>
                    @if(!empty($receipt_details->item_discount_label))
                        <td class="center">{{ @num_format($line_discount) ?? '0.00' }}</td>
                    @endif
                    <td class="center"> {{ ($line_tax ?? 0) == 0 ? '0%' : @num_format($line_tax) . ' @ ' . ($line['tax_percent'] ?? 0) . '%' }} {{--{{$line['tax_name']}} --}}</td>
                    <td class="center">{{ @num_format($line['line_total_uf']) }}</td>
                </tr>

                {{-- Modifiers --}}
                @if(!empty($line['modifiers']))
                    @foreach($line['modifiers'] as $mod)
                        <tr>
                            <td>&nbsp;</td>
                            <td>{{ $mod['name'] }} {{ $mod['variation'] ?? '' }}</td>
                            @if($receipt_details->show_cat_code)
                                <td class="center">{{ $mod['cat_code'] ?? '' }}</td>
                            @endif
                            <td class="center">{{ $mod['quantity'] }} {{ $mod['units'] }}</td>
                            <td class="center">{{ $mod['unit_price_exc_tax'] }}</td>
                            @if(!empty($receipt_details->item_discount_label))
                                <td class="center">0.00</td>
                            @endif
                            <td class="center">{{ $mod['line_total'] }}</td>
                        </tr>
                    @endforeach
                @endif
            @endforeach

            @for($i = count($receipt_details->lines); $i < 2; $i++)
                <tr>
                    @foreach(range(1, ($receipt_details->show_cat_code?7:6) + (!empty($receipt_details->item_discount_label)?1:0)) as $j)
                        <td>&nbsp;</td>
                    @endforeach
                </tr>
            @endfor
        </tbody>
    </table>

    <div class="sep"></div>

    {{-- Totals --}}
    <table class="border">
        @if(!empty($receipt_details->total_quantity_label))
            <tr>
                <td>{{ $receipt_details->total_quantity_label }}</td>
                <td class="center">{{ $receipt_details->total_quantity }}</td>
                <td class="ltr">{{ $receipt_details->total_quantity_label_en }}</td>
            </tr>
        @endif
        <tr>
            <td>{{ $receipt_details->subtotal_label }}</td>
            <td class="center">@format_currency($subtotal)</td>
            <td class="ltr">{{ $receipt_details->subtotal_label_en }}</td>
        </tr>
        @if(!empty($receipt_details->shipping_charges))
            <tr>
                <td>{{ $receipt_details->shipping_charges_label }} (+)</td>
                <td class="center">{{ $receipt_details->shipping_charges }}</td>
                <td class="ltr">{{ $receipt_details->shipping_charges_label_en }} (+)</td>
            </tr>
        @endif
        @if(!empty($receipt_details->packing_charge))
            <tr>
                <td>{{ $receipt_details->packing_charge_label }} (+)</td>
                <td class="center">{{ $receipt_details->packing_charge }}</td>
                <td class="ltr">{{ $receipt_details->packing_charge_label_en }} (+)</td>
            </tr>
        @endif
        @if(!empty($receipt_details->discount))
            <tr>
                <td>{{ $receipt_details->discount_label }} (-)</td>
                <td class="center">{{ $receipt_details->discount }}</td>
                <td class="ltr">{{ $receipt_details->discount_label_en }} (-)</td>
            </tr>
        @endif
        @if(!empty($receipt_details->total_line_discount))
            <tr>
                <td>{{ $receipt_details->line_discount_label }} (-)</td>
                <td class="center">{{ $receipt_details->total_line_discount }}</td>
                <td class="ltr">{{ $receipt_details->discount_label_en }} (-)</td>
            </tr>
        @endif
        @if(!empty($receipt_details->reward_point_label))
            <tr>
                <td>{{ $receipt_details->reward_point_label }}(-)</td>
                <td class="center">{{ $receipt_details->reward_point_amount }}</td>
                <td class="ltr">{{ $receipt_details->reward_point_label_en }}(-)</td>
            </tr>
        @endif
        <tr>
            <td>{!! $receipt_details->tax_label !!} (+)</td>
            <td class="center"> @format_currency($total_tax)</td>
            <td class="ltr">{!! $receipt_details->tax_label_en ? $receipt_details->tax_label_en : '' !!} (+)</td>
        </tr>
        {{--IF ORDER TAX IS APPLIED --}}
        @if (!empty($receipt_details->tax))
        <tr>
            <td>{!! $receipt_details->tax_label !!} (+)</td>
            <td class="center"> {{ $receipt_details->tax }}</td>
            <td class="ltr">{!! $receipt_details->tax_label_en ? $receipt_details->tax_label_en : '' !!} (+)</td>
        </tr>
        @endif
        @if($receipt_details->round_off_amount > 0)
            <tr>
                <td>{{ $receipt_details->round_off_label }}</td>
                <td class="center">{{ $receipt_details->round_off }}</td>
                <td class="ltr">{{ $receipt_details->round_off_label_en }}</td>
            </tr>
        @endif
        <tr>
            <td><strong>{{ $receipt_details->total_label }}</strong></td>
            <td class="center"><strong>{{ $receipt_details->total }}</strong></td>
            <td class="ltr">{{ $receipt_details->total_label_en }}</td>
        </tr>
        <tr>
            <td>{{ $receipt_details->total_paid_label }}</td>
            <td class="center">{{ $receipt_details->total_paid }}</td>
            <td class="ltr">{{ $receipt_details->total_paid_label_en }}</td>
        </tr>
        @if(!empty($receipt_details->payments))
            @foreach($receipt_details->payments as $payment)
                <tr>
                    <td>{{ $payment['method'] }}</td>
                    <td class="center">{{ $payment['amount'] }}</td>
                    <td class="ltr">{{ $payment['date'] }}</td>
                </tr>
            @endforeach
        @endif
        <tr>
            <td>{{ $receipt_details->total_due_label }}</td>
            <td class="center">{{ $receipt_details->total_due }}</td>
            <td class="ltr">{{ $receipt_details->total_due_label_en }}</td>
        </tr>
        @if(!empty($receipt_details->all_due))
            <tr>
                <td>{{ $receipt_details->all_due }}</td>
                <td class="center">{{ $receipt_details->total_due }}</td>
                <td class="ltr">{{ $receipt_details->all_due_en }}</td>
            </tr>
        @endif
       
    </table>
    @if(!empty($receipt_details->total_in_words))
    <table class="border">
    <tr>
        <td style="width:50%;">{!! $transactionUtil->numToWord($receipt_details->total_unformatted, 'ar') !!}</td>
        
        <td style="width:50%;" class="ltr">{!! $transactionUtil->numToWord($receipt_details->total_unformatted, 'en') !!}</td>
    </tr>
    </table>
    @endif
    {{-- Additional Notes & Footer --}}
    @if(!empty($receipt_details->additional_notes))
        <div style="margin-bottom:4px;">
            {!! nl2br($receipt_details->additional_notes) !!}
        </div>
    @endif
    @if(!empty($receipt_details->footer_text))
        <div class="center">
            {!! $receipt_details->footer_text !!}
        </div>
    @endif
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
</div>
</div>
