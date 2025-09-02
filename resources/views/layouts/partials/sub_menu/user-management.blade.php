@php
  $link_class = $link_class ?? ''; 
@endphp



@can('user.view')
<a href="{{ action('ManageUserController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'users' ? 'active' : '' }}">@lang('user.users')</a>
@endcan

@can('roles.view')
<a href="{{ action('RoleController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'roles' ? 'active' : '' }}">@lang('user.roles')</a>
@endcan

@can('user.create')
<a href="{{ action('SalesCommissionAgentController@index') }}" class="{{ $link_class }} {{ request()->segment(1) == 'sales-commission-agents' ? 'active' : '' }}">@lang('lang_v1.sales_commission_agents')</a>
@endcan
