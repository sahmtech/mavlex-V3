@extends('layouts.restaurant')
@section('title', __( 'restaurant.kitchen' ))

@section('content')
<!-- Main content -->
<div class="setting-card-wrapper no-print">
    <div class="overview-filter">
        <div class="title">
            <h1>@lang( 'restaurant.kitchen' )</h1>
            <p>@lang('lang_v1.restaurant')</p>
        </div>
        <div class="filter">
            <button type="button" class="btn btn-sm pull-right" id="refresh_orders"><i class="fas fa-sync"></i> @lang( 'restaurant.refresh' )</button>
        
        </div>
    </div>
    <input type="hidden" id="orders_for" value="kitchen">
    <div class="kitchen-order-list" id="orders_div">
        
         @include('restaurant.partials.show_orders', array('orders_for' => 'kitchen'))   
    </div>
    <div class="overlay hide">
      <i class="fas fa-sync fa-spin"></i>
    </div>
    @if (session('is_running_order'))
        <input type="hidden" id="is_running_order" value="1">
        {{ session()->forget('is_running_order') }}
    @else
        <input type="hidden" id="is_running_order" value="0">
    @endif
</div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('click', 'a.mark_as_cooked_btn', function(e){
                e.preventDefault();
                swal({
                  title: LANG.sure,
                  icon: "info",
                  buttons: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var _this = $(this);
                        var href = _this.data('href');
                        $.ajax({
                            method: "GET",
                            url: href,
                            dataType: "json",
                            success: function(result){
                                if(result.success == true){
                                    toastr.success(result.msg);
                                    _this.closest('.order_div').remove();
                                } else {
                                    toastr.error(result.msg);
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>

@endsection