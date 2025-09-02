@extends('layouts.app')
@section('title', __('report.sales_representative'))

@section('content')
<div class="main-container no-print">
               
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.report.sale-purchase', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                 <h1>{{ __('report.sales_representative')}}</h1>
                <p>@lang( 'report.reports' )</p>
            </div>
            {!! Form::open(['url' => action('ReportController@getStockReport'), 'method' => 'get', 'id' => 'sales_representative_filter_form' ]) !!}
                <div class="filter">
                    <div class="col-md-12">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::select('sr_id', $users, null, ['class' => 'form-control select2', 'id' => 'sr_id', 'placeholder' => __('report.all_users')]); !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::select('sr_business_id', $business_locations, null, ['class' => 'form-control select2', 'id' => 'sr_business_id']); !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'sr_date_filter', 'readonly']); !!}
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        <!-- End of Filter through table -->
<div class="content">
        <div class="overall">
            <strong>{{ __('report.summary') }}</strong>
        </div>
        <div class="sales-report-stats">
            <div class="item">
                <img src="{{ asset('img/icons/sales-img.svg') }}" alt="">

                <div class="content">
                    <h3>{{ __('report.total_sell') }} - {{ __('lang_v1.total_sales_return') }}</h3>
                    <h1>
                        <span id="sr_total_sales">
                            <i class="fas fa-sync fa-spin fa-fw"></i>
                        </span>
                        -
                        <span id="sr_total_sales_return">
                            <i class="fas fa-sync fa-spin fa-fw"></i>
                        </span>
                        =
                        <span id="sr_total_sales_final">
                            <i class="fas fa-sync fa-spin fa-fw"></i>
                        </span>
                    </h1>
                </div>
            </div>

            <div class="item hide" id="total_payment_with_commsn_div">
                <img src="{{ asset('img/icons/sales-img.svg') }}" alt="">

                <div class="content">
                    <h3>{{ __('lang_v1.total_payment_with_commsn') }}</h3>
                    <h1>
                        <span id="total_payment_with_commsn">
                            <i class="fas fa-sync fa-spin fa-fw"></i>
                        </span>
                    </h1>
                </div>
            </div>

            <div class="item hide" id="total_commission_div">
                <img src="{{ asset('img/icons/sales-img.svg') }}" alt="">

                <div class="content">
                    <h3>{{ __('lang_v1.total_sale_commission') }}</h3>
                    <h1>
                        <span id="sr_total_commission">
                            <i class="fas fa-sync fa-spin fa-fw"></i>
                        </span>
                    </h1>
                </div>
            </div>

            <div class="item">
                <img src="{{ asset('img/icons/sales-img.svg') }}" alt="">

                <div class="content">
                    <h3>{{ __('report.total_expense') }}</h3>
                    <h1>
                        <span id="sr_total_expenses">
                            <i class="fas fa-sync fa-spin fa-fw"></i>
                        </span>
                    </h1>
                </div>
            </div>
        </div>
<hr>
        <div class="overview-filter">
               <div class="col-md-3">
                    <div class="form-group">
                    <select name="" id="viewBy" >
                    <option value="sr_sales_tab">@lang('lang_v1.sales_added')</option>
                    <option value="sr_commission_tab">@lang('lang_v1.sales_with_commission')</option>
                    <option value="sr_expenses_tab">@lang('expense.expenses')</option>
                    @if(!empty($pos_settings['cmmsn_calculation_type']) && $pos_settings['cmmsn_calculation_type'] == 'payment_received')
                    <option value="sr_payments_with_cmmsn_tab">@lang('lang_v1.payments_with_cmmsn')</option>
                    @endif
                </select>
            </div>
                 </div>
        </div> 
            <div id="sr_sales_tab">
                @include('report.partials.sales_representative_sales')
            </div>

            <div id="sr_commission_tab" style="display: none;">
                @include('report.partials.sales_representative_commission')
            </div>

            <div id="sr_expenses_tab" style="display: none;">
                @include('report.partials.sales_representative_expenses')
            </div>

            @if(!empty($pos_settings['cmmsn_calculation_type']) && $pos_settings['cmmsn_calculation_type'] == 'payment_received')
                <div id="sr_payments_with_cmmsn_tab" style="display: none;">
                    @include('report.partials.sales_representative_payments_with_cmmsn')
                </div>
            @endif
        </div>
        
    </div>
</div>

@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>

    <script type="text/javascript">
    $(document).ready( function() {
        
        $('#viewBy').on('change', function() {
    var target = $(this).find(":selected").val();
    if ( target == 'sr_commission_tab') {
         $('#sr_sales_tab').hide();
         $('#sr_expenses_tab').hide();
         $('#sr_commission_tab').show();
         $('#sr_payments_with_cmmsn_tab').hide();

         sr_sales_commission_report.ajax.reload();
        
    } else if (target == 'sr_sales_tab') {
        $('#sr_sales_tab').show();
         $('#sr_expenses_tab').hide();
         $('#sr_commission_tab').hide();
         $('#sr_payments_with_cmmsn_tab').hide();
        
    } else if (target == 'sr_expenses_tab') {
        $('#sr_sales_tab').hide();
         $('#sr_expenses_tab').show();
         $('#sr_commission_tab').hide();
         $('#sr_payments_with_cmmsn_tab').hide();
         
         sr_expenses_report.ajax.reload();
        
    } else if (target == 'sr_payments_with_cmmsn_tab') {
        $('#sr_sales_tab').hide();
         $('#sr_expenses_tab').hide();
         $('#sr_commission_tab').hide();
         $('#sr_payments_with_cmmsn_tab').show();
        
    }
});
    });
</script>
@endsection