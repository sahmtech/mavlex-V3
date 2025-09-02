@extends('layouts.app')
@section('title', __('cash_register.cash_register'))

@section('content')

<div class="main-container no-print">
                
    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.sell', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang( 'cash_register.cash_register' )</h1>
                <p>@lang( 'cash_register.manage_your_cash_register' )</p>
            </div>

            <div class="filter">
                <button type="button" class="btn btn-block btn-primary btn-modal" 
                    data-href="{{action('CashRegisterController@create')}}" 
                    data-container=".location_add_modal">
                    <i class="fa fa-plus"></i> @lang( 'messages.add' )</button>
            </div>
        </div>
        <!-- End of Filter through table -->

        <div class="content">
            <table class="max-table" id="cash_registers_table">
                <thead>
                    <tr>
                        <th>@lang( 'invoice.name' )</th>
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


@endsection
