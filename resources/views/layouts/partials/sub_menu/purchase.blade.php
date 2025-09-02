@php
	$is_mobile = isMobile();
    $common_settings = !empty(session('business.common_settings')) ? session('business.common_settings') : [];
    $link_class = $link_class ?? ''; 
@endphp

@if(auth()->user()->can('purchase.view') || auth()->user()->can('view_own_purchase'))
<a href="{{ action('PurchaseController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'purchases' && request()->segment(2) == null ? 'active' : '' }}">@lang('purchase.purchases')</a>
@endif

@can('purchase.update')
<a href="{{ action('PurchaseReturnController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'purchase-return' ? 'active' : '' }}">@lang('lang_v1.purchase_return')</a>
@endcan

@if(!empty($common_settings['enable_purchase_order']) && (auth()->user()->can('purchase_order.view_all') || auth()->user()->can('purchase_order.view_own')))
<a href="{{ action('PurchaseOrderController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'purchase-order' ? 'active' : '' }}">@lang('lang_v1.purchase_order')</a>
@endif

@if(!empty($common_settings['enable_purchase_requisition']) && (auth()->user()->can('purchase_requisition.view_all') || auth()->user()->can('purchase_requisition.view_own'))) 
<a href="{{ action([\App\Http\Controllers\PurchaseRequisitionController::class, 'index']) }}" class="{{ $link_class }} {{ request()->segment(1) == 'purchase-requisition' ? 'active' : '' }}">@lang('lang_v1.purchase_requisition')</a>
@endif
