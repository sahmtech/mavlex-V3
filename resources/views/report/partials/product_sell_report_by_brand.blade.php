<table class="max-table" 
        id="product_sell_report_by_brand" style="width: 100%;">
    <thead>
        <tr>
            <th>@lang('product.brand')</th>
            <th>@lang('report.current_stock')</th>
            <th>@lang('report.total_unit_sold')</th>
            <th>@lang('sale.total')</th>
        </tr>
    </thead>
    <tfoot>
        <tr class="bg-gray font-17 footer-total text-center">
            <td><strong>@lang('sale.total'):</strong></td>
            <td class="footer_psr_by_brand_total_stock"></td>
            <td class="footer_psr_by_brand_total_sold"></td>
            <td class="footer_psr_by_brand_total_sell"></td>
        </tr>
    </tfoot>
</table>