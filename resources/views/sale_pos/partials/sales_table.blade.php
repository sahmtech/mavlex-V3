@php
    $custom_labels = json_decode(session('business.custom_labels'), true);
@endphp
<div class="table-responsive">
    <table class="table table-bordered table-striped ajax_view max-table" id="sell_table"  style="width: 100%">
        <thead>
            <tr>
                <th>@lang('messages.action')</th>
                <th>@lang('sale.invoice_no')</th>
                <th>@lang('messages.date')</th>
                <th>@lang('sale.customer_name')</th>
                <th>@lang('sale.payment_status')</th>
                <th>@lang('sale.total_amount')</th>
                <th>@lang('sale.total_paid')</th>
                <th>@lang('lang_v1.sell_due')</th>
                <th>@lang('lang_v1.total_items')</th>
            </tr>
        </thead>
        <tfoot>
            <tr class="bg-gray font-17 footer-total text-center">
                <td colspan="3"><strong>@lang('sale.total'):</strong></td>
                <!-- <td class="payment_method_count"></td> -->
                <td></td>
                <td class="footer_payment_status_count"></td>
                <td class="footer_sale_total"></td>
                <td class="footer_total_paid"></td>
                <td class="footer_total_remaining"></td>
                <td colspan="1"></td>
            </tr>
        </tfoot>
    </table>
</div>
