@php
	$enabled_modules = !empty(session('business.enabled_modules')) ? session('business.enabled_modules') : [];
	$is_admin = auth()->user()->hasRole('Admin#' . session('business.id')) ? true : false;
	$link_class = $link_class ?? ''; 
@endphp


	@can('contacts_report.view')
	<a href="{{ action('ReportController@getCustomerSuppliers') }}" class="{{ $link_class }} {{ request()->segment(2) == 'customer-supplier' ? 'active' : '' }}">@lang('report.contacts')</a>

	<a href="{{ action('ReportController@getCustomerGroup') }}" class="{{ $link_class }} {{ request()->segment(2) == 'customer-group' ? 'active' : '' }}">@lang('lang_v1.customer_groups_report')</a>
	@endcan
