@forelse($orders as $order)
      <div class="kitchen-order-item">
            <div class="heading">
                  @php
                        $count_sell_line = count($order->sell_lines);
                        $count_cooked = count($order->sell_lines->where('res_line_order_status', 'cooked'));
                        $count_served = count($order->sell_lines->where('res_line_order_status', 'served'));
                        $order_status =  'received';
                        if($count_cooked == $count_sell_line) {
                              $order_status =  'cooked';
                        } else if($count_served == $count_sell_line) {
                              $order_status =  'served';
                        } else if ($count_served > 0 && $count_served < $count_sell_line) {
                              $order_status =  'partial_served';
                        } else if ($count_cooked > 0 && $count_cooked < $count_sell_line) {
                              $order_status =  'partial_cooked';
                        }
                        
                  @endphp
                  <span class="@if($order_status == 'cooked' ) bg-red @elseif($order_status == 'served') bg-green @elseif($order_status == 'partial_cooked') @else status @endif">
                        {{ $order_status }}
                  </span>
                  <div class="btn-group">
                        <button type="button" class="dropdown-toggle btn-xs" 
                            data-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('img/icons/item.svg') }}" alt="">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                              @if($orders_for == 'kitchen')
                                    <li>
                                          <a href="#" class="btn btn-flat small-box-footer bg-yellow mark_as_cooked_btn" data-href="{{action('Restaurant\KitchenController@markAsCooked', [$order->id])}}"><i class="fa fa-check-square-o"></i> @lang('restaurant.mark_as_cooked')</a>
                                    </li>
                                    
                              @elseif($orders_for == 'waiter' && $order->res_order_status != 'served')
                                    <li>
                                          <a href="#" class="btn btn-flat small-box-footer bg-yellow mark_as_served_btn" data-href="{{action('Restaurant\OrderController@markAsServed', [$order->id])}}"><i class="fa fa-check-square-o"></i> @lang('restaurant.mark_as_served')</a>
                                    </li>
                              @else
                                    
                              @endif
                                    <li>
                                          <a href="#" class="btn btn-flat small-box-footer bg-info btn-modal" style="color: #ffffff" data-href="{{ action('SellController@show', [$order->id])}}" data-container=".view_modal">@lang('restaurant.order_details') <i class="fa fa-arrow-circle-right"></i></a>
                                    </li>
                        </ul>
                  </div>
            </div>

            <div class="kitchen-order-id">
                  <span>@lang('lang_v1.order_id')</span>
                  <h5>#{{$order->invoice_no}}</h5>
            </div>

            <div class="customer-info">
                  <div class="customer-type">
                      <span>@lang('contact.customer')</span>
                      <h6>{{$order->customer_name}}</h6>
                  </div>

                  <div class="table-number">
                      <span>@lang('restaurant.table')</span>
                      <h6>{{$order->table_name}}</h6>
                  </div>
            </div>

            <div class="kitchen-order-date">
                  <span>{{@format_date($order->created_at)}}, {{ @format_time($order->created_at)}}</span>
            </div>
         </div>
	
	@if($loop->iteration % 4 == 0)
		<div class="hidden-xs">
			<div class="clearfix"></div>
		</div>
	@endif
	@if($loop->iteration % 2 == 0)
		<div class="visible-xs">
			<div class="clearfix"></div>
		</div>
	@endif
@empty
<div class="col-md-12">
	<h4 class="text-center">@lang('restaurant.no_orders_found')</h4>
</div>
@endforelse