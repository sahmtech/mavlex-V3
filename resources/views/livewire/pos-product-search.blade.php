<div class="w-100" style="position: relative;">
    {{-- The actual search box --}}
    <input type="text"
           wire:model.live="term"
           class="form-control mousetrap"
           placeholder="{{ __('lang_v1.search_product_placeholder') }}"
           @if(is_null($location_id)) disabled @endif
           autofocus />

    {{-- Dropdown of search results (absolute positioned) --}}
    @if(count($products) > 0)
        <ul class="list-group list-group-flush position-absolute w-100" style="z-index: 999; top: 100%; left: 0;">
            @foreach($products as $product)
                <li class="list-group-item list-group-item-action"
                    wire:click="selectProduct({{ $product->variation_id }})">
                    {{ $product->name }} ({{ $product->sub_sku }}) - {{ $product->selling_price }}
                </li>
            @endforeach
        </ul>
    @elseif(strlen($term) > 1)
        <div class="mt-2 alert alert-warning position-absolute w-100" style="z-index: 999; top: 100%; left: 0;">
            {{ __('lang_v1.no_products_found') }}
        </div>
    @endif
</div>

