@php
	$enabled_modules = !empty(session('business.enabled_modules')) ? session('business.enabled_modules') : [];
	$is_admin = auth()->user()->hasRole('Admin#' . session('business.id')) ? true : false;
	$link_class = $link_class ?? ''; 
@endphp



	@if(in_array('expenses', $enabled_modules))
		@can('expense_report.view')
			<a href="{{ action('ReportController@getExpenseReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'expense-report' ? 'active' : '' }}">@lang('report.expense_report')</a>
		@endcan
	@endif

	@can('tax_report.view')
	<a href="{{ action('ReportController@getTaxReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'tax-report' ? 'active' : '' }}">@lang('report.tax_report')</a>
	@endcan

	@if(in_array('account', $enabled_modules))
		@can('account.access')
			<a href="{{ action('AccountReportsController@paymentAccountReport') }}" class="{{ $link_class }} {{ request()->segment(1) == 'account' && request()->segment(2) == 'payment-account-report' ? 'active' : '' }}">@lang('account.payment_account_report')</a>
		@endcan
	@endif
@if(auth()->user()->can('tax_report.view') && !empty(config('constants.enable_gst_report_india')))
<a href="{{ action([\App\Http\Controllers\ReportController::class, 'gstSalesReport']) }}" class="{{ $link_class }} {{ request()->segment(2) == 'gst-sales-report' ? 'active' : '' }}"> @lang('lang_v1.gst_sales_report')</a>
<a href="{{ action([\App\Http\Controllers\ReportController::class, 'gstPurchaseReport']) }}"  class="{{ $link_class }} {{ request()->segment(2) == 'gst-purchase-report' ? 'active' : '' }}">@lang('lang_v1.gst_purchase_report')</a>
@endif

	<!-- <a href="{{ action('ReportController@getSmsHistory') }}" class="{{ $link_class }} {{ request()->segment(2) == 'sms-history' ? 'active' : '' }}">SMS History</a> -->
