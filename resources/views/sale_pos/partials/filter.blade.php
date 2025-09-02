<div class="modal-dialog" role="document">
	
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">@lang('report.filters')</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				@if(empty($only) || in_array('sell_list_filter_location_id', $only))
				<div class="col-md-6">
				    <div class="form-group">
				        {!! Form::label('sell_list_filter_location_id',  __('purchase.business_location') . ':') !!}

				        {!! Form::select('sell_list_filter_location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all') ]); !!}
				    </div>
				</div>
				@endif
				@if(empty($only) || in_array('sell_list_filter_customer_id', $only))
				<div class="col-md-6">
				    <div class="form-group">
				        {!! Form::label('sell_list_filter_customer_id',  __('contact.customer') . ':') !!}
				        {!! Form::select('sell_list_filter_customer_id', $customers, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
				    </div>
				</div>
				@endif
				
				@if(empty($only) || in_array('sell_list_filter_date_range', $only))
				<div class="col-md-6">
				    <div class="form-group">
				        {!! Form::label('sell_list_filter_date_range', __('report.date_range') . ':') !!}
				        {!! Form::text('sell_list_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
				    </div>
				</div>
				@endif
				@if((empty($only) || in_array('created_by', $only)) && !empty($sales_representative))
				<div class="col-md-6">
				    <div class="form-group">
				        {!! Form::label('created_by',  __('report.user') . ':') !!}
				        {!! Form::select('created_by', $sales_representative, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
				    </div>
				</div>
				@endif
				
			</div>
			
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary" data-dismiss="modal">@lang('messages.apply')</button>
		    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.cancel')</button>
		</div>
		
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->