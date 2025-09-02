@php
$common_settings = session()->get('business.common_settings');
$link_class = $link_class ?? ''; 
@endphp



    {{-- List Products Link --}}
    @can('product.view')
    <a href="{{ action('ProductController@index') }}"
        class="{{ $link_class }} {{ request()->segment(1) == 'products' && request()->segment(2) == '' ? 'active' : '' }}">
        @lang('lang_v1.list_products')
    </a>
    @endcan

    {{-- Import Products Link --}}
    @can('product.create')
    <a href="{{ action('ImportProductsController@index') }}"
        class="{{ $link_class }} {{ request()->segment(1) == 'import-products' ? 'active' : '' }}">
        @lang('product.import_products')
    </a>
    @endcan

    {{-- Units Link --}}
    @canany(['unit.view', 'unit.create'])
    <a href="{{ action('UnitController@index') }}"
        class="{{ $link_class }} {{ request()->segment(1) == 'units' ? 'active' : '' }}">
        @lang('unit.units')
    </a>
    @endcanany

    {{-- Variations Link --}}
    @canany(['unit.view', 'unit.create'])
    <a href="{{ action('VariationTemplateController@index') }}"
        class="{{ $link_class }} {{ request()->segment(1) == 'variation-templates' ? 'active' : '' }}">
        @lang('product.variations')
    </a>
    @endcanany

    {{-- Categories Link --}}
    @canany(['category.view', 'category.create'])
    <a href="{{ action('TaxonomyController@index') . '?type=product' }}"
        class="{{ $link_class }} {{ request()->segment(1) == 'taxonomies' && request()->get('type') == 'product' ? 'active' : '' }}">
        @lang('category.categories')
    </a>
    @endcanany
    {{-- Purchase Sell Mismatch --}}
    @if(auth()->user()->can('purchase_sell_mismatch.view'))
    <a href="{{ action('StockRebuildController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'stock-rebuild' ? 'active' : '' }}">
      @lang('lang_v1.purchase_sell_mismatch')
    </a>
    @endif

    {{-- Brands Link (if enabled) --}}
    @if(session('business.enable_brand'))
    @canany(['brand.view', 'brand.create'])
    <a href="{{ action('BrandController@index') }}"
        class="{{ $link_class }} {{ request()->segment(1) == 'brands' ? 'active' : '' }}">
        @lang('brand.brands')
    </a>
    @endcanany
    @endif

    {{-- Selling Price Group Link --}}
    @can('product.view')
    <a href="{{ action('SellingPriceGroupController@index') }}"
        class="{{ $link_class }} {{ request()->segment(1) == 'selling-price-group' ? 'active' : '' }}">
        @lang('lang_v1.selling_price_group')
    </a>
    @endcan

    {{-- Tax Rates Link --}}
    @canany(['tax_rate.view', 'tax_rate.create'])
    <a href="{{ action('TaxRateController@index') }}"
        class="{{ $link_class }} {{ request()->segment(1) == 'tax-rates' ? 'active' : '' }}">
        @lang('tax_rate.tax_rates')
    </a>
    @endcanany

    {{-- Warranties Link (if enabled) --}}
    @if(!empty($common_settings['enable_product_warranty']))
    <a href="{{ action([\App\Http\Controllers\WarrantyController::class, 'index']) }}"
        class="{{ $link_class }} {{ request()->segment(1) == 'warranties' ? 'active' : '' }}">
        @lang('lang_v1.warranties')
    </a>
    @endif
    