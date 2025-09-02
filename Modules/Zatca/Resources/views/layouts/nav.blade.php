
<div class="storys-container">
<a class="navbar-brand">
        <i class=" fas fa-sync"></i> {{__('zatca::lang.zatca')}}
    </a>
    @can('zatca.sync_report')
    <a href="{{ route('zatca.sync_report') }}"  class="sub-menu-item {{ request()->segment(1) == 'zatca' && request()->segment(2) == 'sync-report' ? 'active' : '' }}"> @lang('zatca::lang.sync_report')
    </a>
    @endcan
    @can('zatca.tax_report')
    <a href="{{ route('zatca.tax_report') }}"  class="sub-menu-item {{ request()->segment(1) == 'zatca' && request()->segment(2) == 'tax-report' ? 'active' : '' }}"> @lang('zatca::lang.zatca_tax_report')
    </a>
    @endcan
    @can('zatca.settings')
    <a href="{{ route('zatca.settings') }}"  class="sub-menu-item {{ request()->segment(1) == 'zatca' && request()->segment(2) == 'settings'  ? 'active' : '' }}"> @lang('lang_v1.settings')
    </a>
    @endcan
</div>