@php
$is_mobile = isMobile();
@endphp
<div class="row pos_form_totals">
	<div class="col-md-12">
		<table class="table table-condensed">
			<tr>
				<td><b>@lang('sale.item'):</b>&nbsp;
					<span class="total_quantity">0</span>
				</td>
				<td>
					<b>@lang('sale.total'):</b> &nbsp;
					<span class="price_total">0</span>
				</td>
				<td style="text-align: right">

				</td>
				@if($is_mobile)
				@if (!empty($pos_settings['amount_rounding_method']) && $pos_settings['amount_rounding_method'] > 0)
				<td>
					<b><span id="round_off">@lang('lang_v1.round_off'):</span></b> &nbsp;
					<span id="round_off_text">0</span>
					<input type="hidden" name="round_off_amount" id="round_off_amount" value=0>
				</td>
				@endif
				@endif
			</tr>
		</table>
	</div>
</div>