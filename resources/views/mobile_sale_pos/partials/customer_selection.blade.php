@php
$is_mobile = isMobile();
@endphp
<div class="pos-subheader-mobile" style="margin-bottom: 20px;">

    <div class="back">
        <button type="button" class="back"><img src="{{ asset('img/icons/back-icon.svg') }}" alt=""></button>
    </div>

    <h2 class="center">@lang('lang_v1.customer_info')</h2>
    <div class=" pos-subheader-mobile pull-right">
		<button type="button" class="add_new_customer" data-name="" @if(!auth()->user()->can('customer.create')) disabled @endif> <img data-toggle="tooltip" data-placement="bottom" src="{{ asset('img/icons/add_product.svg') }}" alt=""></button>
    </div>
</div>

<div class="clearfix"></div>


<div class="pos-header">
	<div class="pos-filter">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
						<input type="hidden" id="default_customer_id" value="{{ $walk_in_customer['id'] ?? ''}}">
						<input type="hidden" id="default_customer_name" value="{{ $walk_in_customer['name'] ?? ''}}">
						<input type="hidden" id="default_customer_balance" value="{{ $walk_in_customer['balance'] ?? ''}}">
						<input type="hidden" id="default_customer_address" value="{{ $walk_in_customer['shipping_address'] ?? ''}}">
						@if(!empty($walk_in_customer['price_calculation_type']) && $walk_in_customer['price_calculation_type'] == 'selling_price_group')
						<input type="hidden" id="default_selling_price_group" value="{{ $walk_in_customer['selling_price_group_id'] ?? ''}}">
						@endif
						{!! Form::select('contact_id',
						[], null, ['class' => 'form-control mousetrap', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone', 'required', 'style' => 'width: 100%;']); !!}
						
					
					<small class="text-danger hide contact_due_text"><strong>@lang('account.customer_due'):</strong> <span></span></small>
				</div>
				<input type="hidden" name="pay_term_number" id="pay_term_number" value="{{$walk_in_customer['pay_term_number'] ?? ''}}">
				<input type="hidden" name="pay_term_type" id="pay_term_type" value="{{$walk_in_customer['pay_term_type'] ?? ''}}">
			</div>
			<div class="col-md-8">

			</div>
	
			<!-- Exchange Rate Module -->
			@if(empty($pos_settings['disable_currency_exchange']))
			@moduleEnabled('CurrencyExchangeRate')
			{{--{!! Form::label('select_exchange_rate', __('lang_v1.select_exchange_rate') . ':') !!} --}}
			<div class="col-sm-3 col-xs-6 col-md-3">
				<div class="form-group">
					<select id="exchange_rate_id" class="form-control" aria-label="Exchange Rate" onchange="updateCurrencyCode()">
						<option value="" selected>@lang('currencyexchangerate::lang.select_exchange_rate')</option>
						<option value="" disabled>@lang('lang_v1.local_foreign')</option>
						@foreach($exchangeRates as $rate)
						<option value="{{ $rate->id }}" data-exchange-currency-id="{{ $rate->id }}" data-rate="{{ $rate->exchange_rate }}" data-target-code="{{ $rate->targetCurrency->code }}" data-target-id="{{ $rate->targetCurrency->id }}">
							{{ $rate->baseCurrency->code }}({{ $rate->baseCurrency->symbol }}) - {{ $rate->targetCurrency->code }}({{ $rate->targetCurrency->symbol }})
						</option>
						@endforeach
					</select>
				</div>
			</div>
			<div class="col-sm-3 col-xs-6 col-md-3">
				<div class="form-group">
					{!! Form::text('currency_exchange_rate', null, ['class' => 'form-control', 'id' => 'currency_exchange_rate', 'placeholder' => __('currencyexchangerate::lang.select_exchange_rate'), 'readonly' => 'readonly']) !!}
					{!! Form::hidden('exchange_currency_id', null, ['id' => 'exchange_currency_id', 'readonly' => 'readonly']) !!}

				</div>
			</div>
			@endmoduleEnabled
			@endif
			@if(!empty($price_groups) && count($price_groups) > 1)
			<div class="col-sm-4">
				<div class="form-group">
				{{--{!! Form::label('price_group', __('lang_v1.price_group') . ':') !!} --}}
					@php
					reset($price_groups);
					$selected_price_group = !empty($default_price_group_id) && array_key_exists($default_price_group_id, $price_groups) ? $default_price_group_id : null;
					@endphp
					{!! Form::hidden('hidden_price_group', key($price_groups), ['id' => 'hidden_price_group']) !!}
					{!! Form::select('price_group', $price_groups, $selected_price_group, ['class' => 'form-control select2', 'id' => 'price_group']); !!}
				</div>
			</div>
			@else
			@php
			reset($price_groups);
			@endphp
			{!! Form::hidden('price_group', key($price_groups), ['id' => 'price_group']) !!}
			@endif
			@if(!empty($default_price_group_id))
			{!! Form::hidden('default_price_group', $default_price_group_id, ['id' => 'default_price_group']) !!}
			@endif

			@if( $restaurant_settings['enable_restaurant_module'] == "1" && $restaurant_settings['enable_order_type'] == "1")
			<div class="col-sm-4">
				<div class="form-group">
				{{--	{!! Form::label('select_order_type', __('lang_v1.select_order_type') . ':') !!} --}}
				@php
				$attributes = [
					'class' => 'form-control',
					'placeholder' => __('lang_v1.select_order_type'),
				];
				if (($restaurant_settings['order_type_required'] ?? 0) == "1") {$attributes['required'] = 'required';}
			@endphp
		{!! Form::select('order_type', $order_type, $default_order_type, $attributes) !!}
				</div>
			</div>
			@endif

			@if(in_array('types_of_service', $enabled_modules) && !empty($types_of_service))
			<div class="col-sm-4">
				<div class="form-group">
				{{--	{!! Form::label('select_types_of_service', __('lang_v1.select_types_of_service') . ':') !!} --}}
					<div class="input-group">
						{!! Form::select('types_of_service_id', $types_of_service, null, ['class' => 'form-control', 'id' => 'types_of_service_id', 'style' => 'width: 100%;', 'placeholder' => __('lang_v1.select_types_of_service')]); !!}
						{!! Form::hidden('types_of_service_price_group', null, ['id' => 'types_of_service_price_group']) !!}
						<span class="input-group-addon">
							<i class="fa fa-external-link-square-alt text-primary service_modal_btn"></i>
						</span>
					</div>
				</div>
			</div>
			<div class="modal fade types_of_service_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" id="pospackingModal"></div>
			@endif

			<!-- Call restaurant module if defined -->
			@if(in_array('tables' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules))
			<span id="restaurant_module_span">
			</span>
			@endif

			@if(!empty($commission_agent))
			@php
			$is_commission_agent_required = !empty($pos_settings['is_commission_agent_required']);
			@endphp
			<div class="col-sm-4">
				<div class="form-group">
				{{--	{!! Form::label('commission_agent', __('lang_v1.commission_agent') . ':') !!} --}}
					{!! Form::select('commission_agent',
					$commission_agent, null, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.commission_agent'), 'id' => 'commission_agent', 'required' => $is_commission_agent_required]); !!}
				</div>
			</div>
			@endif

			@if(!empty($pos_settings['show_invoice_layout']))
			<div class="col-sm-4">
				<div class="form-group">
				{{--	{!! Form::label('select_invoice_layout', __('lang_v1.select_invoice_layout') . ':') !!} --}}
					{!! Form::select('invoice_layout_id',
					$invoice_layouts, $default_location->invoice_layout_id, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.select_invoice_layout'), 'id' => 'invoice_layout_id']); !!}
				</div>
			</div>
			@endif

			@if(!empty($pos_settings['enable_transaction_date']))
			<div class="col-sm-4">
			{{--{!! Form::label('transaction_date', __('lang_v1.transaction_date') . ':') !!} --}}
				<div class="form-group">
					{!! Form::text('transaction_date', $default_datetime, ['class' => 'form-control', 'readonly', 'required', 'id' => 'transaction_date']); !!}
				</div>
			</div>
			@endif
			@if(config('constants.enable_sell_in_diff_currency') == true)
			<div class="col-sm-4">
				<div class="form-group">
					{!! Form::text('exchange_rate', config('constants.currency_exchange_rate'), ['class' => 'form-control input-sm input_number', 'placeholder' => __('lang_v1.currency_exchange_rate'), 'id' => 'exchange_rate']); !!}
				</div>
			</div>
			@endif

			@if(!empty($pos_settings['show_invoice_scheme']))
			<div class="col-sm-4">
				<div class="form-group">
				{{--	{!! Form::label('select_invoice_scheme', __('lang_v1.select_invoice_scheme') . ':') !!} --}}
					{!! Form::select('invoice_scheme_id', $invoice_schemes, $default_invoice_schemes->id, ['class' => 'form-control', 'placeholder' => __('lang_v1.select_invoice_scheme')]); !!}
				</div>
			</div>
			@endif
		</div>
	</div>
</div>
<!-- include module fields -->
@if(!empty($pos_module_data))
@foreach($pos_module_data as $key => $value)
@if(!empty($value['view_path']))
@includeIf($value['view_path'], ['view_data' => $value['view_data']])
@endif
@endforeach
@endif
<div class="mobile-pos-footer">
<button type="button" id="nextToProducts" class="next-button"><h3>@lang('lang_v1.cart')</h3></button>
</div>