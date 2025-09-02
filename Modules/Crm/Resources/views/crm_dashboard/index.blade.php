@extends('layouts.app')

@section('title', __('crm::lang.crm'))

@section('content')

<div class="main-container">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
       @include('crm::layouts.nav')
    </div>

    <div class="setting-card-wrapper">
                    <!-- Filter through table -->
                    <div class="overview-filter">
                        <div class="title">
                            <h1>Dashboard</h1>
                            <p>Overview</p>
                        </div>
                    </div>

                    <!-- CRM Data Wrapper -->
                    <div class="crm-data-wrapper">
                        @if(auth()->user()->can('crm.access_all_leads') || auth()->user()->can('crm.access_own_leads'))
                        <div class="crm-data-item">
                            <h4>{{ __('crm::lang.leads') }}</h4>

                            <div class="data-numbers">
                                <h2>{{$total_leads}}</h2>

                                <div class="data-growth">
                                    {{--<span>0</span>--}}
                                    <img src="{{ asset('img/icons/growth.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="crm-data-item">
                            <h4>{{ __('crm::lang.my_leads_to_customer_conversion') }}</h4>

                            <div class="data-numbers">
                                <h2>{{$my_conversion}}</h2>

                                <div class="data-growth">
                                    {{--<span>0</span>--}}
                                    <img src="{{ asset('img/icons/growth.svg') }}" alt="">
                                </div>
                            </div>
                        </div>

                        @if(auth()->user()->can('crm.access_all_schedule') || auth()->user()->can('crm.access_own_schedule'))
                        <div class="crm-data-item">
                            <h4>{{ __('crm::lang.todays_followups') }}</h4>

                            <div class="data-numbers">
                                <h2>{{$todays_followups}}</h2>

                                <div class="data-growth">
                                    {{--<span>0</span>--}}
                                    <img src="{{ asset('img/icons/growth.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        @endif

                        @can('customer.view')
                        <div class="crm-data-item">
                            <h4>{{ __('lang_v1.customers') }}</h4>

                            <div class="data-numbers">
                                <h2>{{$total_customers}}</h2>

                                <div class="data-growth">
                                    {{--<span>0</span>--}}
                                    <img src="{{ asset('img/icons/growth.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                        @endcan

                        <div class="crm-data-item">
                            <h4>Outstanding Invoices</h4>

                            <div class="data-numbers">
                                <h2 class="display_currency" data-currency_symbol="true">{{ $due }}</h2>

                                <div class="data-growth">
                                   {{-- <span>12</span>--}}
                                    <img src="{{ asset('img/icons/growth.svg') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="crm-data-item">
                            <h4>Past Due Invoice</h4>

                            <div class="data-numbers">
                                <h2 class="display_currency" data-currency_symbol="true">{{ $overdue }}</h2>

                                <div class="data-growth">
                                   {{-- <span>12</span>--}}
                                    <img src="{{ asset('img/icons/growth.svg') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="crm-data-item">
                            <h4>Awaiting Payments</h4>

                            <div class="data-numbers">
                                <h2 class="display_currency" data-currency_symbol="true">{{ $due - $overdue }}</h2>

                                <div class="data-growth">
                                  {{--  <span>12</span> --}}
                                    <img src="{{ asset('img/icons/growth.svg') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="crm-data-item">
                            <h4>Paid Invoices</h4>

                            <div class="data-numbers">
                                <h2 class="display_currency" data-currency_symbol="true">{{ $paid }}</h2>

                                <div class="data-growth">
                                   {{-- <span>12</span> --}}
                                    <img src="{{ asset('img/icons/growth.svg') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CRM Source Wrapper -->
                    <div class="crm-source-wrapper">
                        <div class="CrmThreeGrid">
                            <!-- Source -->
                            @can('crm.access_sources')
                            <table class="crm-table">
                                <thead>
                                    <tr>
                                        <th>{{ __('crm::lang.sources') }}</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sources as $source)
                                        <tr>
                                            <td>
                                                <div class="source-name">
                                                    @if (file_exists(public_path().'/img/icons/'.$source->name . '.svg'))
                                                        <img src="{{ asset('img/icons/' . $source->name . '.svg') }}" alt="ins">
                                                    @else
                                                        <img src="{{ asset('img/icons/default-source.svg') }}">
                                                    @endif
                                                    
                                                    <span>{{$source->name}}</span>
                                                </div>
                                            </td>
                                            <td>
                                                @if(!empty($leads_count_by_source[$source->id]))
                                                    {{$leads_count_by_source[$source->id]['count']}}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                            
                                            <td>
                                                <div class="container-circle-progress">
                                                    @if(!empty($customers_count_by_source[$source->id]) && !empty($contacts_count_by_source[$source->id]))
                                                    @php
                                                        $conversion = ($customers_count_by_source[$source->id]['count']/$contacts_count_by_source[$source->id]['count']) * 100;
                                                    @endphp
                                                    @else 
                                                        @php
                                                        $conversion = 0;
                                                        @endphp
                                                    @endif
                                                    <div class="percent">
                                                      <svg>
                                                        <circle cx="25" cy="25" r="20"></circle>
                                                        <circle cx="25" cy="25" r="20" style="--percent: {{$conversion . '%'}}"></circle>
                                                      </svg>
                                                      <div class="number">
                                                            
                                                            {{$conversion . '%'}}
                                                            
                                                      </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center">@lang('lang_v1.no_data')</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            @endcan

                            @can('crm.access_life_stage')
                            <!-- Life Stages -->
                            <table class="crm-table">
                                <thead>
                                    <tr>
                                        <th>Invoice overview</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Draft</td>
                                        <td>{{ $drafts }}</td>
                                        {{--<td>8%</td>--}}
                                    </tr>
                                    <tr>
                                        <td>Paid</td>
                                        <td>{{ $paid }}</td>
                                        {{--<td>10%</td>--}}
                                    </tr>
                                    <tr>
                                        <td>Partially Paid</td>
                                        <td>{{ $partial }}</td>
                                        {{--<td>8%</td>--}}
                                    </tr>
                                    <tr>
                                        <td>OverDue</td>
                                        <td>{{ $overdue }}</td>
                                        {{--<td>39%</td>--}}
                                    </tr>
                                </tbody>
                            </table>
                            @endcan

                            @if(auth()->user()->can('crm.access_all_schedule') || auth()->user()->can('crm.access_own_schedule'))
                            <!-- Follow Ups -->
                            <table class="crm-table">
                                <thead>
                                    <tr>
                                        <th>My follow ups</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($statuses as $key => $value)
                                        <tr>
                                            <td>{{$value}}</td>
                                            <td>
                                                @if(isset($my_follow_ups_arr[$key]))
                                                    {{$my_follow_ups_arr[$key]}}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                            <td>
                                                @if(isset($my_follow_ups_arr[$key]))
                                                    {{$my_follow_ups_arr[$key]}}%
                                                @else
                                                    0%
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @if(isset($my_follow_ups_arr['__other']))
                                        <tr>
                                            <td>@lang('lang_v1.others')</td>
                                            <td>
                                                {{$my_follow_ups_arr['__other']}}
                                            </td>
                                            {{--<td>
                                                0%
                                            </td>--}}
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>

                </div>
</div>

@endsection
@section('css')
<style type="text/css">
    .fw-100 {
        font-weight: 100;
    }
    
</style>
@stop
@section('javascript')
	<script src="{{ asset('modules/crm/js/crm.js?v=' . $asset_v) }}"></script>
    @include('crm::reports.report_javascripts')
    <script type="text/javascript">
        $(document).ready(function () {

            $(document).on('click', '#wish_birthday', function () {
                var url = $(this).data('href');
                var contact_ids = [];
                $("input.contat_id").each(function(){
                    if ($(this).is(":checked")) {
                        contact_ids.push($(this).val());
                    }
                });

                if (_.isEmpty(contact_ids)) {
                    alert("{{__('crm::lang.plz_select_user')}}");
                } else {
                    location.href = url+'?contact_ids='+contact_ids;
                }
            });

            @if(config('constants.enable_crm_call_log'))
                all_users_call_log = $("#all_users_call_log").DataTable({
                            processing: true,
                            serverSide: true,
                            scrollY: "75vh",
                            scrollX: true,
                            scrollCollapse: true,
                            fixedHeader: false,
                            'ajax': {
                                url: "{{action('\Modules\Crm\Http\Controllers\CallLogController@allUsersCallLog')}}"
                            },
                            columns: [
                                { data: 'username', name: 'u.username' },
                                { data: 'calls_today', searchable: false },
                                { data: 'calls_yesterday', searchable: false },
                                { data: 'all_calls', searchable: false }
                            ],
                        });
            @endif
        });
    </script>
@endsection