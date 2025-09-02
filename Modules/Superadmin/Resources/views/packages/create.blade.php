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
				<h1>@lang('superadmin::lang.packages')</h1> <p>@lang('superadmin::lang.add_package')</p>
				

	<!-- Page level currency setting -->
	<input type="hidden" id="p_code" value="{{$currency->code}}">
	<input type="hidden" id="p_symbol" value="{{$currency->symbol}}">
	<input type="hidden" id="p_thousand" value="{{$currency->thousand_separator}}">
	<input type="hidden" id="p_decimal" value="{{$currency->decimal_separator}}">

	{!! Form::open(['url' => action([\Modules\Superadmin\Http\Controllers\PackagesController::class, 'store']), 'method' => 'post', 'id' => 'add_package_form']) !!}

	<div class="box box-solid">
		<div class="box-body">
			<div class="row">
				
				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('name', __('lang_v1.name').':') !!}
						{!! Form::text('name', null, ['class' => 'form-control', 'required']); !!}
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('description', __('superadmin::lang.description').':') !!}
						{!! Form::text('description', null, ['class' => 'form-control', 'required']); !!}
					</div>
				</div>

				<div class="clearfix"></div>
				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('location_count', __('superadmin::lang.location_count').':') !!}
						{!! Form::number('location_count', null, ['class' => 'form-control', 'required', 'min' => 0]); !!}

						<span class="help-block">
							@lang('superadmin::lang.infinite_help')
						</span>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('user_count', __('superadmin::lang.user_count').':') !!}
						{!! Form::number('user_count', null, ['class' => 'form-control', 'required', 'min' => 0]); !!}

						<span class="help-block">
							@lang('superadmin::lang.infinite_help')
						</span>
					</div>
				</div>
				<div class="clearfix"></div>

				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('product_count', __('superadmin::lang.product_count').':') !!}
						{!! Form::number('product_count', null, ['class' => 'form-control', 'required', 'min' => 0]); !!}

						<span class="help-block">
							@lang('superadmin::lang.infinite_help')
						</span>
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('invoice_count', __('superadmin::lang.invoice_count').':') !!}
						{!! Form::number('invoice_count', null, ['class' => 'form-control', 'required', 'min' => 0]); !!}

						<span class="help-block">
							@lang('superadmin::lang.infinite_help')
						</span>
					</div>
				</div>
				<div class="clearfix"></div>

				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('interval', __('superadmin::lang.interval').':') !!}

						{!! Form::select('interval', $intervals, null, ['class' => 'form-control select2', 'placeholder' => __('messages.please_select'), 'required']); !!}
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('interval_count	', __('superadmin::lang.interval_count').':') !!}
						{!! Form::number('interval_count', null, ['class' => 'form-control', 'required', 'min' => 1]); !!}
					</div>
				</div>
				<div class="clearfix"></div>

				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('trial_days	', __('superadmin::lang.trial_days').':') !!}
						{!! Form::number('trial_days', null, ['class' => 'form-control', 'required', 'min' => 0]); !!}
					</div>
				</div>

				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('price', __('superadmin::lang.price').':') !!}
						@show_tooltip(__('superadmin::lang.tooltip_pkg_price'))

						<div class="input-group">
							<span class="input-group-addon" id="basic-addon3"><b>{{$currency->code}} {{$currency->symbol}}</b></span>
							{!! Form::text('price', null, ['class' => 'form-control input_number', 'required']); !!}
						</div>
						<span class="help-block">
							0 = @lang('superadmin::lang.free_package')
						</span>
					</div>
				</div>
				<div class="clearfix"></div>

				<div class="col-sm-6">
					<div class="form-group">
						{!! Form::label('sort_order	', __('superadmin::lang.sort_order').':') !!}
						{!! Form::number('sort_order', 1, ['class' => 'form-control', 'required']); !!}
					</div>
				</div>

				<div class="clearfix"></div>
				<div class="col-sm-6">
					<div class="form-group">
						<p>{{ __('superadmin::lang.private_superadmin_only') }}</p>
						<div class="toggle-wrapper d-flex gap-2 mt-4">
							<label class="switch" for="is_private">
								{!! Form::checkbox('is_private', 1, false, ['id' => 'is_private']) !!}
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
								{!! Form::checkbox('is_one_time', 1, false, ['id' => 'is_one_time']) !!}
								<div class="sliderCheckbox round"></div>
							</label>
						</div>
					</div>
				</div>
				
				<div class="col-sm-4">
					<div class="form-group">
						<p>{{ __('superadmin::lang.enable_custom_subscription_link') }}</p>
						<div class="toggle-wrapper d-flex gap-2 mt-4">
							<label class="switch" for="enable_custom_link">
								{!! Form::checkbox('enable_custom_link', 1, false, ['id' => 'enable_custom_link']) !!}
								<div class="sliderCheckbox round"></div>
							</label>
						</div>
					</div>
				</div>
				
				<div id="custom_link_div" class="hide">
					<div class="col-sm-4">
						<div class="form-group">
							{!! Form::label('custom_link', __('superadmin::lang.custom_link').':') !!}
							{!! Form::text('custom_link', null, ['class' => 'form-control']); !!}
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							{!! Form::label('custom_link_text', __('superadmin::lang.custom_link_text').':') !!}
							{!! Form::text('custom_link_text', null, ['class' => 'form-control']); !!}
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
				@foreach($permissions as $module => $module_permissions)
					@foreach($module_permissions as $permission)
					<div class="col-sm-3">
                        @if(isset($permission['field_type']) && in_array($permission['field_type'], ['number', 'input']))
                        <div class="form-group">
							{!! Form::label("custom_permissions[$permission[name]]", $permission['label'].':') !!} 
                            @if(isset($permission['tooltip']))
                                @show_tooltip($permission['tooltip'])
                            @endif
                            
							{!! Form::text("custom_permissions[$permission[name]]", null, ['class' => 'form-control', 'type' => $permission['field_type']]); !!} 
						</div>
                        @else
						<div class="form-group">
							<p>{{ $permission['label'] }}</p>
							<div class="toggle-wrapper d-flex gap-2 mt-4">
								<label class="switch" for="custom_permissions_{{ $permission['name'] }}">
									{!! Form::checkbox("custom_permissions[{$permission['name']}]", 1, $permission['default'], ['id' => 'custom_permissions_'.$permission['name']]) !!}
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
								{!! Form::checkbox('is_active', 1, true, ['id' => 'is_active']) !!}
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
								{!! Form::checkbox('mark_package_as_popular', 1, false, ['id' => 'mark_package_as_popular']) !!}
								<div class="sliderCheckbox round"></div>
							</label>
						</div>
					</div>
				</div>
				
				<div class="col-sm-3">
					<div class="form-group">
						{!! Form::label('price', __('superadmin::lang.only_for_businesses').':') !!}
						@show_tooltip(__('superadmin::lang.tooltip_only_for_businesses'))
                        {!! Form::select('businesses[]', $businesses, '', [
                            'class' => 'form-control select2',
                            'multiple',
                        ]) !!}
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
			$('form#add_package_form').validate();
		});
		$('#enable_custom_link').on('change', function() {
    $('div#custom_link_div').toggleClass('hide', ! this.checked);
});

	</script>
@endsection