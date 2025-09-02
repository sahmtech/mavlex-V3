<div id="loader" style="display:none;">Loading...</div>
<style>
    #loader {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 20px;
        color: #000;
    }
</style>
@forelse($products as $product)
@php
    $default_image = asset('/img/default.png');
    if (!empty($product->product_image)) {
        $image_url = upload_asset('/uploads/img/' . rawurlencode($product->product_image));
    } else {
        $image_url = $default_image;
    }
@endphp
    <div class="col-md-3 col-xs-4 product_list no-print">
        <div class="product_box" data-variation_id="{{ $product->id }}"
            title="{{ $product->name }} @if ($product->type == 'variable') - {{ $product->variation }} @endif {{ '(' . $product->sub_sku . ')' }} @if (!empty($show_prices)) @lang('lang_v1.default') - @format_currency($product->selling_price) @foreach ($product->group_prices as $group_price) @if (array_key_exists($group_price->price_group_id, $allowed_group_prices)) {{ $allowed_group_prices[$group_price->price_group_id] }} - @format_currency($group_price->price_inc_tax) @endif @endforeach @endif">

            <div class="image-container"
                style="background-image: url({{ $image_url }}); 
				   background-repeat: no-repeat; 
				   background-position: center;
				   background-size: contain;">
            </div>

            <div class="text_div">
                <small class="text text-muted">{{ $product->name }}
                    @if ($product->type == 'variable')
                        - {{ $product->variation }}
                    @endif
                </small>
                <small class="text-muted">
                    ({{ $product->sub_sku }})
                </small>

                @if (!empty($show_prices))
                    <br>
                    <small class="text-muted">
                        @format_currency($product->selling_price)
                    </small>
                @endif

                @if ($show_product_qty == 1)
                    <br>
                    @if ($product->enable_stock == 1)
                        <small class="@if ($product->qty_available > 0) label-success @else label-danger @endif"
                            style="border-radius: 4px; padding:1px;">
                            {{ number_format($product->qty_available, 2) }}
                        </small>
                    @elseif ($product->manage_stock == 0)
                        <small class="label-yellow"
                            style="border-radius: 4px; padding-left:15px; padding-right:15px; padding-top:1px; padding-bottom:1px;">
                            ~
                        </small>
                    @endif
                @endif
            </div>
        </div>
    </div>
@empty
    <input type="hidden" id="no_products_found">
    <div class="">
        <h4 class="text-center">
            @lang('lang_v1.no_products_to_display')
        </h4>
    </div>
@endforelse
