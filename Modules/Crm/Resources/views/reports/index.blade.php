@extends('layouts.app')

@section('title', __('report.reports'))

@section('content')
<div class="main-container">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
       @include('crm::layouts.nav')
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('report.reports')</h1>
                <p>{{__('crm::lang.crm')}}</p>
            </div>

        </div>
        <!-- End of Filter through table -->

        <div class="content">
            <!-- CRM Data Wrapper -->
            <div class="crm-data-wrapper">
                <div class="crm-data-item">
                    <h4>Follow ups by User</h4>

                    <div class="data-numbers">
                        <h2>{{ $totalFollowUpsByUser }}</h2>
                    </div>
                </div>

                <div class="crm-data-item">
                    <h4>Follow ups by Contact</h4>

                    <div class="data-numbers">
                        <h2>{{ $totalFollowUpsContact }}</h2>
                    </div>
                </div>

                <div class="crm-data-item">
                    <h4>Leads to customer Conversion</h4>

                    <div class="data-numbers">
                        <h2>{{ $totalLeadToCustomerConversion }}</h2>
                    </div>
                </div>

                <div class="form-box">
                    {!! Form::text('follow_up_user_date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'id' => 'follow_up_user_date_range', 'class' => 'form-control', 'readonly']); !!}
                </div>
            </div>

            <header>
                {{__('crm::lang.follow_ups_by_user')}}
            </header>
            <table class="table max-table" id="follow_ups_by_user_table" style="width: 100%;">
                <thead>
                    <tr>
                        <th>@lang('role.user')</th>
                        @foreach($statuses as $key => $value)
                            <th>
                                {{$value}}
                            </th>
                        @endforeach
                        <th>
                            @lang('lang_v1.others')
                        </th>
                        <th>
                            @lang('crm::lang.total_follow_ups')
                        </th>
                    </tr>
                </thead>
            </table>

            <header>
                {{__('crm::lang.follow_ups_by_contacts')}}
            </header>
            <table class="table max-table" id="follow_ups_by_contact_table" style="width: 100%;">
                <thead>
                    <tr>
                        <th>@lang('contact.contact')</th>
                        @foreach($statuses as $key => $value)
                            <th>
                                {{$value}}
                            </th>
                        @endforeach
                        <th>
                            @lang('lang_v1.others')
                        </th>
                        <th>
                            @lang('crm::lang.total_follow_ups')
                        </th>
                    </tr>
                </thead>
            </table>
            <header>
                {{__('crm::lang.lead_to_customer_conversion')}}
            </header>

            <table class="table max-table" id="lead_to_customer_conversion" style="width: 100%;">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <th>@lang('crm::lang.converted_by')</th>
                        <th>@lang('sale.total')</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection
@section('javascript')
    @include('crm::reports.report_javascripts')
@endsection