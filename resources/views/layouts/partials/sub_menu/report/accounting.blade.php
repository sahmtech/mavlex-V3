@php
  $link_class = $link_class ?? ''; 
@endphp
	@if(auth()->user()->can('accounting.view_reports'))
		<a href="{{action([\Modules\Accounting\Http\Controllers\ReportController::class, 'index'])}}" class="{{ $link_class }} {{ request()->segment(2) == 'reports' ? 'active' : '' }}">@lang('accounting::lang.accounting')</a>
	@endif