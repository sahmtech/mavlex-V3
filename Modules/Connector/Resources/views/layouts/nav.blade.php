<div class='storys-container'>

@can('superadmin')
<a href="{{ action([\Modules\Connector\Http\Controllers\ClientController::class, 'index']) }}" class="sub-menu-item {{ request()->segment(1) == 'connector' ? 'active' : '' }}">@lang('connector::lang.clients')</a>
@endcan
<a href="{{ url('/docs') }}" class="sub-menu-item">@lang('connector::lang.documentation')</a>

</div>