<div class="modal-dialog" role="document">
	{!! Form::open(['url' => url('sells/pro-pay/update-payment/' . $transaction->id), 'method' => 'put', 'id' => 'edit_payment_form' ]) !!}
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">@lang('lang_v1.edit_payment') - {{$transaction->invoice_no}}</h4>
		</div>
		<div class="modal-body">
			<div class="row">

			    <div class="col-md-6">
			        <div class="form-group">
			            {!! Form::label('payment_method', 'Payment Method:' ) !!}
				        {!! Form::select('payment_method',$payment_types, $transaction->payment_lines[0]->method, ['class' => 'form-control','placeholder' => __('messages.please_select'), 'required']); !!}
			        </div>
			    </div>

			    <div class="col-md-6">
			        <div class="form-group">
			            {!! Form::label('payment_status', 'Payment Status:' ) !!}
				        {!! Form::select('payment_status', ['paid' => 'Paid'], $transaction->payment_status, ['class' => 'form-control','placeholder' => __('messages.please_select'), 'required']); !!}
			        </div>
			    </div>

			    <div class="col-md-6">
					<div class="form-group">
						{!! Form::label('sale_note', __('sale.sell_note') . ':') !!}
						{!! Form::textarea('sale_note', !empty($transaction)? $transaction->additional_notes:null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('sale.sell_note')]); !!}
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						{!! Form::label('staff_note', __('sale.staff_note') . ':') !!}
						{!! Form::textarea('staff_note', 
						!empty($transaction)? $transaction->staff_note:null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('sale.staff_note')]); !!}
					</div>
				</div>

			    
			</div>
			
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary">@lang('messages.update')</button>
		    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.cancel')</button>
		</div>
		{!! Form::close() !!}
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->