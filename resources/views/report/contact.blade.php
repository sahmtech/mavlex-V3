@extends('layouts.app')
@section('title', __('report.customer') . ' - ' . __('report.supplier') . ' ' . __('report.reports'))

@section('content')
<div class="main-container no-print">
               
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.report.customer-supplier', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>{{ __('report.customer')}} & {{ __('report.supplier')}} {{ __('report.reports')}}</h1>
                <p>@lang( 'report.reports' )</p>
            </div>

            <div class="filter">
                <div class="new-user">
                {!! Form::select('cnt_customer_group_id', $customer_group, null, ['class' => 'form-control select2', 'id' => 'cnt_customer_group_id']); !!}
                </div>
                 <div class="new-user">
                {!! Form::select('contact_type', $types, null, ['class' => 'form-control select2', 'id' => 'contact_type']); !!}
            </div>
            </div>
        </div>
        <!-- End of Filter through table -->
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="max-table" id="supplier_report_tbl">
                            <thead>
                                <tr>
                                    <th>@lang('report.contact')</th>
                                    <th>@lang('report.total_purchase')</th>
                                    <th>@lang('lang_v1.total_purchase_return')</th>
                                    <th>@lang('report.total_sell')</th>
                                    <th>@lang('lang_v1.total_sell_return')</th>
                                    <th>@lang('lang_v1.opening_balance_due')</th>
                                    <th>@lang('report.total_due') &nbsp;&nbsp;<i class="fa fa-info-circle text-info no-print" data-toggle="tooltip" data-placement="bottom" data-html="true" data-original-title="{{ __('messages.due_tooltip')}}" aria-hidden="true"></i></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="bg-gray font-17 footer-total text-center">
                                    <td><strong>@lang('sale.total'):</strong></td>
                                    <td><span class="footer_total_purchase"></span></td>
                                    <td><span class="footer_total_purchase_return"></span></td>
                                    <td><span class="footer_total_sell"></span></td>
                                    <td><span class="footer_total_sell_return"></span></td>
                                    <td><span class="footer_total_opening_bal_due"></span></td>
                                    <td><span class="footer_total_due"></span></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
@endsection