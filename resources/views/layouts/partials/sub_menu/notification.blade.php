@php
  $link_class = $link_class ?? ''; 
@endphp
@can('send_notifications')
<a href="{{ action('NotificationTemplateController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'notification-templates' && !request()->input('page') ? 'active' : '' }}">@lang('lang_v1.notifications')</a>
<a href="{{ action('NotificationTemplateController@index', 'page=customer') }}" class="{{ $link_class }} {{ request()->input('page') == 'customer' ? 'active' : '' }}">@lang('lang_v1.customer_notifications')</a>
<a href="{{ action('NotificationTemplateController@index', 'page=supplier') }}" class="{{ $link_class }} {{ request()->input('page') == 'supplier' ? 'active' : '' }}">@lang('lang_v1.supplier_notifications')</a>
<a href="{{ action('NotificationTemplateController@index', 'page=auto') }}" class="{{ $link_class }} {{ request()->input('page') == 'auto' ? 'active' : '' }}">@lang('lang_v1.auto_message_settings')</a>
@endcan