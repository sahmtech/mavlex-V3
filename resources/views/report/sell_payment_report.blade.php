@extends('layouts.app')
@section('title', __('lang_v1.sell_payment_report'))

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
                <h1>{{ __('lang_v1.sell_payment_report')}}</h1>
                <p>@lang( 'report.reports' )</p>
            </div>

            <div class="filter">
               <a class="filter-modal-btn" data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                    <img src="{{ asset('img/icons/filter.svg') }}" alt="">
                   
                </a>
            </div>
        </div>
        <!-- End of Filter through table -->
        @component('components.filters', ['title' => __('report.filters')])
              {!! Form::open(['url' => '#', 'method' => 'get', 'id' => 'sell_payment_report_form' ]) !!}
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('customer_id', __('contact.customer') . ':') !!}
                        {!! Form::select('customer_id', $customers, null, ['class' => 'form-control select2', 'placeholder' => __('messages.all'), 'required', 'style' => 'width: 100%']); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('location_id', __('purchase.business_location').':') !!}
                        {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'placeholder' => __('messages.all'), 'required', 'style' => 'width: 100%']); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('payment_types', __('lang_v1.payment_method').':') !!}
                        {!! Form::select('payment_types', $payment_types, null, ['class' => 'form-control select2', 'placeholder' => __('messages.all'), 'required', 'style' => 'width: 100%']); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('customer_group_filter', __('lang_v1.customer_group').':') !!}
                        {!! Form::select('customer_group_filter', $customer_groups, null, ['class' => 'form-control select2', 'style' => 'width: 100%']); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('user_id', 'Users:') !!}
                        {!! Form::select('user_id', $users, null, ['class' => 'form-control select2', 'placeholder' => __('messages.all'), 'required', 'style' => 'width: 100%']); !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">

                        {!! Form::label('spr_date_filter', __('report.date_range') . ':') !!}
                        {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'spr_date_filter', 'readonly']); !!}
                    </div>
                </div>
                {!! Form::close() !!}
            @endcomponent
        <div class="content">
            <div class="table-responsive">
                        <table class="max-table display nowrap" style="width: 100%;" 
                        id="sell_payment_report_table">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>@lang('purchase.ref_no')</th>
                                    <th>@lang('lang_v1.paid_on')</th>
                                    <th>@lang('sale.amount')</th>
                                    <th>@lang('contact.customer')</th>
                                    <th>@lang('lang_v1.payment_method')</th>
                                    <th>@lang('sale.sale')</th>
                                    <th>@lang('lang_v1.users')</th>
                                    <th>@lang('messages.action')</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="bg-gray font-17 footer-total text-center">
                                    <td colspan="4"><strong>@lang('sale.total'):</strong></td>
                                    <td class="footer_total_amount"></td>
                                    <td colspan="4"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script src="{{ asset('js/report.js?v=' . $asset_v) }}"></script>
    <script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
@endsection