@php
  $link_class = $link_class ?? ''; 
@endphp
@canany(['purchase.view', 'purchase.create'])
    <a href="{{ action('StockTransferController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'stock-transfers' && request()->segment(2) == null || request()->segment(1) == 'stock-transfers' && request()->segment(2) == 'create' || request()->segment(1) == 'stock-transfers' && request()->segment(3) == 'edit' ? 'active' : '' }}">@lang('lang_v1.stock_transfers')</a>
    @endcanany

    @can('adjustment.create')
    <a href="{{ action('StockAdjustmentController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'stock-adjustments' && request()->segment(2) == null || request()->segment(1) == 'stock-adjustments' && request()->segment(2) == 'create' ? 'active' : '' }}">@lang('stock_adjustment.stock_adjustment')</a>
    @endcan

    @can('product.opening_stock')
    <a href="{{ action('ImportOpeningStockController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'import-opening-stock' ? 'active' : '' }}">@lang('lang_v1.import_opening_stock')</a>
    @endcan
