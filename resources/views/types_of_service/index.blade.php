@extends('layouts.app')
@section('title', __('lang_v1.types_of_service'))

@section('content')

<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang( 'lang_v1.types_of_service' ) @show_tooltip(__('lang_v1.types_of_service_help_long'))</h1>
                <p>@lang('lang_v1.types_of_service')</p>
            </div>

            <div class="filter">
                <div class="new-user">
                    <button type="button" class="add-user-modal-btn btn-modal btn-primary" 
                        data-href="{{action('TypesOfServiceController@create')}}" 
                        data-container=".type_of_service_modal">
                        <i class="fa fa-plus"></i> @lang( 'messages.add' )
                    </button>
                </div>
                
            </div>
        </div>
        <!-- End of Filter through table -->

            <div class="content">
                @can('brand.view')
                    <div class="table-responsive">
                        <table class="table max-table" id="types_of_service_table">
                            <thead>
                                <tr>
                                    <th>@lang( 'tax_rate.name' )</th>
                                    <th>@lang( 'lang_v1.description' )</th>
                                    <th>@lang( 'lang_v1.packing_charge' )</th>
                                    <th>@lang( 'messages.action' )</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                @endcan
            </div>

        <div class="modal fade type_of_service_modal contains_select2" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
        </div>
    </div>
    </div>

</div>

@endsection

