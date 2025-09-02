@extends('layouts.app')
@section('title', __('superadmin::lang.superadmin') . ' | ' . __('superadmin::lang.packages'))

@section('content')



<!-- Main content -->
<section class="content">
<div class="main-container no-print">
                
    <!-- Sub Menu -->
   
    <div class="horizontal-scroll">
    @include('superadmin::layouts.nav')
    </div>
    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
	<h1>@lang('superadmin::lang.packages') </h1><p>@lang('superadmin::lang.edit_package')</p>
    


	{!! Form::open(['route' => ['packages.update', $packages->id], 'method' => 'put', 'id' => 'edit_package_form']) !!}
	<div class="box box-solid">
		<div class="box-body">

	    	<div class="row">
				
				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('name', __('lang_v1.name').':') !!}
						{!! Form::text('name',$packages->name, ['class' => 'form-control', 'required']); !!}
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('description', __('superadmin::lang.description').':') !!}
						{!! Form::text('description', $packages->description, ['class' => 'form-control', 'required']); !!}
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('location_count', __('superadmin::lang.location_count').':') !!}
						{!! Form::number('location_count', $packages->location_count, ['class' => 'form-control', 'required', 'min' => 0]); !!}

						<span class="help-block">
							@lang('superadmin::lang.infinite_help')
						</span>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('user_count', __('superadmin::lang.user_count').':') !!}
						{!! Form::number('user_count', $packages->user_count, ['class' => 'form-control', 'required', 'min' => 0]); !!}

						<span class="help-block">
							@lang('superadmin::lang.infinite_help')
						</span>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('product_count', __('superadmin::lang.product_count').':') !!}
						{!! Form::number('product_count', $packages->product_count, ['class' => 'form-control', 'required', 'min' => 0]); !!}

						<span class="help-block">
							@lang('superadmin::lang.infinite_help')
						</span>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('invoice_count', __('superadmin::lang.invoice_count').':') !!}
						{!! Form::number('invoice_count', $packages->invoice_count, ['class' => 'form-control', 'required', 'min' => 0]); !!}

						<span class="help-block">
							@lang('superadmin::lang.infinite_help')
						</span>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('interval', __('superadmin::lang.interval').':') !!}

						{!! Form::select('interval', $intervals, $packages->interval, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); !!}
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('interval_count	', __('superadmin::lang.interval_count').':') !!}
						{!! Form::number('interval_count', $packages->interval_count, ['class' => 'form-control', 'required']); !!}
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('trial_days	', __('superadmin::lang.trial_days').':') !!}
						{!! Form::number('trial_days', $packages->trial_days, ['class' => 'form-control', 'required', 'min' => 0]); !!}
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('price', __('superadmin::lang.price').':') !!}
						{!! Form::text('price', $packages->price, ['class' => 'form-control input_number', 'required']); !!}
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('sort_order	', __('superadmin::lang.sort_order').':') !!}
						{!! Form::number('sort_order', $packages->sort_order, ['class' => 'form-control', 'required']); !!}
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-6">
					<div class="form-group">
						<p>{{ __('superadmin::lang.private_superadmin_only') }}</p>
						<div class="toggle-wrapper d-flex gap-2 mt-4">
							<label class="switch" for="is_private">
								{!! Form::checkbox('is_private', 1, $packages->is_private, ['id' => 'is_private']) !!}
								<div class="sliderCheckbox round"></div>
							</label>
						</div>
					</div>
				</div>
				
				<div class="col-sm-6">
					<div class="form-group">
						<p>{{ __('superadmin::lang.one_time_only_subscription') }}</p>
						<div class="toggle-wrapper d-flex gap-2 mt-4">
							<label class="switch" for="is_one_time">
								{!! Form::checkbox('is_one_time', 1, $packages->is_one_time, ['id' => 'is_one_time']) !!}
								<div class="sliderCheckbox round"></div>
							</label>
						</div>
					</div>
				</div>
				
				<div class="clearfix"></div>
				
				<div class="col-sm-4">
					<div class="form-group">
						<p>{{ __('superadmin::lang.enable_custom_subscription_link') }}</p>
						<div class="toggle-wrapper d-flex gap-2 mt-4">
							<label class="switch" for="enable_custom_link">
								{!! Form::checkbox('enable_custom_link', 1, $packages->enable_custom_link, ['id' => 'enable_custom_link']) !!}
								<div class="sliderCheckbox round"></div>
							</label>
						</div>
					</div>
				</div>
				
				<div id="custom_link_div" @if(empty($packages->enable_custom_link)) class="hide" @endif>
					<div class="col-sm-4">
						<div class="form-group">
							{!! Form::label('custom_link', __('superadmin::lang.custom_link').':') !!}
							{!! Form::text('custom_link', $packages->custom_link, ['class' => 'form-control']); !!}
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							{!! Form::label('custom_link_text', __('superadmin::lang.custom_link_text').':') !!}
							{!! Form::text('custom_link_text', $packages->custom_link_text, ['class' => 'form-control']); !!}
						</div>
					</div>
				</div>
				<div class="clearfix"></div>

				@foreach($permissions as $module => $module_permissions)
					@foreach($module_permissions as $permission)
					@php
						$value = isset($packages->custom_permissions[$permission['name']]) ? $packages->custom_permissions[$permission['name']] : false;
					@endphp
					    <div class="col-sm-3">
                        @if(isset($permission['field_type']) && in_array($permission['field_type'], ['number', 'input']))
						<div class="form-group">
							{!! Form::label("custom_permissions[$permission[name]]", $permission['label'].':') !!} 
                            @if(isset($permission['tooltip']))
                                @show_tooltip($permission['tooltip'])
                            @endif
                            
							{!! Form::text("custom_permissions[$permission[name]]", $value, ['class' => 'form-control', 'type' => $permission['field_type']]); !!} 
						</div>
                        @else
                        <div class="form-group">
							<p>{{ $permission['label'] }}</p>
							<div class="toggle-wrapper d-flex gap-2 mt-4">
								<label class="switch" for="custom_permissions_{{ $permission['name'] }}">
									{!! Form::checkbox("custom_permissions[{$permission['name']}]", 1, $value, ['id' => 'custom_permissions_'.$permission['name']]) !!}
									<div class="sliderCheckbox round"></div>
								</label>
							</div>
						</div>
						
                        @endif
					</div>
					@endforeach
				@endforeach

				<div class="col-sm-3">
					<div class="form-group">
						<p>{{ __('superadmin::lang.is_active') }}</p>
						<div class="toggle-wrapper d-flex gap-2 mt-4">
							<label class="switch" for="is_active">
								{!! Form::checkbox('is_active', 1, $packages->is_active, ['id' => 'is_active']) !!}
								<div class="sliderCheckbox round"></div>
							</label>
						</div>
					</div>
				</div>
				
				<div class="col-sm-3">
					<div class="form-group">
						<p>{{ __('superadmin::lang.mark_package_as_popular') }}</p>
						<div class="toggle-wrapper d-flex gap-2 mt-4">
							<label class="switch" for="mark_package_as_popular">
								{!! Form::checkbox('mark_package_as_popular', 1, $packages->mark_package_as_popular, ['id' => 'mark_package_as_popular']) !!}
								<div class="sliderCheckbox round"></div>
							</label>
						</div>
					</div>
				</div>
				
				<div class="col-sm-3">
					<div class="form-group">
						{!! Form::label('price', __('superadmin::lang.only_for_businesses').':') !!}
						@show_tooltip(__('superadmin::lang.tooltip_only_for_businesses'))
                        {!! Form::select('businesses[]', $businesses, json_decode($packages->businesses), [
                            'class' => 'form-control select2',
                            'multiple',
                        ]) !!}
					</div>
				</div>	
				<div class="clearfix"></div>
				<div class="col-sm-4">
					<div class="form-group">
						<p>{{ __('superadmin::lang.update_existing_subscriptions') }} @show_tooltip(__('superadmin::lang.update_existing_subscriptions_tooltip'))</p>
						<div class="toggle-wrapper d-flex gap-2 mt-4">
							<label class="switch" for="update_subscriptions">
								{!! Form::checkbox('update_subscriptions', 1, false, ['id' => 'update_subscriptions']) !!}
								<div class="sliderCheckbox round"></div>
							</label>
						</div>
					</div>
				</div>
				
			</div>

			<div class="row text-center">
					<button type="submit" class="btn btn-primary btn-big">@lang('messages.save')</button>
			</div>

		</div>
	</div>

	{!! Form::close() !!}
	</div>
</div>
</section>

@endsection

@section('javascript')
	<script type="text/javascript">
		$(document).ready(function(){
			$('form#edit_package_form').validate();
		});
		$('#enable_custom_link').on('change', function() {
    $('div#custom_link_div').toggleClass('hide', ! this.checked);
});

	</script>
@endsection