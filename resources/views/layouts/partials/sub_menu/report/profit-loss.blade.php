@php
	$enabled_modules = !empty(session('business.enabled_modules')) ? session('business.enabled_modules') : [];
	$is_admin = auth()->user()->hasRole('Admin#' . session('business.id')) ? true : false;
	$link_class = $link_class ?? ''; 
@endphp



	@canany('profit_loss_report.view')
	<a href="{{ action('ReportController@getProfitLoss') }}" class="{{ $link_class }} {{ request()->segment(2) == 'profit-loss' ? 'active' : '' }}">@lang('report.profit_loss')</a>
	@endcanany
