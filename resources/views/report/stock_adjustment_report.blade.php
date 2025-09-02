@extends('layouts.app')
@section('title', __( 'report.stock_adjustment_report' ))

@section('content')
<div class="main-container no-print">
               
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.report.stock-product', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="report-card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
               <h1>@lang( 'report.stock_adjustment_report' )</h1>
                <p>@lang( 'report.reports' )</p>
            </div>

            <div class="filter">
                <div class="new-user">
                <select class="form-control select2" id="stock_adjustment_location_filter" style="width: 90%">
                    @foreach($business_locations as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                </div>
                <button type="button" id="stock_adjustment_date_filter">
                    <img src="{{ asset('img/icons/filter.svg') }}" alt="">
                </button>
            </div>
        </div>
        <!-- End of Filter through table -->
        <div class="content">
            <div class="sales-report-stats">
                <div class="item">
                    <img src="{{ asset('img/icons/sales-img.svg') }}" alt="">

                    <div class="content">
                        <h3>{{ __('report.total_normal') }}</h3>
                        <h1 class="total_normal">
                            <i class="fas fa-sync fa-spin fa-fw"></i>
                        </h1>
                    </div>
                </div>

                <div class="item">
                    <img src="{{ asset('img/icons/sales-img.svg') }}" alt="">

                    <div class="content">
                        <h3>{{ __('report.total_abnormal') }}</h3>
                        <h1 class="total_abnormal">
                            <i class="fas fa-sync fa-spin fa-fw"></i>
                        </h1>
                    </div>
                </div>

                <div class="item">
                    <img src="{{ asset('img/icons/sales-img.svg') }}" alt="">

                    <div class="content">
                        <h3>{{ __('report.total_stock_adjustment') }}</h3>
                        <h1 class="total_amount">
                            <i class="fas fa-sync fa-spin fa-fw"></i>
                        </h1>
                    </div>
                </div>

                <div class="item">
                    <img src="{{ asset('img/icons/sales-img.svg') }}" alt="">

                    <div class="content">
                        <h3>{{ __('report.total_recovered') }}</h3>
                        <h1 class="total_recovered">
                            <i class="fas fa-sync fa-spin fa-fw"></i>
                        </h1>
                    </div>
                </div>

            </div>
            

            <div class="table-responsive">
                <table class="report-table" id="stock_adjustment_table">
                        <thead>
                            <tr>
                                <th>@lang('messages.date')</th>
                                <th>@lang('purchase.ref_no')</th>
                                <th>@lang('business.location')</th>
                                <th>@lang('stock_adjustment.adjustment_type')</th>
                                <th>@lang('stock_adjustment.total_amount')</th>
                                <th>@lang('stock_adjustment.total_amount_recovered')</th>
                                <th>@lang('stock_adjustment.reason_for_stock_adjustment')</th>
                                <th>@lang('messages.action')</th>
                            </tr>
                        </thead>
                    </table>
            </div>

        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script src="{{ asset('js/stock_adjustment.js?v=' . $asset_v) }}"></script>
<script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
@endsection