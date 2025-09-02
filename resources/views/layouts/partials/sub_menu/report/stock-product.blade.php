@php
	$enabled_modules = !empty(session('business.enabled_modules')) ? session('business.enabled_modules') : [];
	$is_admin = auth()->user()->hasRole('Admin#' . session('business.id')) ? true : false;
	$link_class = $link_class ?? ''; 
@endphp

	
	@can('stock_report.view')
	<a href="{{ action('ReportController@getStockReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'stock-report' ? 'active' : '' }}">@lang('report.stock_report')</a>

	@can('purchase_n_sell_report.view')
		<a href="{{ action('ReportController@itemsReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'items-report' ? 'active' : '' }}">@lang('lang_v1.items_report')</a>

	@endcan

	@if(session('business.enable_product_expiry') == 1)
		<a href="{{ action('ReportController@getStockExpiryReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'stock-expiry' ? 'active' : '' }}">@lang('report.stock_expiry_report')</a>
	@endif

	@if(in_array('stock_adjustment', $enabled_modules))
		<a href="{{ action('ReportController@getStockAdjustmentReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'stock-adjustment-report' ? 'active' : '' }}">@lang('report.stock_adjustment_report')</a>
	@endif

	@if(session('business.enable_lot_number') == 1)
		<a href="{{ action('ReportController@getLotReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'lot-report' ? 'active' : '' }}">@lang('lang_v1.lot_report')</a>
	@endif

	
	@endcan
