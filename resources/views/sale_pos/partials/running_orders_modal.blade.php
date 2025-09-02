

<style>
	.dropdown-menu {
		min-width: 120px;
	}

	.card {
		border-radius: 10px;
		height: 100%;
		position: relative;
		display: block;
		flex-direction: column;
		justify-content: space-between;
		margin-bottom: 20px;
		perspective: 1000px;
	}

	.card-inner {
		position: relative;
		width: 100%;
		height: 100%;
		text-align: center;
		transition: transform 0.6s;
		transform-style: preserve-3d;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);

	}

	.card.flipped .card-inner {
		transform: rotateY(180deg);
		width: 165px;

	}

	.card-front,
	.card-back {
		position: absolute;
		width: 100%;
		height: 100%;
		backface-visibility: hidden;
		top: 0;
		left: 0;
		border-radius: 10px;
	}

	.card-front {
		z-index: 2;
		display: flex;
		flex-direction: column;
		justify-content: center;
	}

	.card-back {
		transform: rotateY(180deg);
		padding: 1rem;
		display: none;
		flex-direction: column;
		align-items: center;
		justify-content: flex-start;
		background-color: #fff;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
	}

	.card.flipped .card-back {
		display: flex;
	}

	.card-footer {
		background-color: transparent;
		border-top: none;
		padding: 0.5rem;
	}

	.card-body {
		position: relative;
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
		padding: 1rem;
	}

	.card-body p {
		margin-bottom: 0.5rem;
	}

	.card-body .btn {
		width: 100%;
		margin-bottom: 0.5rem;
	}

	.card-body .btn:last-child {
		margin-bottom: 0;
	}

	.card:hover {
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
	}



	.card-body .mt-auto {
		margin-top: 10px;
	}

	.no-wrap {
		white-space: nowrap;
	}

	.flip-btn {
		position: absolute;
		top: 10px;
		right: 10px;
		cursor: pointer;
	}

	.hide {
		display: none;
	}

	.card-wrapper {
		display: flex;
		flex: 0 0 25%;
		max-width: 25%;
		box-sizing: border-box;
		padding: 10px;
		height: 400px;
		/* overflow-y: auto; */


	}

	@media (max-width: 1200px) {
		.card-wrapper {
			flex: 0 0 33.33%;
			max-width: 33.33%;
		}
	}

	@media (max-width: 992px) {
		.card-wrapper {
			flex: 0 0 50%;
			max-width: 50%;
		}
	}

	@media (max-width: 768px) {
		.card-wrapper {
			flex: 0 0 100%;
			max-width: 100%;
		}
	}

	.elapsed-time {
		padding: 5px;
		border-radius: 5px;
		color: white;
		display: inline-block;
	}

	.elapsed-time.green {
		background-color: green;
	}

	.elapsed-time.yellow {
		background-color: yellow;
		color: black;
	}

	.elapsed-time.orange {
		background-color: orange;
	}

	.elapsed-time.red {
		background-color: red;
	}

	.status {
		color: #333;
		background-color: #ccffcc;
		padding: 0px 15px 0px 15px;
		border-radius: 5px;
		border: 1px solid #ccc;
		font-size: 10px;
		font-weight: bold;
	}

	.bg-red {
		color: #333;
		background-color: #ffcccc;
		padding: 0px 15px 0px 15px;
		border-radius: 5px;
		border: 1px solid red;
		font-size: small;
	}
</style>

<div class="modal-dialog modal-lg" role="document">
	<div class="modal-content no-print">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>

			<h4 class="modal-title">@lang('lang_v1.running_orders')</h4>

		</div>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#new" data-toggle="tab">@lang('lang_v1.new') (<span id="new-count">0</span>)</a></li>
			<li><a href="#delayed" data-toggle="tab">@lang('lang_v1.delayed') (<span id="delayed-count">0</span>)</a></li>
			<li><a href="#old" data-toggle="tab">@lang('lang_v1.pending')(<span id="old-count">0</span>)</a></li>
			<li><a href="#search" data-toggle="tab">@lang('lang_v1.search')</a></li>
		</ul>
		<div class="tab-content">
			<div id="new" class="tab-pane fade in active">
				<div class="row" id="new-orders">
				</div>
			</div>
			<div id="delayed" class="tab-pane fade">
				<div class="row" id="delayed-orders">
				</div>
			</div>
			<div id="old" class="tab-pane fade">
				<div class="row" id="old-orders">
				</div>
			</div>
			<div id="search" class="tab-pane fade">
			<div class="col-sm-4">
              <div class="form-group">
			  {!! Form::label('search_orders', __('lang_v1.search_orders') . ':') !!}
			  {!! Form::text('search_orders', null, ['id' => 'search-input', 'placeholder' => __('lang_v1.search'), 'class' => 'form-control']) !!}
				</div>
			</div>
				<div class="clearfix"></div>
				<div class="row" id="search-orders">
				</div>
			</div>
		</div>

		<div class="modal-body">

			<div class="row" id="cards-container">
				@php
				$c = 0;
				$subtype = '';
				@endphp
				@if(!empty($transaction_sub_type))
				@php
				$subtype = '?sub_type='.$transaction_sub_type;
				@endphp
				@endif
				@forelse($sales as $sale)
				@php
				$count_sell_line = count($sale->sell_lines);
				$count_cooked = count($sale->sell_lines->where('res_line_order_status', 'cooked'));
				$count_served = count($sale->sell_lines->where('res_line_order_status', 'served'));
				$order_status = 'received';
				if($count_cooked == $count_sell_line) {
				$order_status = 'cooked';
				} else if($count_served == $count_sell_line) {
				$order_status = 'served';
				} else if ($count_served > 0 && $count_served < $count_sell_line) {
					$order_status='partial_served' ;
					} else if ($count_cooked> 0 && $count_cooked < $count_sell_line) {
						$order_status='partial_cooked' ;
						}
						@endphp
						@if($sale->is_running_order)
						<div class="col-md-4 col-lg-3 mb-4 card-wrapper">
							<div class="card shadow-sm h-100">
								<div class="card-inner">
									@if(!empty($sale->additional_notes))
									<i class="fas fa-chevron-down flip-btn"></i>
									@endif
									<div class="btn-group" style="margin-top: 10px; margin-left: 10px;">
										<button type="button" class="dropdown-toggle btn-xs"
											data-toggle="dropdown" aria-expanded="false">

											<img src="{{ asset('img/icons/item.svg') }}">
										</button>
										<ul class="dropdown-menu dropdown-menu-left" role="menu">

											@if(auth()->user()->can('sell.update') || auth()->user()->can('direct_sell.update'))
											<li> <a href="{{action([\App\Http\Controllers\SellPosController::class, 'edit'], ['po' => $sale->id]).$subtype}}">
													@lang('lang_v1.edit_order')
												</a> </li>
											@endif

											@if(auth()->user()->can('sell.delete') || auth()->user()->can('direct_sell.delete'))
											<li><a href="{{action([\App\Http\Controllers\SellPosController::class, 'destroy'], ['po' => $sale->id])}}">
													@lang('messages.delete')
												</a></li>
											@endif

											@if(!auth()->user()->can('sell.update') && auth()->user()->can('edit_pos_payment'))
											<li><a href="{{route('edit-pos-payment', ['po' => $sale->id])}}">
													@lang('lang_v1.add_edit_payment')
												</a></li>
											@endif

											<li><a href="{{action([\App\Http\Controllers\SellPosController::class, 'printInvoice'], [$sale->id])}}?prebill=1" class="print-invoice-link">
													@lang('lang_v1.print_prebill')
												</a></li>
											<li><a href="{{action([\App\Http\Controllers\SellPosController::class, 'printInvoice'], [$sale->id])}}" class="print-invoice-link">
													@lang('lang_v1.reprint_kot')
												</a></li>
										</ul>
									</div>

									<div class="card-back card-body hide">
										<i class="fas fa-chevron-up flip-btn"></i>
										@lang('lang_v1.order_notes_label'):
										<p class="text-info">{{$sale->additional_notes ?? 'No additional notes'}}</p>
									</div>

									<div class="card-front card-body text-center d-flex flex-column">
									<span class="@if($order_status == 'cooked') bg-red @elseif($order_status == 'served') bg-green @elseif($order_status == 'partial_cooked') @else status @endif">
										{{ __('restaurant.order_statuses.' . $order_status) }}
									</span>
										<p class="h5">{{$sale->invoice_no}}</p>
										<p>{{@format_date($sale->transaction_date)}}</p>
										<p class="font-weight-bold"><i class="fa fa-user"></i> {{$sale->name}}</p>
										<p><i class="fa fa-cubes"></i> @lang('lang_v1.total_items'): {{count($sale->sell_lines)}}</p>
										<p><i class="fas fa-money-bill-alt"></i> @lang('sale.total'):<br>
											<span class="display_currency" data-currency_symbol=true>{{$sale->final_total}}</span>
										</p>
										@if($is_tables_enabled && !empty($sale->table->name))
										<p>@lang('restaurant.table'): {{$sale->table->name}}</p>
										@endif
										@if($is_service_staff_enabled && !empty($sale->service_staff))
										<p>@lang('restaurant.service_staff'): {{$sale->service_staff->user_full_name}}</p>
										@endif
                                        <input type="hidden" id="server-time" value="{{ \Carbon\Carbon::now(session('business.time_zone', config('app.timezone')))->toIso8601String() }}">
										<p class="elapsed-time" data-start-time="{{ \Carbon\Carbon::parse($sale->transaction_date)->timezone(session('business.time_zone', config('app.timezone')))->toIso8601String() }}"></p>
									</div>
								</div>
							</div>
						</div>
						@php $c++; @endphp
						@endif

						@if($c % 4 == 0)
						<div class="w-100"></div>
						@endif
						@empty
						<p class="text-center">@lang('purchase.no_records_found')</p>
						@endforelse

			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script src="{{ asset('js/running_orders.js') }}"></script>
