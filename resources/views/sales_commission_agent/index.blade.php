@extends('layouts.app')
@section('title', __('lang_v1.sales_commission_agents'))

@section('content')

<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.user-management', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang( 'user.user_management' )</h1>
                <p>@lang( 'lang_v1.sales_commission_agents' )</p>
            </div>

            <div class="filter">
                
            </div>

            <div class="new-user">
                @can('user.create')
                    <button type="button" class="add-user-modal-btn btn-modal btn-primary" 
                        data-href="{{action('SalesCommissionAgentController@create')}}" 
                        data-container=".commission_agent_modal">
                        <i class="fa fa-plus"></i> @lang( 'messages.add' )
                    </button>
                @endcan
            </div>
        </div>
        <!-- End of Filter through table -->

            <div class="content">
                @can('user.view')
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped ajax_view max-table" id="sales_commission_agent_table">
                            <thead>
                                <tr>
                                    <th>@lang( 'user.name' )</th>
                                    <th>@lang( 'business.email' )</th>
                                    <th>@lang( 'lang_v1.contact_no' )</th>
                                    <th>@lang( 'business.address' )</th>
                                    <th>@lang( 'lang_v1.cmmsn_percent' )</th>
                                    <th>@lang( 'messages.action' )</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                @endcan
            </div>
        <div class="modal fade commission_agent_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>
    </div>

</div>

@endsection
