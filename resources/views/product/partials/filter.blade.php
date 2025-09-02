<div class="modal-dialog" role="document">
	
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">@lang('report.filters')</h4>
		</div>
		<div class="modal-body">
			@if($status == 'product')
				<div class="row">
			        <div class="col-md-6">
			            <div class="form-group">
			                {!! Form::label('type', __('product.product_type') . ':') !!}
			                {!! Form::select('type', ['single' => __('lang_v1.single'), 'variable' => __('lang_v1.variable'), 'combo' => __('lang_v1.combo')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'product_list_filter_type', 'placeholder' => __('lang_v1.all')]); !!}
			            </div>
			        </div>
			        <div class="col-md-6">
			            <div class="form-group">
			                {!! Form::label('category_id', __('product.category') . ':') !!}
			                {!! Form::select('category_id', $categories, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'product_list_filter_category_id', 'placeholder' => __('lang_v1.all')]); !!}
			            </div>
			        </div>

			        <div class="col-md-6">
			            <div class="form-group">
			                {!! Form::label('unit_id', __('product.unit') . ':') !!}
			                {!! Form::select('unit_id', $units, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'product_list_filter_unit_id', 'placeholder' => __('lang_v1.all')]); !!}
			            </div>
			        </div>
			        <div class="col-md-6">
			            <div class="form-group">
			                {!! Form::label('tax_id', __('product.tax') . ':') !!}
			                {!! Form::select('tax_id', $taxes, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'product_list_filter_tax_id', 'placeholder' => __('lang_v1.all')]); !!}
			            </div>
			        </div>
			        <div class="col-md-6">
			            <div class="form-group">
			                {!! Form::label('brand_id', __('product.brand') . ':') !!}
			                {!! Form::select('brand_id', $brands, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'product_list_filter_brand_id', 'placeholder' => __('lang_v1.all')]); !!}
			            </div>
			        </div>
			        <div class="col-md-6" id="location_filter">
			            <div class="form-group">
			                {!! Form::label('location_id',  __('purchase.business_location') . ':') !!}
			                {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
			            </div>
			        </div>
			        <div class="col-md-6">
			            <br>
			            <div class="form-group">
			                {!! Form::select('active_state', ['active' => __('business.is_active'), 'inactive' => __('lang_v1.inactive')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'active_state', 'placeholder' => __('lang_v1.all')]); !!}
			            </div>
			        </div>

			        <!-- include module filter -->
			        @if(!empty($pos_module_data))
			            @foreach($pos_module_data as $key => $value)
			                @if(!empty($value['view_path']))
			                    @includeIf($value['view_path'], ['view_data' => $value['view_data']])
			                @endif
			            @endforeach
			        @endif

			        <div class="col-md-6">
			          <div class="form-group">
			            <br>
			            <label>
			              {!! Form::checkbox('not_for_selling', 1, false, ['class' => 'input-icheck', 'id' => 'not_for_selling']); !!} <strong>@lang('lang_v1.not_for_selling')</strong>
			            </label>
			          </div>
			        </div>
			        @if($is_woocommerce)
			            <div class="col-md-6">
			                <div class="form-group">
			                    <br>
			                    <label>
			                      {!! Form::checkbox('woocommerce_enabled', 1, false, 
			                      [ 'class' => 'input-icheck', 'id' => 'woocommerce_enabled']); !!} {{ __('lang_v1.woocommerce_enabled') }}
			                    </label>
			                </div>
			            </div>
			        @endif
			    </div>
			@endif
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary" data-dismiss="modal">@lang('messages.apply')</button>
		    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.cancel')</button>
		</div>
		
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->