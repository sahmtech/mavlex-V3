@extends('layouts.app')
@section('title', __('lang_v1.product_stock_history'))

@section('content')

<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.product', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang( 'lang_v1.product_stock_history' )</h1>
                <p>@lang( 'lang_v1.manage_products' )</p>
            </div>
            <div class="filter">
            <div class="new-user">
            <button id="adjust_current_stock" class="btn btn-primary">@lang('lang_v1.adjust_current_stock')</button>
            </div>
            </div>
        </div>
        <!-- End of Filter through table -->
        <div class="content">
            <div class="row">
    <div class="col-md-12">
    @component('components.widget', ['title' => $product->name])
        <div class="col-md-3">
            <div class="form-group">
                {!! Form::label('location_id',  __('purchase.business_location') . ':') !!}
                {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
            </div>
        </div>
        @if($product->type == 'variable')
            <div class="col-md-3">
                <div class="form-group">
                    <label for="variation_id">@lang('product.variations'):</label>
                    <select class="select2 form-control" name="variation_id" id="variation_id">
                        @foreach($product->variations as $variation)
                            <option value="{{$variation->id}}">{{$variation->product_variation->name}} - {{$variation->name}} ({{$variation->sub_sku}})</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @else
            <input type="hidden" id="variation_id" name="variation_id" value="{{$product->variations->first()->id}}">
        @endif

    @endcomponent
       
    @component('components.widget')
        <div id="product_stock_history" style="display: none;"></div>
    @endcomponent
    </div>
</div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
   <script type="text/javascript">
        $(document).ready( function(){
            load_stock_history($('#variation_id').val(), $('#location_id').val(), false);
        });

       function load_stock_history(variation_id, location_id, adjust_current_stock = false) {
            $('#product_stock_history').fadeOut();
            $.ajax({
                url: '/products/stock-history/' + variation_id + "?location_id=" + location_id + "&adjust_current_stock=" + adjust_current_stock,
                dataType: 'html',
                success: function(result) {
                    $('#product_stock_history')
                        .html(result)
                        .fadeIn();

                    __currency_convert_recursively($('#product_stock_history'));

                    $('#stock_history_table').DataTable({
                        searching: false,
                        ordering: false
                    });
                },
            });
       }

       $(document).on('change', '#variation_id, #location_id', function(){
            load_stock_history($('#variation_id').val(), $('#location_id').val(), false);
       });

       $("#adjust_current_stock").on('click', function() {
            load_stock_history($('#variation_id').val(), $('#location_id').val(), true);
        });

       

   </script>
@endsection