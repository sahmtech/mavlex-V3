<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel">{{$product->product_name}} - {{$product->sub_sku}}</h4>
		</div>
		<div class="modal-body">
			<div class="row">
				<div class="form-group col-xs-12 @if(!auth()->user()->can('edit_product_price_from_sale_screen')) hide @endif">
					@php
					$pos_unit_price = !empty($product->unit_price_before_discount) ? $product->unit_price_before_discount : $product->default_sell_price;
					@endphp
					<label>@lang('sale.unit_price')</label>
					<input type="text" name="products[{{$row_count}}][unit_price]" class="form-control pos_unit_price input_number mousetrap" value="{{@num_format($pos_unit_price)}}" @if(!empty($pos_settings['enable_msp'])) data-rule-min-value="{{$pos_unit_price}}" data-msg-min-value="{{__('lang_v1.minimum_selling_price_error_msg', ['price' => @num_format($pos_unit_price)])}}" @endif>
				</div>
				@if(!auth()->user()->can('edit_product_price_from_sale_screen'))
				<div class="form-group col-xs-12">
					<strong>@lang('sale.unit_price'):</strong> {{@num_format(!empty($product->unit_price_before_discount) ? $product->unit_price_before_discount : $product->default_sell_price)}}
				</div>
				@endif
				<div class="form-group col-xs-12 col-sm-6 @if(!$edit_discount) hide @endif">
					<label>@lang('sale.discount_type')</label>
					{!! Form::select("products[$row_count][line_discount_type]", ['fixed' => __('lang_v1.fixed'), 'percentage' => __('lang_v1.percentage')], $discount_type , ['class' => 'form-control row_discount_type']); !!}
				</div>
				<div class="form-group col-xs-12 col-sm-6 @if(!$edit_discount) hide @endif">
					<label>@lang('sale.discount_amount')</label>
					{!! Form::text("products[$row_count][line_discount_amount]", @num_format($discount_amount), ['class' => 'form-control input_number row_discount_amount']); !!}
				</div>
				@if(!empty($discount))
				<div class="form-group col-xs-12">
					<p class="help-block">{!! __('lang_v1.applied_discount_text', ['discount_name' => $discount->name, 'starts_at' => $discount->formated_starts_at, 'ends_at' => $discount->formated_ends_at]) !!}</p>
				</div>
				@endif
				<div class="form-group col-xs-12 {{$hide_tax}}">
					<label>@lang('sale.tax')</label>

					{!! Form::hidden("products[$row_count][item_tax]", @num_format($item_tax), ['class' => 'item_tax']); !!}
					{!! Form::select("products[$row_count][tax_id]", $tax_dropdown['tax_rates'], $tax_id, ['placeholder' => 'Select', 'class' => 'form-control tax_id'], $tax_dropdown['attributes']); !!}
				</div>
				@if(!empty($warranties))
				<div class="form-group col-xs-12">
					<label>@lang('lang_v1.warranty')</label>
					{!! Form::select("products[$row_count][warranty_id]", $warranties, $warranty_id, ['placeholder' => __('messages.please_select'), 'class' => 'form-control']); !!}
				</div>
				@endif
				<div class="form-group col-xs-12">
					<input type="hidden" class="base_unit_multiplier" name="products[{{$row_count}}][base_unit_multiplier]" value="{{$multiplier}}">
					<input type="hidden" class="hidden_base_unit_sell_price" value="{{$product->default_sell_price / $multiplier}}">
					<input type="hidden" name="products[{{$row_count}}][product_unit_id]" value="{{$product->unit_id}}">
					@if(count($sub_units) > 0)
					<label>@lang('product.unit')</label>
					<select name="products[{{$row_count}}][sub_unit_id]" class="form-control input-sm sub_unit ">
						@foreach($sub_units as $key => $value)
						<option value="{{$key}}" data-multiplier="{{$value['multiplier']}}" data-unit_name="{{$value['name']}}" data-allow_decimal="{{$value['allow_decimal']}}" @if(!empty($product->sub_unit_id) && $product->sub_unit_id == $key) selected @endif>
							{{$value['name']}}
						</option>
						@endforeach
					</select>
					@else
					<span>{{$product->unit}}</span>
					@endif
					@if(!empty($product->second_unit))
					<span style="white-space: nowrap;">
						@lang('lang_v1.quantity_in_second_unit', ['unit' => $product->second_unit]) *:
					</span>
					<input type="text"
						name="products[{{$row_count}}][secondary_unit_quantity]"
						value="{{@format_quantity($product->secondary_unit_quantity)}}"
						class="form-control input-sm input_number"
						required>
					@endif
				</div>

				<div class="form-group col-xs-12">
					<label>@lang('restaurant.service_staff')</label>
					@if(!empty($is_direct_sell))
					@if(!empty($pos_settings['inline_service_staff']))
					{!! Form::select("products[" . $row_count . "][res_service_staff_id]", $waiters, !empty($product->res_service_staff_id) ? $product->res_service_staff_id : null, ['class' => 'form-control input-sm select2 order_line_service_staff', 'placeholder' => __('restaurant.select_service_staff'), 'required' => (!empty($pos_settings['is_service_staff_required']) && $pos_settings['is_service_staff_required'] == 1) ? true : false ]); !!}
					@endif
					@endif
					@if(!empty($pos_settings['inline_service_staff']))
					{!! Form::select("products[" . $row_count . "][res_service_staff_id]", $waiters, !empty($product->res_service_staff_id) ? $product->res_service_staff_id : null, ['class' => 'form-control input-sm select2 order_line_service_staff', 'placeholder' => __('restaurant.select_service_staff'), 'required' => (!empty($pos_settings['is_service_staff_required']) && $pos_settings['is_service_staff_required'] == 1) ? true : false ]); !!}
					@endif
				</div>
				<div class="text-center {{$hide_tax}}">
		{!! Form::hidden("products[$row_count][item_tax]", @num_format($item_tax), ['class' => 'item_tax']); !!}
		{!! Form::select("products[$row_count][tax_id]", $tax_dropdown['tax_rates'], $tax_id, ['placeholder' => 'Select', 'class' => 'form-control input-sm tax_id']); !!}
	</div>
				<div class="form-group col-xs-12 {{$hide_tax}}">
					<label>@lang('sale.price_inc_tax')</label>
					<input type="hidden" name="discount_cd [{{$row_count}}]" id="discount_cd" value="{{$discount_amount}}">
					<input type="hidden" name="item_price [{{$row_count}}]" id="item_price" value="{{@num_format($unit_price_inc_tax)}}">
					<input type="text" name="products[{{$row_count}}][unit_price_inc_tax]" class="form-control input-sm pos_unit_price_inc_tax input_number" value="{{@num_format($unit_price_inc_tax)}}" @if(!$edit_price) readonly @endif
					{{--@if(!empty($pos_settings['enable_msp'])) data-rule-min-value="{{$unit_price_inc_tax}}" data-msg-min-value="{{__('lang_v1.minimum_selling_price_error_msg', ['price' => @num_format($unit_price_inc_tax)])}}" @endif--}}
					>
				</div>

				<div class="form-group col-xs-12 ">
					<label>@lang('sale.subtotal')</label>
					@php
					$subtotal_type = !empty($pos_settings['is_pos_subtotal_editable']) ? 'text' : 'hidden';
					@endphp
					<input type="{{$subtotal_type}}"  class="form-control input-sm pos_line_total @if(!empty($pos_settings['is_pos_subtotal_editable'])) input_number @endif" value="{{@num_format($product->quantity_ordered*$unit_price_inc_tax )}}">
					<span class="display_currency pos_line_total_text @if(!empty($pos_settings['is_pos_subtotal_editable'])) hide @endif" data-currency_symbol="true">{{$product->quantity_ordered*$unit_price_inc_tax}}</span>
				</div>

				<div class="form-group col-xs-12">
					<label>@lang('lang_v1.description')</label>
					<textarea class="form-control" name="products[{{$row_count}}][sell_line_note]" rows="3">{{$sell_line_note}}</textarea>
					<p class="help-block">@lang('lang_v1.sell_line_description_help')</p>
				</div>
				
			</div>
			
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
		</div>
	</div>
</div>

