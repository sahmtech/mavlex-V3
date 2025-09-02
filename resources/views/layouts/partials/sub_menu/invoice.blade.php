@php
	$enabled_modules = !empty(session('business.enabled_modules')) ? session('business.enabled_modules') : [];
    $link_class = $link_class ?? ''; 
@endphp




@canany(['draft.view_all', 'draft.view_own'])
        <a href="{{ action('SellController@index') }}" 
           class="{{ $link_class }} {{ (request()->segment(1) == 'sells' && (request()->segment(2) === null || request()->segment(2) == 'create')) ? 'active' : '' }}">
            @lang('lang_v2.invoices')
        </a>
    @endcanany

@can('direct_sell.access')
<a href="{{ action('SellController@getPayments') }}" class="{{ $link_class }} {{ request()->segment(1) == 'sells' && request()->segment(2) == 'payments' ? 'active' : '' }}">@lang('lang_v2.payments')</a>
@endcan