@php
$is_mobile = isMobile();
@endphp
@if(!$is_mobile)
@if($tables_enabled)
<div class="col-sm-3 col-xs-6 col-md-3">
    <div class="form-group">
        <label for="res_table_id" id="label_table">{{ __('restaurant.select_table') }}:</label> 
        {!! Form::select('res_table_id', $tables, $view_data['res_table_id'], ['class' => 'form-control', 'placeholder' => __('restaurant.select_table')]); !!}
    </div>
</div>
@endif

@if($waiters_enabled)
<div class="col-sm-3 col-xs-6 col-md-3">
    <div class="form-group">
        <label for="res_waiter_id" id="label_waiter">{{ __('restaurant.select_service_staff') }}:</label> 
        {!! Form::select('res_waiter_id', $waiters, $view_data['res_waiter_id'], ['class' => 'form-control', 'placeholder' => __('restaurant.select_service_staff'), 'id' => 'res_waiter_id', 'required' => $is_service_staff_required ? true : false]); !!}
        
        @if(!empty($pos_settings['inline_service_staff']))
        <button type="button" class="btn btn-default bg-white btn-flat" id="select_all_service_staff" data-toggle="tooltip" title="@lang('lang_v1.select_same_for_all_rows')">
            <i class="fa fa-check"></i>
        </button>
        @endif
    </div>
</div>
@endif

@endif
@if($is_mobile)
@if($tables_enabled)
<div class="col-sm-4">
	<div class="form-group">
	{{--	{!! Form::label('restaurant.select_table', __('lang_v1.select_table') . ':') !!} --}}
		{!! Form::select('res_table_id', $tables, $view_data['res_table_id'], ['class' => 'form-control', 'placeholder' => __('restaurant.select_table')]); !!}
	</div>
</div>
@endif
@if($waiters_enabled)
<div class="col-sm-6">
	<div class="form-group">
		<div class="input-group">
		{{--{!! Form::label('select_service_staff', __('restaurant.select_service_staff') . ':') !!} --}}
			{!! Form::select('res_waiter_id', $waiters, $view_data['res_waiter_id'], ['class' => 'form-control', 'placeholder' => __('restaurant.select_service_staff'), 'id' => 'res_waiter_id', 'required' => $is_service_staff_required ? true : false]); !!}
			@if(!empty($pos_settings['inline_service_staff']))
			<div class="input-group-btn">
                <button type="button" class="btn btn-default bg-white btn-flat" id="select_all_service_staff" data-toggle="tooltip" title="@lang('lang_v1.select_same_for_all_rows')"><i class="fa fa-check"></i></button>
            </div>
            @endif
		</div>
	</div>
</div>
@endif
@endif