@extends('layouts.app')
@section('title', __( 'lang_v1.subscriptions'))

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
                <h1>@lang( 'lang_v1.subscriptions') @show_tooltip(__('lang_v1.recurring_invoice_help'))</h1>
                <p>@lang('sale.sells')</p>
            </div>

        </div>
        <!-- End of Filter through table -->

        <div class="content">
            @can('sell.view')
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('subscriptions_filter_date_range', __('report.date_range') . ':') !!}
                            {!! Form::text('subscriptions_filter_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'readonly']); !!}
                        </div>
                    </div>
                </div>
                @include('sale_pos.partials.subscriptions_table')
            @endcan
        </div>
    </div>
</div>

@stop

@section('javascript')
@include('sale_pos.partials.subscriptions_table_javascript')
<script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
@endsection