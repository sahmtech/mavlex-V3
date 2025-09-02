<style>
.elapsed-time {
	border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 400;
    padding: 0px 1rem;
	color: white;
	display: flex;
	flex-wrap: nowrap
	}
	.kitchen-order-list {
  display: block !important; 
  column-count: 3;     
  column-gap: 1rem;
}

.kitchen-order-item {
  display: inline-block; 
  width: 100%;    
  margin-bottom: 1rem; 
  min-height: 300px;  
}
.kitchen-order-list .kitchen-order-item .heading span {
    display: inline-flex !important;
    align-items: center !important;
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
				<div class="kitchen-order-list" id="new-orders">
				</div>
			</div>
			<div id="delayed" class="tab-pane fade">
				<div class="kitchen-order-list" id="delayed-orders">
				</div>
			</div>
			<div id="old" class="tab-pane fade">
				<div class="kitchen-order-list" id="old-orders">
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
				<div class="kitchen-order-list" id="search-orders">
				</div>
			</div>
		</div>
		
		<!-- Modal Body -->
		<div class="modal-body">
		  <div class="tab-content">
			<!-- New Orders Tab -->
			<div class="kitchen-order-list" id="orders_div">
				<input type="hidden" id="orders_for" value="kitchen">
			  @forelse($sales as $sale)
				@php
				  $c = 0;
				  $count_sell_line = count($sale->sell_lines);
				  $count_cooked     = count($sale->sell_lines->where('res_line_order_status', 'cooked'));
				  $count_served     = count($sale->sell_lines->where('res_line_order_status', 'served'));
				  $order_status     = 'received';
				  if($count_cooked == $count_sell_line) {
					$order_status = 'cooked';
				  } else if($count_served == $count_sell_line) {
					$order_status = 'served';
				  } else if ($count_served > 0 && $count_served < $count_sell_line) {
					$order_status = 'partial_served';
				  } else if ($count_cooked > 0 && $count_cooked < $count_sell_line) {
					$order_status = 'partial_cooked';
				  }
				@endphp
  			
				@if($sale->is_running_order)
				
				  <div class="kitchen-order-item">
					<div class="heading">
						<span class="@if($order_status == 'cooked') bg-red @elseif($order_status == 'served') bg-green @elseif($order_status == 'partial_cooked') @else status @endif">
							{{ __('restaurant.order_statuses.' . $order_status) }}
						</span>
						<input type="hidden" id="server-time" value="{{ \Carbon\Carbon::now(session('business.time_zone', config('app.timezone')))->toIso8601String() }}">
					  	<p class="elapsed-time" data-start-time="{{ \Carbon\Carbon::parse($sale->transaction_date)->timezone(session('business.time_zone', config('app.timezone')))->toIso8601String() }}"></p> 
					  <div class="btn-group">
						<button type="button" class="dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">
						  <img src="{{ asset('img/icons/item.svg') }}" alt="">
						</button>
						<ul class="dropdown-menu dropdown-menu-right" role="menu">
						  @if(auth()->user()->can('sell.update') || auth()->user()->can('direct_sell.update'))
							<li>
							  <a href="{{ action([\App\Http\Controllers\SellPosController::class, 'edit'], ['po' => $sale->id]) . (!empty($transaction_sub_type) ? '?sub_type='.$transaction_sub_type : '') }}">
								@lang('lang_v1.edit_order')
							  </a>
							</li>
						  @endif
						  @if(auth()->user()->can('sell.delete') || auth()->user()->can('direct_sell.delete'))
							<li>
							  <a href="{{ action([\App\Http\Controllers\SellPosController::class, 'destroy'], ['po' => $sale->id]) }}">
								@lang('messages.delete')
							  </a>
							</li>
						  @endif
						  @if(!auth()->user()->can('sell.update') && auth()->user()->can('edit_pos_payment'))
							<li>
							  <a href="{{ route('edit-pos-payment', ['po' => $sale->id]) }}">
								@lang('lang_v1.add_edit_payment')
							  </a>
							</li>
						  @endif
						  <li>
							<a href="{{ action([\App\Http\Controllers\SellPosController::class, 'printInvoice'], [$sale->id]) }}?prebill=1" class="print-invoice-link">
							  @lang('lang_v1.print_prebill')
							</a>
						  </li>
						  <li>
							<a href="{{ action([\App\Http\Controllers\SellPosController::class, 'printInvoice'], [$sale->id]) }}" class="print-invoice-link">
							  @lang('lang_v1.reprint_kot')
							</a>
						  </li>
						</ul>
					  </div>
					</div>
  
					<div class="kitchen-order-id">
					  <span>@lang('lang_v1.order_id')</span>
					  <h5>#{{ $sale->invoice_no }}</h5>
					</div>
  
					<div class="customer-info">
					  <div class="customer-type">
						<span>@lang('contact.customer')</span>
						<h6>{{ $sale->name }}</h6>
					  </div>
					  <div class="table-number">
						<span>@lang('restaurant.table')</span>
						<h6>{{ $sale->table->name ?? '' }}</h6>
					  </div>
					</div>
  
					<div class="kitchen-order-date">
					  <span>{{ @format_date($sale->transaction_date) }}, {{ @format_time($sale->transaction_date) }} 
					</span>
					<span><br> @lang('lang_v1.total_items'): {{count($sale->sell_lines)}}</span>
					  <span> <br>@lang('sale.total'):
						<span class="display_currency" data-currency_symbol=true>{{$sale->final_total}}</span>
					</span>
					</div>
					@if(!empty($sale->additional_notes))
					<div class="kitchen-order-date">
					<span>@lang('lang_v1.order_notes_label')</span>
					<h6>{{$sale->additional_notes ?? ''}}</h6>
				  	</div>
				 	 @endif
				  </div>
				  @php $c++; @endphp
				@endif
				@if($c % 4 == 0)
					<div class="w-100"></div>
				@endif
					@empty
				<div class="col-md-12">
				  <h4 class="text-center">@lang('restaurant.no_orders_found')</h4>
				</div>
			  @endforelse
			</div>
			
		
			

		
		<!-- Modal Footer -->
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">@lang('messages.close')</button>
		</div>
	  </div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
  </div>
  <script src="{{ asset('js/running_orders_v2.js') }}"></script>
<script>

	</script>