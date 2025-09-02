@extends('layouts.app')
@section('title', __( 'unit.units' ))

@section('content')

<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.product', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang( 'unit.units' )</h1>
                <p>@lang( 'sale.products' )</p>
            </div>

            <div class="filter">
               <div class="new-user">
                @can('unit.create')
                    <button type="button" class="btn-modal" 
                        data-href="{{action('UnitController@create')}}" 
                        data-container=".unit_modal">
                        <i class="fa fa-plus"></i> @lang( 'messages.add' )
                    </button>
                    
                @endcan
            </div>
            </div>

            
        </div>
        <!-- End of Filter through table -->

            <div class="content">
                @can('unit.view')
                    <div class="table-responsive">
                        <table class="table max-table" id="unit_table">
                            <thead>
                                <tr>
                                    <th>@lang( 'unit.name' )</th>
                                    <th>@lang( 'unit.short_name' )</th>
                                    <th>@lang( 'unit.allow_decimal' ) @show_tooltip(__('tooltip.unit_allow_decimal'))</th>
                                    <th>@lang( 'messages.action' )</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                @endcan
            </div>

        <div class="modal fade unit_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>
    </div>

</div>

@endsection
