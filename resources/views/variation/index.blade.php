@extends('layouts.app')
@section('title', __('product.variations'))

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
                <h1>@lang( 'product.variations' )</h1>
                <p>@lang( 'sale.products' )</p>
            </div>

            <div class="filter">
                <div class="new-user">
                    <button type="button" class="btn-modal" 
                        data-href="{{action('VariationTemplateController@create')}}" 
                        data-container=".variation_modal">
                        <i class="fa fa-plus"></i> @lang( 'messages.add' )
                    </button>
                </div>
            </div>
        </div>
        <!-- End of Filter through table -->

            <div class="content">
                @can('unit.view')
                    <div class="table-responsive">
                        <table class="table  max-table" id="variation_table">
                            <thead>
                                <tr>
                                    <th>@lang('product.variations')</th>
                                    <th>@lang('lang_v1.values')</th>
                                    <th>@lang('messages.action')</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                @endcan
            </div>

        <div class="modal fade variation_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>
    </div>

</div>

@endsection
