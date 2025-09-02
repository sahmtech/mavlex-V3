@php
	$enabled_modules = !empty(session('business.enabled_modules')) ? session('business.enabled_modules') : [];
	$link_class = $link_class ?? ''; 
@endphp

@if(in_array('account', $enabled_modules))
	@can('account.access')
		<a href="{{ action('AccountController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'account' && request()->segment(2) == 'account' ? 'active' : '' }}">@lang('account.list_accounts')</a>

		<a href="{{ action('AccountReportsController@balanceSheet') }}" class="{{ $link_class }} {{ request()->segment(1) == 'account' && request()->segment(2) == 'balance-sheet' ? 'active' : '' }}">@lang('account.balance_sheet')</a>

		<a href="{{ action('AccountReportsController@trialBalance') }}" class="{{ $link_class }} {{ request()->segment(1) == 'account' && request()->segment(2) == 'trial-balance' ? 'active' : '' }}">@lang('account.trial_balance')</a>

		<a href="{{ action('AccountController@cashFlow') }}" class="{{ $link_class }} {{ request()->segment(1) == 'account' && request()->segment(2) == 'cash-flow' ? 'active' : '' }}">@lang('lang_v1.cash_flow')</a>
	@endcan
@endif