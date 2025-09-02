
<div class="pos-subheader-mobile" style="margin-bottom: 20px;">
    <div class="back">
        <button type="button" id="backToCustomer" class="back"><img src="{{ asset('img/icons/back-icon.svg') }}" alt=""></button>
    </div>
    <div class="center">
        <h2>@lang('lang_v1.cart')</h2>
	
    <p>@lang('sale.invoice_no'): {{$transaction->invoice_no}}</p>

</div>
    <div class="pos-subheader-mobile pull-right">
        @if(isset($pos_settings['enable_weighing_scale']) && $pos_settings['enable_weighing_scale'] == 1)
        <button type="button" class=" " id="weighing_scale_btn" data-toggle="modal" data-target="#weighing_scale_modal" title="@lang('lang_v1.weighing_scale')">
            <img data-toggle="tooltip" data-placement="bottom" src="{{ asset('img/icons/tachograph.svg') }}" alt="">
        </button>
        @endif
        <button type="button" class="pos_add_quick_product" data-href="{{action('ProductController@quickAdd')}}" data-container=".quick_add_product_modal"><img data-toggle="tooltip" data-placement="bottom" src="{{ asset('img/icons/add_product.svg') }}" alt=""></i></button>

        <button type="button" title="{{ __('lang_v1.view_products') }}" data-placement="bottom"
            class=" hide-view-product btn-modal "
            data-toggle="modal" data-target="#mobile_products_modal">
            <img title="Products" data-toggle="tooltip" data-placement="bottom" src="{{ asset('img/icons/view-product.svg') }}" alt="">
        </button>
    </div>
</div>

<div class="clearfix"></div>

<div class="search-product ">
    <div class="col-md-4">
        <div class="form-group">
        {!! Form::text('search_product', null, ['class' => 'form-control mousetrap', 'id' => 'search_product', 'placeholder' => __('lang_v1.search_product_placeholder'),
							'autofocus' => true,
							]); !!}
        </div>
    </div>
</div>
<div class="pos_product_div">
<input type="hidden" name="sell_price_tax" id="sell_price_tax" value="{{$business_details->sell_price_tax}}">

<!-- Keeps count of product rows -->
<input type="hidden" id="product_row_count" 
    value="{{count($sell_details)}}">
@php
    $hide_tax = '';
    if( session()->get('business.enable_inline_tax') == 0){
        $hide_tax = 'hide';
    }
@endphp
    <table class="table table-condensed  table-responsive pos-product-table" id="pos_table">
        <thead>
            <tr>
                <th class="tex-center @if(!empty($pos_settings['inline_service_staff'])) col-md-3 @else col-md-4 @endif">
                    @lang('sale.product') @show_tooltip(__('lang_v1.tooltip_sell_product_column'))
                </th>
                <th class="text-center">Qty</th>
                <th class="text-center"><i class="fas fa-times" aria-hidden="true"></i></th>
            </tr>
        </thead>
        <tbody class="tbody-scroll">
				@foreach($sell_details as $sell_line)
				@include('mobile_sale_pos.product_row', 
					['product' => $sell_line, 
					'row_count' => $loop->index, 
					'tax_dropdown' => $taxes, 
					'sub_units' => !empty($sell_line->unit_details) ? $sell_line->unit_details : [],
					'action' => 'edit'
				])
			@endforeach
			</tbody>
    </table>
</div>


<div class="mobile-pos-footer">
<button type="button" id="nextToPayment" class="next-button"><h3>@lang('lang_v1.checkout')</h3></button>
</div>
