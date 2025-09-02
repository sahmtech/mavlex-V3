<div class="modal-dialog modal-xl" role="document">
	<div class="modal-content" style="background: var(--bg-primary); border: 1px solid var(--border-color); border-radius: 20px; box-shadow: var(--shadow-xl); color: var(--text-primary);">
		<div class="modal-header" style="background: var(--bg-secondary); border-bottom: 1px solid var(--border-color); border-radius: 20px 20px 0 0;">
		    <button type="button" class="close no-print" data-dismiss="modal" aria-label="Close" style="color: var(--text-primary); opacity: 0.8; font-size: 1.5rem; font-weight: 300;"><span aria-hidden="true">&times;</span></button>
		      <h4 class="modal-title" id="modalTitle" style="color: var(--text-primary); font-weight: 700; font-size: 1.5rem;">{{$product->name}}</h4>
	    </div>
	    <div class="modal-body" style="background: var(--bg-primary); padding: 2rem;">
      		<div class="row">
      			<div class="col-md-4">
      				<div class="thumbnail" style="background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 12px; overflow: hidden; margin-bottom: 0; position: relative;">
      					<img src="{{$product->image_url}}" alt="Product image" style="width: 100%; height: 280px; object-fit: cover;">
      					@if($product->type == 'single' && !empty($discounts[$product->variations->first()->id]))
      						<span class="label label-warning discount-badge" style="position: absolute; top: 12px; right: 12px; background: var(--danger-color); color: white; padding: 8px 16px; border-radius: 50px; font-size: 0.85rem; font-weight: 700; box-shadow: var(--shadow-lg);">- {{@num_format($discounts[$product->variations->first()->id]->discount_amount)}}%</span>
      					@endif
      				</div>
      			</div>
      			<div class="col-md-8">
      				@if($product->type == 'single' || $product->type == 'combo')
      					<div class="col-md-12">
      						<p class="lead" style="color: var(--success-color); font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem;">@lang('lang_v1.price'): &nbsp;&nbsp;&nbsp;<span class="display_currency" data-currency_symbol="true">{{ $product->variations->first()->sell_price_inc_tax }}</span></p>
      					</div>
      				@endif
      				<div class="col-md-12">
	      				<table class="table no-border table-slim" style="color: var(--text-primary);">
	      					<tr style="border-bottom: 1px solid var(--border-color);">
	      						<th style="color: var(--text-secondary); font-weight: 600; padding: 12px 0; width: 35%;">@lang('product.sku'):</th>
	      						<td style="color: var(--text-primary); padding: 12px 0;">{{$product->sku }}</td>
	      					</tr>
	      					<tr style="border-bottom: 1px solid var(--border-color);">
	      						<th style="color: var(--text-secondary); font-weight: 600; padding: 12px 0;">@lang('product.category'):</th>
	      						<td style="color: var(--text-primary); padding: 12px 0;">{{$product->category->name ?? '--' }}</td>
	      					</tr>
	      					<tr style="border-bottom: 1px solid var(--border-color);">
	      						<th style="color: var(--text-secondary); font-weight: 600; padding: 12px 0;">@lang('product.sub_category'):</th>
	      						<td style="color: var(--text-primary); padding: 12px 0;">{{$product->sub_category->name ?? '--' }}</td>
	      					</tr>
	      					<tr style="border-bottom: 1px solid var(--border-color);">
	      						<th style="color: var(--text-secondary); font-weight: 600; padding: 12px 0;">@lang('product.brand'):</th>
	      						<td style="color: var(--text-primary); padding: 12px 0;">{{$product->brand->name ?? '--' }}</td>
	      					</tr>
	      					@php 
	    						$custom_labels = json_decode(session('business.custom_labels'), true);
							@endphp
							@if(!empty($product->product_custom_field1))
								<tr>
	      							<th>{{ $custom_labels['product']['custom_field_1'] ?? __('lang_v1.product_custom_field1') }}: </th>
									<td>{{$product->product_custom_field1 }}</td>
								</tr>
							@endif

							@if(!empty($product->product_custom_field2))
								<tr>
		      						<th>{{ $custom_labels['product']['custom_field_2'] ?? __('lang_v1.product_custom_field2') }}: </th>
									<td>{{$product->product_custom_field2 }}</td>
								</tr>
							@endif

							@if(!empty($product->product_custom_field3))
								<tr>
	      							<th>{{ $custom_labels['product']['custom_field_3'] ?? __('lang_v1.product_custom_field3') }}: </th>
									<td>{{$product->product_custom_field3 }}</td>
								</tr>
							@endif

							@if(!empty($product->product_custom_field4))
								<tr>
	      							<th>{{ $custom_labels['product']['custom_field_4'] ?? __('lang_v1.product_custom_field4') }}: </th>
									<td>{{$product->product_custom_field4 }}</td>
								</tr>
							@endif
	      					<tr>
	      						<td colspan="2"><br><br>{!! $product->product_description !!}</td>
	      					</tr>
							  <tr>
                                <td>
								@if ($product->enable_stock == 1)
                    @if($product->type == 'single')
                    <tr>
                        <td>
                            @if ($product->variation_qty <= 0)
                                <small>@lang('lang_v1.out_of_stock')</small>
                            @endif
                        </td>
                    </tr>
                    @endif
                    @endif

                                </td>
                            </tr>

	      				</table>
      				</div>
	      		</div>
      		</div>
      		@if($product->type == 'variable')
      			@include('productcatalogue::catalogue.partials.variable_product_details')
      		@elseif($product->type == 'combo')
      			@include('productcatalogue::catalogue.partials.combo_product_details')
      		@endif
			
      	</div>
      	<div class="modal-footer" style="background: var(--bg-secondary); border-top: 1px solid var(--border-color); border-radius: 0 0 20px 20px; padding: 1.5rem 2rem;">
	      	<button type="button" class="btn btn-default no-print" data-dismiss="modal" style="background: var(--primary-color); color: white; border: none; padding: 12px 24px; border-radius: 12px; font-weight: 600; transition: all 0.3s ease;">@lang( 'messages.close' )</button>
	    </div>
	</div>
</div>
