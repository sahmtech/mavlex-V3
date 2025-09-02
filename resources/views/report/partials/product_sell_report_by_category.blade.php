<table class="max-table" 
        id="product_sell_report_by_category" style="width: 100%;">
    <thead>
        <tr>
            <th>@lang('category.category')</th>
            <th>@lang('report.current_stock')</th>
            <th>@lang('report.total_unit_sold')</th>
            <th>@lang('sale.total')</th>
        </tr>
    </thead>
    <tfoot>
        <tr class="bg-gray footer-total text-center">
            <td><strong>@lang('sale.total'):</strong></td>
            <td class="footer_psr_by_cat_total_stock"></td>
            <td class="footer_psr_by_cat_total_sold"></td>
            <td class="footer_psr_by_cat_total_sell"></td>
        </tr>
    </tfoot>
</table>