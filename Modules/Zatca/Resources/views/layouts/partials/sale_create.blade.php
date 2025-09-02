<div class="col-md-4 col-sm-6">
	<div class="form-group">
		@php
		$document_types = [
		'1000' => __('zatca::lang.invoice_tax'), // Tax Invoice
		'0100' => __('zatca::lang.simplified_invoice'), // Simplified Invoice
		];
		@endphp

		{!! Form::label('document_type', __('zatca::lang.invoicing_type') . ':') !!}
		{!! Form::select('document_type', $document_types, null, ['class' => 'form-control', 'placeholder' => __('zatca::lang.invoicing_type')]); !!}

	</div>
</div>