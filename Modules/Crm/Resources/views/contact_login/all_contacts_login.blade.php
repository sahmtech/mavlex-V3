@extends('layouts.app')

@section('title', __('crm::lang.contacts_login'))

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
                <h1>@lang('crm::lang.contacts_login')</h1>
                <p>{{__('crm::lang.crm')}}</p>
            </div>

            <div style="display: flex; gap: 20px;">

                <div class="filter">
                    {!! Form::select('contact_id', $contacts, null, ['id' => 'contact_id', 'class' => 'form-control select2', 'id' => 'contact_id', 'placeholder' => __('messages.all')]); !!}
                </div>

                <div class="new-user">   
                    <a class="add-user-modal-btn contact-login-add" data-href="{{action('\Modules\Crm\Http\Controllers\ContactLoginController@create')}}" >
                        <i class="fa fa-plus"></i>
                        @lang( 'messages.add' )
                    </a>
                </div>
            </div>

        </div>
        <!-- End of Filter through table -->

            <div class="content">
            	<section class="content no-print">
	<input type="hidden" id="login_view_type" value="all_contacts_login">
	
	
		<div class="table-responsive">
			<table class="table max-table" id="all_contact_login_table" style="width: 100%;">
				<thead>
					<tr>
						<th>@lang('messages.action')</th>
						<th>@lang('contact.contact')</th>
						<th>@lang('business.username')</th>
		                <th>@lang('user.name')</th>
		                <th>@lang( 'business.email' )</th>
		                <th>@lang( 'lang_v1.department' )</th>
                		<th>@lang( 'lang_v1.designation' )</th>
					</tr>
				</thead>
			</table>
		</div>
	<div class="modal fade contact_login_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel"></div>
</section>
            </div>

    </div>
</div>

@endsection
@section('javascript')
	<script src="{{ asset('modules/crm/js/crm.js?v=' . $asset_v) }}"></script>
@endsection