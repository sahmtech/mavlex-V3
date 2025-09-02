@php
    $image = DB::table('products') ->where('id', $product->product_id) ->value('image');
    $default_image = asset('/img/default.png');
    $image_url = $default_image;
    if ($image) {
        $image_path = public_path('uploads/img/' . $image);
        if (file_exists($image_path)) {
            $image_url = upload_asset('uploads/img/' . rawurlencode($image));
        }
    }
@endphp
<div class="product-card">
    <div class="product-image" style="background-image: url({{ $image_url }});"></div>
    <div class="product-info">
        <h1>{!! $product->product_name !!}</h1>
        <h3>{{ '(' . $product->sub_sku . ')' }}</h3>
        @if($product->type == 'variable')
            <p>@lang('lang_v1.variation'): {{$product->variation}}</p>
        @endif
        <div class="price">@lang('lang_v1.price'): {{ @num_format($product->sell_price_inc_tax) }}</div>
        @if ($product->enable_stock == 1)
            @if ($product->qty_available > 0)
                <span class="label-success heading" style="border-radius: 4px; padding:1px;">
                    @lang('lang_v1.available_quantity'): {{ number_format($product->qty_available, 2) }} {{$product->unit }}
                </span>
            @else
                <span class="label-danger heading" style="border-radius: 4px; padding:1px;">
                    @lang('lang_v1.item_out_of_stock')
                </span>
            @endif
        @elseif ($product->manage_stock == 0)
            <span class="label-yellow heading" style="border-radius: 4px; padding:1px;">
                <strong>@lang('lang_v1.stock_management_disabled')</strong>
            </span>
        @endif
    </div>
    <div class="price-container">
        <span class="price-bottom">@lang('lang_v1.net_price'): {{ @num_format($product->sell_price_inc_tax)}}</span>
    </div>
</div>
