@extends('layouts.app')

@section('title', __('crm::lang.campaigns'))

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
                <h1>@lang('crm::lang.campaigns')</h1>
                <p>{{__('crm::lang.crm')}}</p>
            </div>

            <div style="display: flex; gap: 20px;">
                <div class="filter">
                    {!! Form::select('campaign_type', ['sms' => __('crm::lang.sms'), 'email' => __('business.email')], null, ['id' => 'campaign_type', 'class' => 'form-control select2', 'id' => 'campaign_type_filter', 'placeholder' => __('messages.all')]); !!}
                </div>

                <div class="new-user">
                    <a class="add-user-modal-btn" href="{{action('\Modules\Crm\Http\Controllers\CampaignController@create')}}">
                        <i class="fa fa-plus"></i> @lang('messages.add')
                    </a>
                </div>
            </div>

        </div>
        <!-- End of Filter through table -->

            <div class="content">
            	<section class="content no-print">
	
        <div class="table-responsive">
        	<table class="table max-table" id="campaigns_table">
		        <thead>
		            <tr>
		                <th>@lang('crm::lang.campaign_name')</th>
		                <th>@lang('crm::lang.campaign_type')</th>
		                <th>@lang('business.created_by')</th>
                        <th>@lang('lang_v1.created_at')</th>
                        <th> @lang('messages.action')</th>
		            </tr>
		        </thead>
		    </table>
        </div>
    <div class="modal fade campaign_modal" tabindex="-1" role="dialog"></div>
    <div class="modal fade campaign_view_modal" tabindex="-1" role="dialog"></div>
</section>
            </div>
    </div>
</div>

@endsection
@section('javascript')
	<script src="{{ asset('modules/crm/js/crm.js?v=' . $asset_v) }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			initializeCampaignDatatable();
		});
	</script>
@endsection