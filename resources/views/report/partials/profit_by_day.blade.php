<table class="report-table" id="profit_by_day_table">
    <thead>
        <tr>
            <th>@lang('lang_v1.days')</th>
            <th>@lang('lang_v1.gross_profit')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($days as $day)
            <tr>
                <td>@lang('lang_v1.' . $day)</td>
                <td><span class="display_currency gross-profit" data-currency_symbol="true" data-orig-value="{{$profits[$day] ?? 0}}">{{$profits[$day] ?? 0}}</span></td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr class="footer-total">
            <td><strong>@lang('sale.total'):</strong></td>
            <td><span class="day_footer_total"></span></td>
        </tr>
    </tfoot>
</table>