@extends('layouts.app')
@section('title', __('lang_v1.add_opening_stock'))

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
                <h1>@lang('lang_v1.add_opening_stock')</h1>
                <p>@lang( 'sale.products' )</p>
            </div>

            <div class="filter">
               
            </div>
        </div>
        <!-- End of Filter through table -->

            <div class="content">
                {!! Form::open(['url' => action('OpeningStockController@save'), 'method' => 'post', 'id' => 'add_opening_stock_form' ]) !!}
					{!! Form::hidden('product_id', $product->id); !!}
					@include('opening_stock.form-part')
					<div class="row">
						<div class="col-sm-12">
							<button type="submit" class="btn btn-primary pull-right">@lang('messages.save')</button>
						</div>
					</div>

				{!! Form::close() !!}
            </div>

            <div class="footer">
                
            </div>
    </div>

</div>

@stop
@section('javascript')
	<script src="{{ asset('js/opening_stock.js?v=' . $asset_v) }}"></script>
	<script type="text/javascript">
		$(document).ready( function(){
			$('.os_date').datetimepicker({
		        format: moment_date_format + ' ' + moment_time_format,
		        ignoreReadonly: true,
		        widgetPositioning: {
		            horizontal: 'right',
		            vertical: 'bottom'
		        }
		    });
		});
	</script>
@endsection
