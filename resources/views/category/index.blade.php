@extends('layouts.app')
@section('title', 'Categories')

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
                <h1>@lang( 'category.categories' )</h1>
                <p>@lang( 'sale.products' )</p>
            </div>

            <div class="filter">
               
            </div>
        </div>
        <!-- End of Filter through table -->

            <div class="content">
                @can('category.view')
                    <div class="table-responsive">
                        <table class="table max-table" id="category_table">
                            <thead>
                                <tr>
                                    <th>@lang( 'category.category' )</th>
                                    <th>@lang( 'category.code' )</th>
                                    <th>@lang( 'messages.action' )</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                @endcan
            </div>

            <div class="footer">
                <div class="pagination">
                    
                </div>

                <div class="new-user">
                    @can('category.create')
                        <button type="button" class="btn btn-block btn-primary btn-modal" 
                            data-href="{{action('CategoryController@create')}}" 
                            data-container=".category_modal">
                            <i class="fa fa-plus"></i> @lang( 'messages.add' )
                        </button>
                    @endcan
                </div>
            </div>

       
        <div class="modal fade category_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>
    </div>

</div>

@endsection
