@extends('layouts.app')
@section('title', __('business.business_locations'))

@section('content')

<div class="main-container no-print">
<div class="horizontal-scroll">
    <div class="storys-container">
    @include('layouts.partials.sub_menu.misc', ['link_class' => 'sub-menu-item'])
</div>
    </div>
    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('business.business_locations')</h1>
                <p>@lang('business.manage_your_business_locations')</p>
            </div>

            <div class="filter">
                
           

            <div class="new-user">
                <button type="button" class="btn-block btn-primary add-user-modal-btn btn-modal " 
                    data-href="{{action('BusinessLocationController@create')}}" 
                    data-container=".location_add_modal">
                    <i class="fa fa-plus"></i> @lang( 'messages.add' )
                </button>
                
            </div>
        </div> </div>

        <div class="content">
            
        <div class="table-responsive">
            <table class="table table-bordered table-striped max-table" id="business_location_table">
                <thead>
                    <tr>
                        <th>@lang( 'invoice.name' )</th>
                        <th>@lang( 'lang_v1.location_id' )</th>
                        <th>@lang( 'business.landmark' )</th>
                        <th>@lang( 'business.city' )</th>
                        <th>@lang( 'business.zip_code' )</th>
                        <th>@lang( 'business.state' )</th>
                        <th>@lang( 'business.country' )</th>
                        <th>@lang( 'lang_v1.price_group' )</th>
                        <th>@lang( 'invoice.invoice_scheme' )</th>
                        <th>@lang('lang_v1.invoice_layout_for_pos')</th>
                        <th>@lang('lang_v1.invoice_layout_for_sale')</th>
                        <th>@lang( 'messages.action' )</th>
                    </tr>
                </thead>
            </table>
        </div>

    <div class="modal fade location_add_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>
    <div class="modal fade location_edit_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>
        </div>

    </div>
</div>

@endsection
