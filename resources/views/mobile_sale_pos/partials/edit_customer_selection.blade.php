@php
$is_mobile = isMobile();
@endphp
<div class="pos-subheader-mobile" style="margin-bottom: 20px;">

	<div class="back">
		<button type="button" class="back"><img src="{{ asset('img/icons/back-icon.svg') }}" alt=""></button>
	</div>
	

	<div class="center"><h2>@lang('lang_v1.customer_info')</h2>
	
		<p>@lang('sale.invoice_no'): {{$transaction->invoice_no}}</p>
	
	</div>
	<div class=" pos-subheader-mobile pull-right">
		<button type="button" class="add_new_customer" data-name="" @if(!auth()->user()->can('customer.create')) disabled @endif> <img data-toggle="tooltip" data-placement="bottom" src="{{ asset('img/icons/add_product.svg') }}" alt=""></button>
	</div>

</div>

<div class="clearfix"></div>



	<div class="pos-filter">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<input type="hidden" id="default_customer_id"
						value="{{ $transaction->contact->id }}">
					<input type="hidden" id="default_customer_name"
						value="{{ $transaction->contact->name }}">
					<input type="hidden" id="default_customer_balance"
						value="{{$transaction->contact->balance}}">
					{!! Form::select('contact_id',
					[], null, ['class' => 'form-control mousetrap', 'id' => 'customer_id', 'placeholder' => 'Enter Customer name / phone', 'required', 'style' => 'width: 100%;']); !!}
					<small class="text-danger @if(empty($customer_due)) hide @endif contact_due_text"><strong>@lang('account.customer_due'):</strong> <span>{{$customer_due ?? ''}}</span></small>

				</div>
				<input type="hidden" name="pay_term_number" id="pay_term_number" value="{{$transaction->pay_term_number}}">
				<input type="hidden" name="pay_term_type" id="pay_term_type" value="{{$transaction->pay_term_type}}">

			</div>
			<div class="col-md-8">

			</div>

			<!-- Exchange Rate Module -->
			@moduleEnabled('CurrencyExchangeRate')
			<div class="col-sm-4">
				<select id="exchange_rate_id" class="form-control" aria-label="Exchange Rate" onchange="updateCurrencyCode()">
					<option value="">@lang('currencyexchangerate::lang.select_exchange_rate')</option>
					<option value="" disabled>@lang('lang_v1.local_foreign')</option>
					@foreach($exchangeRates as $rate)
					<option value="{{ $rate->id }}"
						data-exchange-currency-id="{{ $rate->id }}" data-rate="{{ $rate->exchange_rate }}" data-target-code="{{ $rate->targetCurrency->code }}" data-target-id="{{ $rate->targetCurrency->id }}" {{ $rate->id == $selected_exchange_rate_id ? 'selected' : '' }}>
						{{ $rate->baseCurrency->code }}({{ $rate->baseCurrency->symbol }}) - {{ $rate->targetCurrency->code }}({{ $rate->targetCurrency->symbol }})
					</option>
					@endforeach
				</select>
			</div>
			<div class="col-sm-4">
				{!! Form::text('currency_exchange_rate', $transaction->exchangeRate->exchange_rate ?? null, ['class' => 'form-control', 'id' => 'currency_exchange_rate', 'placeholder' => __('currencyexchangerate::lang.select_exchange_rate'), 'readonly' => 'readonly']) !!}
				{!! Form::hidden('exchange_currency_id', $selected_exchange_rate_id, ['id' => 'exchange_currency_id', 'readonly' => 'readonly']) !!}
			</div>
			@endmoduleEnabled
			@if(!empty($transaction->selling_price_group_id))
			<div class="col-sm-4">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fas fa-money-bill-alt"></i>
						</span>
						{!! Form::hidden('price_group', $transaction->selling_price_group_id, ['id' => 'price_group']) !!}
						{!! Form::text('price_group_text', $transaction->price_group->name, ['class' => 'form-control', 'readonly']); !!}
						<span class="input-group-addon">
							@show_tooltip(__('lang_v1.price_group_help_text'))
						</span>
					</div>
				</div>
			</div>
			@endif

			@if( $restaurant_settings['enable_restaurant_module'] == "1" && $restaurant_settings['enable_order_type'] == "1")
			<div class="col-sm-4">
				<div class="form-group">
					$attributes = [
					'class' => 'form-control',
					'placeholder' => __('lang_v1.select_order_type'),
				];
					{!! Form::select('order_type', $order_type, $selected_order_type, $attributes) !!}
				</div>
			</div>
			@endif

			@if(in_array('types_of_service', $enabled_modules) && !empty($transaction->types_of_service))
			<div class="col-sm-4">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fas fa-external-link-square-alt text-primary service_modal_btn"></i>
						</span>
						{!! Form::text('types_of_service_text', $transaction->types_of_service->name, ['class' => 'form-control', 'readonly']); !!}

						{!! Form::hidden('types_of_service_id', $transaction->types_of_service_id, ['id' => 'types_of_service_id']) !!}
						<span class="input-group-addon">
							@show_tooltip(__('lang_v1.types_of_service_help'))
						</span>
					</div>
				</div>
			</div>
			<div class="modal fade types_of_service_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
				@if(!empty($transaction->types_of_service))
				@include('types_of_service.pos_form_modal', ['types_of_service' => $transaction->types_of_service])
				@endif
			</div>
			@endif

			<!-- Call restaurant module if defined -->
			@if(in_array('tables' ,$enabled_modules) || in_array('service_staff' ,$enabled_modules))
			<span id="restaurant_module_span"
				data-transaction_id="{{$transaction->id}}">
				<div class="col-sm-4"></div>
			</span>
			@endif

			@if(!empty($commission_agent))
			@php
			$is_commission_agent_required = !empty($pos_settings['is_commission_agent_required']);
			@endphp
			<div class="col-sm-4">
				<div class="form-group">
					{!! Form::select('commission_agent',
					$commission_agent, $transaction->commission_agent, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.commission_agent'), 'id' => 'commission_agent', 'required' => $is_commission_agent_required]); !!}
				</div>
			</div>
			@endif

			@if(!empty($pos_settings['show_invoice_layout']))
			<div class="col-sm-4">
				<div class="form-group">
					{!! Form::select('invoice_layout_id',
					$invoice_layouts, $transaction->location->invoice_layout_id, ['class' => 'form-control select2', 'placeholder' => __('lang_v1.select_invoice_layout'), 'id' => 'invoice_layout_id']); !!}
				</div>
			</div>
			@endif

			@if(!empty($pos_settings['enable_transaction_date']))
			<div class="col-sm-4">
				<div class="form-group">
					{!! Form::text('transaction_date', @format_datetime($transaction->transaction_date), ['class' => 'form-control', 'readonly', 'required', 'id' => 'transaction_date']); !!}
				</div>
			</div>
			@endif
			@if(config('constants.enable_sell_in_diff_currency') == true)
			<div class="col-sm-4">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-addon">
							<i class="fas fa-exchange-alt"></i>
						</span>
						{!! Form::text('exchange_rate', @num_format($transaction->exchange_rate), ['class' => 'form-control input-sm input_number', 'placeholder' => __('lang_v1.currency_exchange_rate'), 'id' => 'exchange_rate']); !!}
					</div>
				</div>
			</div>
			@endif

			@if($transaction->status == 'draft' && !empty($pos_settings['show_invoice_scheme']))
			<div class="col-sm-4">
				<div class="form-group">
					{!! Form::select('invoice_scheme_id', $invoice_schemes, $default_invoice_schemes->id, ['class' => 'form-control', 'placeholder' => __('lang_v1.select_invoice_scheme')]); !!}
				</div>
			</div>
			@endif
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
	<button type="button" id="nextToProducts" class="next-button">
		<h3>@lang('lang_v1.cart')</h3>
	</button>
</div>