@extends('layouts.app')
@section('title', __( 'sale.list_pos'))

@section('content')
<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.sell', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('sale.pos_sale')</h1>
                <p>@lang('sale.sells')</p>
            </div>

            <div class="filter">
               
                <div class="new-user">
                    @can('sell.create')
                        <a class="add-user-modal-btn btn-block btn-primary" href="{{action('SellPosController@create')}}"> <i class="fa fa-plus"></i> @lang( 'messages.add' )</a>
                    @endcan
                </div>
                <a class="filter-modal-btn" data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                    <img src="{{ asset('img/icons/filter.svg') }}" alt="">
                   
                </a>
            </div>
        </div>
        <!-- End of Filter through table -->

        @component('components.filters', ['title' => __('report.filters')])
            @include('sell.partials.sell_list_filters')
        @endcomponent

        <div class="content">
           
            @can('sell.view')
                <input type="hidden" name="is_direct_sale" id="is_direct_sale" value="0">
                @include('sale_pos.partials.sales_table')
            @endcan
        </div>
    </div>
</div>

<!-- Main content -->

<!-- /.content -->

    
<div class="modal fade payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade edit_payment_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade register_details_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>
<div class="modal fade close_register_modal" tabindex="-1" role="dialog" 
    aria-labelledby="gridSystemModalLabel">
</div>

<!-- This will be printed -->
<!-- <section class="invoice print_section" id="receipt_section">
</section> -->


@stop

@section('javascript')
@include('sale_pos.partials.sale_table_javascript')
<script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
@endsection