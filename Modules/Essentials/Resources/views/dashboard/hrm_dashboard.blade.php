@extends('layouts.app')
@section('title', __('essentials::lang.hrm'))

@section('content')
<div class="main-container">

	<!-- Sub Menu -->
	<div class="horizontal-scroll">
		@include('essentials::layouts.nav_hrm')
	</div>

	<!-- Card Wrapper for dashboard content -->
	<div class="setting-card-wrapper">
		<!-- Filter through table -->
		<div class="overview-filter">
			<div class="title">
				<h1>{{__('essentials::lang.hrm')}}</h1>
				<p>Overview</p>
			</div>
		</div>

		<!-- CRM Data Wrapper -->
		<div class="crm-data-wrapper">
			<div class="crm-data-item">
				<h4>@lang('essentials::lang.target_achieved_last_month')</h4>

				<div class="data-numbers">
					<h2>@format_currency($target_achieved_last_month)</h2>

					<div class="data-growth">
						{{--<span>0</span>--}}
						<img src="{{ asset('img/icons/growth.svg') }}" alt="">
					</div>
				</div>
			</div>

			<div class="crm-data-item">
				<h4>@lang('essentials::lang.target_achieved_this_month')</h4>

				<div class="data-numbers">
					<h2>@format_currency($target_achieved_this_month)</h2>

					<div class="data-growth">
					{{--<span>0</span>--}}
						<img src="{{ asset('img/icons/growth.svg') }}" alt="">
					</div>
				</div>
			</div>

			<div class="crm-data-item">
				<h4>@lang('essentials::lang.targets')</h4>


				<div class="data-numbers">
					@forelse($sales_targets as $target)
					<h2>@format_currency($target->target_start)
						- @format_currency($target->target_end)</h2>
					@empty
					<h2>0</h2>
					@endforelse

					<div class="data-growth">
					{{--<span>0</span>--}}
						<img src="{{ asset('img/icons/growth.svg') }}" alt="">
					</div>
				</div>

			</div>

			<div class="crm-data-item">
				<h4>@lang('essentials::lang.commission_percent')</h4>

				<div class="data-numbers">
					@forelse($sales_targets as $target)

					<h2>{{number_format($target->commission_percent, 2)}}%</h2>
					@empty
					<h2>0</h2>
					@endforelse

					<div class="data-growth">
					{{--<span>0</span>--}}
						<img src="{{ asset('img/icons/growth.svg') }}" alt="">
					</div>
				</div>

			</div>
		</div>
	</div>


	<div class="crm-source-wrapper">
		<div class="CrmTwoGrid">
			<div class="today-birthday">
				<div class="title">
					<h5>@lang('essentials::lang.todays_attendance')</h5>
				</div>

				<table class="crm-table">
					<thead>
						<tr>
							<th>
								@lang('essentials::lang.employee')
							</th>
							<th>
								@lang('essentials::lang.clock_in')
							</th>
							<th>
								@lang('essentials::lang.clock_out')
							</th>
						</tr>
					</thead>
					<tbody>
						@forelse($todays_attendances as $attendance)
						<tr>
							<td>{{$attendance->employee->user_full_name}}</td>
							<td>
								{{@format_datetime($attendance->clock_in_time)}}

								@if(!empty($attendance->clock_in_note))
								<br><small>{{$attendance->clock_in_note}}</small>
								@endif
							</td>
							<td>
								@if(!empty($attendance->clock_out_time))
								{{@format_datetime($attendance->clock_out_time)}}
								@endif

								@if(!empty($attendance->clock_out_note))
								<br><small>{{$attendance->clock_out_note}}</small>
								@endif
							</td>
						</tr>
						@empty
						<tr>
							<td colspan="3" class="text-center">@lang('lang_v1.no_data')</td>
						</tr>
						@endforelse
					</tbody>
				</table>


			</div>

			@can('user.view')
			<div class="today-birthday">
				<div class="title">
					<h5>{{ __('user.users') }} ({{$users->count()}})</h5>
				</div>

				<table class="crm-table">
					<thead>
						<tr>
							<th>{{ __('essentials::lang.department') }}</th>
							<th>{{ __('sale.total') }}</th>
						</tr>
					</thead>
					<tbody>
						@forelse($departments as $department)
						<tr>
							<td>{{$department->name}}</td>
							<td>@if(!empty($users_by_dept[$department->id])){{count($users_by_dept[$department->id])}} @else 0 @endif</td>
						</tr>
						@empty
						<tr>
							<td colspan="2" class="text-center">@lang('lang_v1.no_data')</td>
						</tr>
						@endforelse
					</tbody>
				</table>
			</div>
			@endcan
		</div>
	</div>

	<div class="crm-source-wrapper">
		<div class="CrmTwoGrid">
			@can('essentials.approve_leave')

			<div class="today-birthday">
				<div class="title">
					<h5>@lang('essentials::lang.leaves')</h5>
				</div>
				<table class="crm-table">
					<tr>
						<th class="bg-light-gray" colspan="2">@lang('home.today')</th>
					</tr>
					@forelse($todays_leaves as $leave)
					<tr>
						<td>
							{{@format_date($leave->start_date)}}
							- {{@format_date($leave->end_date)}}
						</td>
						<td>
							{{$leave->leave_type->leave_type}}
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="2" class="text-center">
							@lang('lang_v1.no_data')
						</td>
					</tr>
					@endforelse
					<tr>
						<td colspan="2">&nbsp;</td>
					</tr>
					<tr>
						<th class="bg-light-gray" colspan="2">@lang('lang_v1.upcoming')</th>
					</tr>
					@forelse($upcoming_leaves as $leave)
					<tr>
						<td>
							{{@format_date($leave->start_date)}}
							- {{@format_date($leave->end_date)}}
						</td>
						<td>
							{{$leave->leave_type->leave_type}}
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="3" class="text-center">
							@lang('lang_v1.no_data')
						</td>
					</tr>
					@endforelse
				</table>
				@endcan
			</div>


			<div class="coming-birthday">
				@if(!$is_admin)
				@include('essentials::dashboard.holidays')
				@endif
			</div>
		</div>
	</div>

	<div class="crm-source-wrapper">
		<div class="row">
			<div class="col-md-12">
				<div class="overview-filter">
					<div class="title">
						<p style="font-weight: bold;">@lang('essentials::lang.sales_targets')</p>
					</div>
				</div>

				<table class="crm-table" id="sales_targets_table" style="width: 100%;">
					<thead>
						<tr>
							<th>@lang('report.user')</th>
							<th>@lang('essentials::lang.target_achieved_last_month')</th>
							<th>@lang('essentials::lang.target_achieved_this_month')</th>
						</tr>
					</thead>
				</table>
			</div>


		</div>
	</div>

</div>

<!-- Main content -->


@stop
@section('javascript')
<script type="text/javascript">
	$(document).ready(function() {
		if ($('#sales_targets_table').length) {
			var sales_targets_table = $('#sales_targets_table').DataTable({
				processing: true,
				serverSide: true,
				searching: false,
				scrollY: "75vh",
				scrollX: true,
				scrollCollapse: true,
				dom: 'Btirp',
				fixedHeader: false,
				ajax: "{{action([\Modules\Essentials\Http\Controllers\DashboardController::class, 'getUserSalesTargets'])}}"
			});
		}
	});
</script>
@endsection