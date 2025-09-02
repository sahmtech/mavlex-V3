@php
	$enabled_modules = !empty(session('business.enabled_modules')) ? session('business.enabled_modules') : [];
	$is_admin = auth()->user()->hasRole('Admin#' . session('business.id')) ? true : false;
	$link_class = $link_class ?? ''; 
@endphp

	@can('purchase_n_sell_report.view')
		<a href="{{ action('ReportController@getproductPurchaseReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'product-purchase-report' ? 'active' : '' }}">@lang('lang_v1.product_purchase_report')</a>
		<a href="{{ action('ReportController@purchasePaymentReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'purchase-payment-report' ? 'active' : '' }}">@lang('lang_v1.purchase_payment_report')</a>
	@endcan

	@can('purchase_n_sell_report.view')
	<a href="{{ action('ReportController@getPurchaseSell') }}" class="{{ $link_class }} {{ request()->segment(2) == 'purchase-sell' ? 'active' : '' }}">@lang('report.purchase_sell_report')</a>
	@endcan

	@if(config('constants.show_report_606') == true)
	<a href="{{ action('ReportController@purchaseReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'purchase-report' ? 'active' : '' }}">@lang('lang_v1.purchase')</a>
	@endif
