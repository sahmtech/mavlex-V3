@if(empty($only) || in_array('zatca_tax_report_filter_date_range', $only))
<div class="col-md-3">
	<div class="form-group">
		{!! Form::label('zatca_tax_report_filter_date_range', __('report.date_range') . ':') !!}
		{!! Form::text('zatca_tax_report_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
	</div>
</div>
@endif
@if(empty($only) || in_array('zatca_tax_report_filter_location_id', $only))
<div class="col-md-3">
	<div class="form-group">
		{!! Form::label('zatca_tax_report_filter_location_id', __('purchase.business_location') . ':') !!}

		{!! Form::select('zatca_tax_report_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all') ]); !!}
	</div>
</div>
@endif
<div class="col-md-3">
	<div class="form-group">
		{!! Form::label('zatca_tax_report_filter_transaction_type', __('lang_v1.type') . ':') !!}
		{!! Form::select('zatca_tax_report_filter_transaction_type', ['sell' => __('lang_v1.sell'), 'sell_return' => __('lang_v1.sell_return')], 'sell', [
		'class' => 'form-control select2',
		'id' => 'zatca_tax_report_filter_transaction_type',
		'style' => 'width:100%',
		'placeholder' => false
		]) !!}
	</div>
</div>