@php
	$enabled_modules = !empty(session('business.enabled_modules')) ? session('business.enabled_modules') : [];
	$is_admin = auth()->user()->hasRole('Admin#' . session('business.id')) ? true : false;
	$link_class = $link_class ?? ''; 
@endphp



	@canany('profit_loss_report.view')
	<a href="{{ action('ReportController@getProfitLoss') }}" class="{{ $link_class }} {{ request()->segment(2) == 'profit-loss' ? 'active' : '' }}">@lang('report.profit_loss')</a>
	@endcanany

	@if(config('constants.show_report_606') == true)
	<a href="{{ action('ReportController@purchaseReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'purchase-report' ? 'active' : '' }}">@lang('lang_v1.purchase')</a>
	@endif

	@if(config('constants.show_report_607') == true)
	<a href="{{ action('ReportController@saleReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'sale-report' ? 'active' : '' }}">@lang('business.sale')</a>
	@endif


	@can('purchase_n_sell_report.view')
	<a href="{{ action('ReportController@getPurchaseSell') }}" class="{{ $link_class }} {{ request()->segment(2) == 'purchase-sell' ? 'active' : '' }}">@lang('report.purchase_sell_report')</a>
	@endcan

	@can('tax_report.view')
	<a href="{{ action('ReportController@getTaxReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'tax-report' ? 'active' : '' }}">@lang('report.tax_report')</a>
	@endcan

	@can('contacts_report.view')
	<a href="{{ action('ReportController@getCustomerSuppliers') }}" class="{{ $link_class }} {{ request()->segment(2) == 'customer-supplier' ? 'active' : '' }}">@lang('report.contacts')</a>

	<a href="{{ action('ReportController@getCustomerGroup') }}" class="{{ $link_class }} {{ request()->segment(2) == 'customer-group' ? 'active' : '' }}">@lang('lang_v1.customer_groups_report')</a>
	@endcan

	@can('stock_report.view')
	<a href="{{ action('ReportController@getStockReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'stock-report' ? 'active' : '' }}">@lang('report.stock_report')</a>

	@if(session('business.enable_product_expiry') == 1)
		<a href="{{ action('ReportController@getStockExpiryReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'stock-expiry' ? 'active' : '' }}">@lang('report.stock_expiry_report')</a>
	@endif

	@if(session('business.enable_lot_number') == 1)
		<a href="{{ action('ReportController@getLotReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'lot-report' ? 'active' : '' }}">@lang('lang_v1.lot_report')</a>
	@endif

	@if(in_array('stock_adjustment', $enabled_modules))
		<a href="{{ action('ReportController@getStockAdjustmentReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'stock-adjustment-report' ? 'active' : '' }}">@lang('report.stock_adjustment_report')</a>
	@endif
	@endcan

	@can('trending_product_report.view')
	<a href="{{ action('ReportController@getTrendingProducts') }}" class="{{ $link_class }} {{ request()->segment(2) == 'trending-products' ? 'active' : '' }}">@lang('report.trending_products')</a>
	@endcan

	@can('purchase_n_sell_report.view')
		<a href="{{ action('ReportController@itemsReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'items-report' ? 'active' : '' }}">@lang('lang_v1.items_report')</a>

		<a href="{{ action('ReportController@getproductPurchaseReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'product-purchase-report' ? 'active' : '' }}">@lang('lang_v1.product_purchase_report')</a>

		<a href="{{ action('ReportController@getproductSellReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'product-sell-report' ? 'active' : '' }}">@lang('lang_v1.product_sell_report')</a>

		<a href="{{ action('ReportController@purchasePaymentReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'purchase-payment-report' ? 'active' : '' }}">@lang('lang_v1.purchase_payment_report')</a>

		<a href="{{ action('ReportController@sellPaymentReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'sell-payment-report' ? 'active' : '' }}">@lang('lang_v1.sell_payment_report')</a>
	@endcan

	@if(in_array('expenses', $enabled_modules))
		@can('expense_report.view')
			<a href="{{ action('ReportController@getExpenseReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'expense-report' ? 'active' : '' }}">@lang('report.expense_report')</a>
		@endcan
	@endif

	@can('register_report.view')
	<a href="{{ action('ReportController@getRegisterReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'register-report' ? 'active' : '' }}">@lang('report.register_report')</a>
	@endcan

	@can('sales_representative.view')
	<a href="{{ action('ReportController@getSalesRepresentativeReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'sales-representative-report' ? 'active' : '' }}">@lang('report.sales_representative')</a>
	@endcan

	@if(in_array('tables', $enabled_modules))
		@can('purchase_n_sell_report.view')
			<a href="{{ action('ReportController@getTableReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'table-report' ? 'active' : '' }}">@lang('restaurant.table_report')</a>
		@endcan
	@endif

	@if(in_array('service_staff', $enabled_modules))
		@can('sales_representative.view')
			<a href="{{ action('ReportController@getServiceStaffReport') }}" class="{{ $link_class }} {{ request()->segment(2) == 'service-staff-report' ? 'active' : '' }}">@lang('restaurant.service_staff_report')</a>
		@endcan
	@endif

	@if($is_admin)
		<a href="{{ action('ReportController@activityLog') }}" class="{{ $link_class }} {{ request()->segment(2) == 'activity-log' ? 'active' : '' }}">@lang('lang_v1.activity_log')</a>
	@endif
