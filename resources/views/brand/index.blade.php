@extends('layouts.app')
@section('title', 'Brands')

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
                <h1>@lang( 'brand.brands' )</h1>
                <p>@lang( 'sale.products' )</p>
            </div>

            <div class="filter">
            <div class="new-user">
                    @can('brand.create')
                        <button type="button" class="btn btn-block btn-primary btn-modal" 
                            data-href="{{action('BrandController@create')}}" 
                            data-container=".brands_modal">
                            <i class="fa fa-plus"></i> @lang( 'messages.add' )
                        </button>
                        
                    @endcan
                </div>
            </div>
        </div>
        <!-- End of Filter through table -->

            <div class="content">
                @can('brand.view')
                    <div class="table-responsive">
                        <table class="table max-table" id="brands_table">
                            <thead>
                                <tr>
                                    <th>@lang( 'brand.brands' )</th>
                                    <th>@lang( 'brand.note' )</th>
                                    <th>@lang( 'messages.action' )</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                @endcan
            </div>

            <div class="footer">

                
            </div>
        <div class="modal fade brands_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>
    </div>

</div>

@endsection
