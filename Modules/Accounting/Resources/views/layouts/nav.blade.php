@php
$enabled_modules = !empty(session('business.enabled_modules')) ? session('business.enabled_modules') : [];
$is_mobile = isMobile();
@endphp



<div class="storys-container">
    <a class="navbar-brand" href="{{action([\Modules\Accounting\Http\Controllers\AccountingController::class, 'dashboard'])}}">
        <i class="fas fa fa-broadcast-tower"></i> {{__('accounting::lang.accounting')}}
    </a>

    @if(auth()->user()->can('accounting.manage_accounts'))
    <a href="{{action([\Modules\Accounting\Http\Controllers\CoaController::class, 'index'])}}"  class="sub-menu-item {{ request()->segment(1) == 'accounting' && request()->segment(2) == 'chart-of-accounts' ? 'active' : '' }}"> @lang('accounting::lang.chart_of_accounts')
    </a>
    @endif
    @if(auth()->user()->can('accounting.view_journal'))
    <a href="{{action([\Modules\Accounting\Http\Controllers\JournalEntryController::class, 'index'])}}" class="sub-menu-item {{ request()->segment(1) == 'accounting' && request()->segment(2) == 'journal-entry' ? 'active' : '' }}">@lang('accounting::lang.journal_entry')</a>
   @endif

   @if(auth()->user()->can('accounting.view_transfer'))
    <a href="{{action([\Modules\Accounting\Http\Controllers\TransferController::class, 'index'])}}" class="sub-menu-item {{ request()->segment(1) == 'accounting' && request()->segment(2) == 'transfer' ? 'active' : '' }}">   @lang('accounting::lang.transfer')</a>

    @endif
  
    <a href="{{action([\Modules\Accounting\Http\Controllers\TransactionController::class, 'index'])}}" class="sub-menu-item {{ request()->segment(2) == 'accounting' && request()->segment(3) == 'transactions' ? 'active' : '' }}">@lang('accounting::lang.transactions')</a>



    @if(auth()->user()->can('accounting.manage_budget'))
    <a href="{{action([\Modules\Accounting\Http\Controllers\BudgetController::class, 'index'])}}" class="sub-menu-item {{ request()->segment(1) == 'accounting' && request()->segment(2) == 'budget' ? 'active' : '' }}"> @lang('accounting::lang.budget')</a>
    @endif


    @if(auth()->user()->can('accounting.view_reports'))
    <a href="{{action([\Modules\Accounting\Http\Controllers\ReportController::class, 'index'])}}" class="sub-menu-item {{ request()->segment(1) == 'accounting' && request()->segment(2) == 'reports' ? 'active' : '' }}"> @lang('accounting::lang.reports')</a>
    @endif


    <a href="{{action([\Modules\Accounting\Http\Controllers\SettingsController::class, 'index'])}}" class="sub-menu-item {{ request()->segment(1) == 'accounting' && request()->segment(2) == 'settings' ? 'active' : '' }}">@lang('messages.settings')</a>




</div>