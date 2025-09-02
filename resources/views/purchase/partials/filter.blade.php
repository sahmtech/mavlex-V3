<div class="modal-dialog" role="document">
	
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">@lang('report.filters')</h4>
		</div>
		<div class="modal-body">
			@if($is_purchase == 'purchase')
			<div class="row">
				<div class="col-md-6">
		            <div class="form-group">
		                {!! Form::label('purchase_list_filter_location_id',  __('purchase.business_location') . ':') !!}
		                {!! Form::select('purchase_list_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
		            </div>
		        </div>
		        <div class="col-md-6">
		            <div class="form-group">
		                {!! Form::label('purchase_list_filter_supplier_id',  __('purchase.supplier') . ':') !!}
		                {!! Form::select('purchase_list_filter_supplier_id', $suppliers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
		            </div>
		        </div>
		        <div class="col-md-6">
		            <div class="form-group">
		                {!! Form::label('purchase_list_filter_status',  __('purchase.purchase_status') . ':') !!}
		                {!! Form::select('purchase_list_filter_status', $orderStatuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
		            </div>
		        </div>
		        <div class="col-md-6">
		            <div class="form-group">
		                {!! Form::label('purchase_list_filter_payment_status',  __('purchase.payment_status') . ':') !!}
		                {!! Form::select('purchase_list_filter_payment_status', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial'), 'overdue' => __('lang_v1.overdue')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
		            </div>
		        </div>
		        <div class="col-md-6">
		            <div class="form-group">
		                {!! Form::label('purchase_list_filter_date_range', __('report.date_range') . ':') !!}
		                {!! Form::text('purchase_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
		            </div>
		        </div>
				
			</div>
			@endif

			@if($is_purchase == 'order')
				<div class="row">	
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('po_list_filter_location_id',  __('purchase.business_location') . ':') !!}
	                        {!! Form::select('po_list_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('po_list_filter_supplier_id',  __('purchase.supplier') . ':') !!}
	                        {!! Form::select('po_list_filter_supplier_id', $suppliers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
	                    </div>
	                </div>
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('po_list_filter_status',  __('sale.status') . ':') !!}
	                        {!! Form::select('po_list_filter_status', $purchaseOrderStatuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
	                    </div>
	                </div>
	                @if(!empty($shipping_statuses))
	                    <div class="col-md-6">
	                        <div class="form-group">
	                            {!! Form::label('shipping_status', __('lang_v1.shipping_status') . ':') !!}
	                            {!! Form::select('shipping_status', $shipping_statuses, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
	                        </div>
	                    </div>
	                @endif
	                <div class="col-md-6">
	                    <div class="form-group">
	                        {!! Form::label('po_list_filter_date_range', __('report.date_range') . ':') !!}
	                        {!! Form::text('po_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
	                    </div>
	                </div>
				</div>
			@endif

			@if($is_purchase == 'return')
			<div class="row">
				<div class="col-md-6">
		            <div class="form-group">
		                {!! Form::label('purchase_list_filter_location_id',  __('purchase.business_location') . ':') !!}
		                {!! Form::select('purchase_list_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
		            </div>
		        </div>
		        
		        <div class="col-md-6">
		            <div class="form-group">
		                {!! Form::label('purchase_list_filter_date_range', __('report.date_range') . ':') !!}
		                {!! Form::text('purchase_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
		            </div>
		        </div>
				
			</div>
			@endif
			
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary" data-dismiss="modal">@lang('messages.apply')</button>
		    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.cancel')</button>
		</div>
		
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->