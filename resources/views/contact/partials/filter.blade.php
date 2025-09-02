<div class="modal-dialog" role="document">
	
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">@lang('report.filters')</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				@if($type == 'customer')
				<div class="col-sm-6">
					<div class="form-group">
						<p><strong>@lang('lang_v1.sell_due')</strong></p>
						<div class="toggle-wrapper d-flex gap-2 mt-4">
							<label class="switch" for="has_sell_due">
								{!! Form::checkbox('has_sell_due', 1, false, ['id' => 'has_sell_due']) !!}
								<div class="sliderCheckbox round"></div>
							</label>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<p><strong>@lang('lang_v1.sell_return')</strong></p>
						<div class="toggle-wrapper d-flex gap-2 mt-4">
							<label class="switch" for="has_sell_return">
								{!! Form::checkbox('has_sell_return', 1, false, ['id' => 'has_sell_return']) !!}
								<div class="sliderCheckbox round"></div>
							</label>
						</div>
					</div>
				</div>
			@elseif($type == 'supplier')
				<div class="col-sm-6">
					<div class="form-group">
						<p><strong>@lang('report.purchase_due')</strong></p>
						<div class="toggle-wrapper d-flex gap-2 mt-4">
							<label class="switch" for="has_purchase_due">
								{!! Form::checkbox('has_purchase_due', 1, false, ['id' => 'has_purchase_due']) !!}
								<div class="sliderCheckbox round"></div>
							</label>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-group">
						<p><strong>@lang('lang_v1.purchase_return')</strong></p>
						<div class="toggle-wrapper d-flex gap-2 mt-4">
							<label class="switch" for="has_purchase_return">
								{!! Form::checkbox('has_purchase_return', 1, false, ['id' => 'has_purchase_return']) !!}
								<div class="sliderCheckbox round"></div>
							</label>
						</div>
					</div>
				</div>
			@endif
			
			<div class="col-sm-6">
				<div class="form-group">
					<p><strong>@lang('lang_v1.advance_balance')</strong></p>
					<div class="toggle-wrapper d-flex gap-2 mt-4">
						<label class="switch" for="has_advance_balance">
							{!! Form::checkbox('has_advance_balance', 1, false, ['id' => 'has_advance_balance']) !!}
							<div class="sliderCheckbox round"></div>
						</label>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<p><strong>@lang('lang_v1.opening_balance')</strong></p>
					<div class="toggle-wrapper d-flex gap-2 mt-4">
						<label class="switch" for="has_opening_balance">
							{!! Form::checkbox('has_opening_balance', 1, false, ['id' => 'has_opening_balance']) !!}
							<div class="sliderCheckbox round"></div>
						</label>
					</div>
				</div>
			</div>
			
			    @if($type == 'customer')
			        <div class="col-md-6">
			            <div class="form-group">
			                <label for="has_no_sell_from">@lang('lang_v1.has_no_sell_from'):</label>
			                {!! Form::select('has_no_sell_from', ['one_month' => __('lang_v1.one_month'), 'three_months' => __('lang_v1.three_months'), 'six_months' => __('lang_v1.six_months'), 'one_year' => __('lang_v1.one_year')], null, ['class' => 'form-control', 'id' => 'has_no_sell_from', 'placeholder' => __('messages.please_select')]); !!}
			            </div>
			        </div>

			        <div class="col-md-6">
			            <div class="form-group">
			                <label for="cg_filter">@lang('lang_v1.customer_group'):</label>
			                {!! Form::select('cg_filter', $customer_groups, null, ['class' => 'form-control', 'id' => 'cg_filter']); !!}
			            </div>
			        </div>
			    @endif

			    <div class="col-md-6">
			        <div class="form-group">
			            <label for="status_filter">@lang('sale.status'):</label>
			            {!! Form::select('status_filter', ['active' => __('business.is_active'), 'inactive' => __('lang_v1.inactive')], null, ['class' => 'form-control', 'id' => 'status_filter', 'placeholder' => __('lang_v1.none')]); !!}
			        </div>
			    </div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary" data-dismiss="modal">@lang('messages.apply')</button>
		    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.cancel')</button>
		</div>
		
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->