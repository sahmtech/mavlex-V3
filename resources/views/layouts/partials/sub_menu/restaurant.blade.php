@php
	$enabled_modules = !empty(session('business.enabled_modules')) ? session('business.enabled_modules') : [];
    $link_class = $link_class ?? ''; 
@endphp


@if(in_array('booking', $enabled_modules) && (auth()->user()->can('crud_all_bookings') || auth()->user()->can('crud_own_bookings')))
<a href="{{ action('Restaurant\BookingController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'bookings' ? 'active' : '' }}">@lang('restaurant.bookings')</a>
@endif


@if(in_array('kitchen', $enabled_modules))
<a href="{{ action('Restaurant\KitchenController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'modules' && request()->segment(2) == 'kitchen' ? 'active' : '' }}">@lang('restaurant.kitchen')</a>
@endif


@if(in_array('service_staff', $enabled_modules))
<a href="{{ action('Restaurant\OrderController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'modules' && request()->segment(2) == 'orders' ? 'active' : '' }}">@lang('restaurant.orders')</a>
@endif


@if(in_array('tables', $enabled_modules))
<a href="{{ action('Restaurant\TableController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'modules' && request()->segment(2) == 'tables' ? 'active' : '' }}">@lang('restaurant.tables')</a>
@endif

@if(in_array('modifiers', $enabled_modules))
<a href="{{ action('Restaurant\ModifierSetsController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'modules' && request()->segment(2) == 'modifiers' ? 'active' : '' }}">@lang('restaurant.modifiers')</a>
@endif
