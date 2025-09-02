<table class="report-table" id="stock_report_table" style="width: 100%;">
    <thead>
        <tr>
            <th>@lang('product.sku')</th>
            <th>@lang('business.product')</th>
            <th>@lang('sale.location')</th>
            <th>@lang('lang_v1.price')</th>
            <th>@lang('report.stock_report')</th>
            @can('view_product_stock_value')
            <th class="stock_price">@lang('lang_v1.total_stock_price') <br><small>(@lang('lang_v1.by_purchase_price'))</small></th>
            <th>@lang('lang_v1.total_stock_price') <br><small>(@lang('lang_v1.by_sale_price'))</small></th>
            
            @endcan
            
            <th>@lang('lang_v1.transfered_stock')</th>
        </tr>
    </thead>
    <tfoot>
        <tr class="text-center footer-total">
            <td colspan="4"><strong>@lang('sale.total'):</strong></td>
            <td class="footer_total_stock"></td>
            @can('view_product_stock_value')
            <td class="footer_total_stock_price"></td>
            <td class="footer_stock_value_by_sale_price"></td>
             @endcan
            <td class="footer_total_transfered"></td>
            
        </tr>
    </tfoot>
</table>