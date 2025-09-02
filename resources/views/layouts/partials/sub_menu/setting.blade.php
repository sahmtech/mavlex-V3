@php
	$enabled_modules = !empty(session('business.enabled_modules')) ? session('business.enabled_modules') : [];
	$link_class = $link_class ?? ''; 
@endphp
<button class="btn-scroll" data-toggle="tooltip" data-placement="bottom" title="@lang( 'lang_v1.go_back' )">
	<a href="{{ action('BusinessController@getSettings') }}">
        <img src="{{ asset('img/icons/back-icon.svg') }}" alt="">
    </a>
</button>




	<!-- @canany('business_settings.access' | 'barcode_settings.access', 'invoice_settings.access', 'tax_rate.view', 'tax_rate.create', 'access_package_subscriptions', '')
	<a href="{{ action('BusinessController@getSettings') }}" class="{{ $link_class }} {{ request()->segment(1) == 'business' ? 'active' : '' }}">@lang('business.business_settings')</a>

	<a href="{{ action('BusinessLocationController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'business-location' ? 'active' : '' }}">@lang('business.business_locations')</a>
	@endcanany

	@canany('barcode_settings.access')
	<a href="{{ action('BarcodeController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'barcodes' ? 'active' : '' }}">@lang('barcode.barcode_settings')</a>
	@endcanany

	@canany('access_printers')
	<a href="{{ action('PrinterController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'printers' ? 'active' : '' }}">@lang('printer.receipt_printers')</a>
	@endcanany

	

	@if(in_array('tables', $enabled_modules))
		@canany('access_tables')
			<a href="{{ action('Restaurant\TableController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'modules' && request()->segment(2) == 'tables' ? 'active' : '' }}">@lang('restaurant.tables')</a>
		@endcanany
	@endif

	@if(in_array('modifiers', $enabled_modules))
		@canany('product.create', 'product.view')
			<a href="{{ action('Restaurant\ModifierSetsController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'modules' && request()->segment(2) == 'modifiers' ? 'active' : '' }}">@lang('restaurant.modifiers')</a>
		@endcanany
	@endif


	@can('send_notifications')
		<a href="{{ action('NotificationTemplateController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'notification-templates' ? 'active' : '' }}">@lang('lang_v1.notification_templates')</a>
	@endcan -->


