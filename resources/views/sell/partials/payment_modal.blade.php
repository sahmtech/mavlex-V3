<div class="modal fade" tabindex="-1" role="dialog" id="modal_payment">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">@lang('lang_v1.payment')</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 mb-12">
						<strong>@lang('lang_v1.advance_balance'):</strong> <span id="advance_balance_text"></span>
						{!! Form::hidden('advance_balance', null, ['id' => 'advance_balance', 'data-error-msg' => __('lang_v1.required_advance_balance_not_available')]); !!}
					</div>
					<div class="col-md-12">
						<div class="payment_row" id="payment_rows_div">
                            @include('sale_pos.partials.payment_row_form', ['row_index' => 0, 'show_date' => true])
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="pull-right"><strong>@lang('lang_v1.balance'):</strong> <span class="balance_due">0.00</span></div>
                                </div>
                            </div>
                        </div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
				<button type="submit" class="btn btn-primary" id="submit-sell">@lang('sale.finalize_payment')</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
