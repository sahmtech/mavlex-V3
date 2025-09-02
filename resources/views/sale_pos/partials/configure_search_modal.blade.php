<div class="modal fade" id="configure_search_modal" tabindex="-1" role="dialog" 
	aria-labelledby="gridSystemModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">
					@lang('lang_v1.search_products_by')
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="form-group">
							<p>@lang('product.product_name')</p>
							<div class="toggle-wrapper d-flex gap-2 mt-4">
								<label class="switch" for="search_fields_name">
									{!! Form::checkbox('search_fields[]', 'name', true, ['id' => 'search_fields_name', 'class' => 'search_fields']) !!}
									<div class="sliderCheckbox round"></div>
								</label>
							</div>
						</div>
					</div>
					
					<div class="col-sm-6">
						<div class="form-group">
							<p>@lang('product.sku')</p>
							<div class="toggle-wrapper d-flex gap-2 mt-4">
								<label class="switch" for="search_fields_sku">
									{!! Form::checkbox('search_fields[]', 'sku', true, ['id' => 'search_fields_sku', 'class' => 'search_fields']) !!}
									<div class="sliderCheckbox round"></div>
								</label>
							</div>
						</div>
					</div>
					
					@if(request()->session()->get('business.enable_lot_number') == 1)
						<div class="col-sm-6">
							<div class="form-group">
								<p>@lang('lang_v1.lot_number')</p>
								<div class="toggle-wrapper d-flex gap-2 mt-4">
									<label class="switch" for="search_fields_lot">
										{!! Form::checkbox('search_fields[]', 'lot', true, ['id' => 'search_fields_lot', 'class' => 'search_fields']) !!}
										<div class="sliderCheckbox round"></div>
									</label>
								</div>
							</div>
						</div>
					@endif
					

					@php
						$custom_labels = json_decode(session('business.custom_labels'), true);
						$product_custom_field1 = !empty($custom_labels['product']['custom_field_1']) ? $custom_labels['product']['custom_field_1'] : __('lang_v1.product_custom_field1');
						$product_custom_field2 = !empty($custom_labels['product']['custom_field_2']) ? $custom_labels['product']['custom_field_2'] : __('lang_v1.product_custom_field2');
						$product_custom_field3 = !empty($custom_labels['product']['custom_field_3']) ? $custom_labels['product']['custom_field_3'] : __('lang_v1.product_custom_field3');
						$product_custom_field4 = !empty($custom_labels['product']['custom_field_4']) ? $custom_labels['product']['custom_field_4'] : __('lang_v1.product_custom_field4');
			        @endphp
			        <div class="clearfix"></div>
			        <div class="col-sm-6">
						<div class="form-group">
							<p>{{ $product_custom_field1 }}</p>
							<div class="toggle-wrapper d-flex gap-2 mt-4">
								<label class="switch" for="search_fields_product_custom_field1">
									{!! Form::checkbox('search_fields[]','product_custom_field1',false,['id'=>'search_fields_product_custom_field1']) !!}
									<div class="sliderCheckbox round"></div>
								</label>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<p>{{ $product_custom_field2 }}</p>
							<div class="toggle-wrapper d-flex gap-2 mt-4">
								<label class="switch" for="search_fields_product_custom_field2">
									{!! Form::checkbox('search_fields[]','product_custom_field2',false,['id'=>'search_fields_product_custom_field2']) !!}
									<div class="sliderCheckbox round"></div>
								</label>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<p>{{ $product_custom_field3 }}</p>
							<div class="toggle-wrapper d-flex gap-2 mt-4">
								<label class="switch" for="search_fields_product_custom_field3">
									{!! Form::checkbox('search_fields[]','product_custom_field3',false,['id'=>'search_fields_product_custom_field3']) !!}
									<div class="sliderCheckbox round"></div>
								</label>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<p>{{ $product_custom_field4 }}</p>
							<div class="toggle-wrapper d-flex gap-2 mt-4">
								<label class="switch" for="search_fields_product_custom_field4">
									{!! Form::checkbox('search_fields[]','product_custom_field4',false,['id'=>'search_fields_product_custom_field4']) !!}
									<div class="sliderCheckbox round"></div>
								</label>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<div class="modal-footer">
			    <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
			</div>
		</div>
	</div>
</div>