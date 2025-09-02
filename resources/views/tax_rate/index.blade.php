@extends('layouts.app')
@section('title', __('tax_rate.tax_rates'))

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
                    <h1>@lang('tax_rate.tax_rates')</h1>
                    <p>@lang('tax_rate.manage_your_tax_rates')</p>
                </div>

                <div class="filter">
                    <div class="new-user">
                        @can('tax_rate.create')
                            <button type="button" class="add-user-modal-btn btn-modal btn-primary"
                                data-href="{{ action('TaxRateController@create') }}" data-container=".tax_rate_modal">
                                <i class="fa fa-plus"></i> @lang('messages.add')
                            </button>
                        @endcan
                    </div>

                </div>
            </div>

            <div class="content">
                @component('components.widget', ['class' => 'box-primary', 'title' => __('tax_rate.all_your_tax_rates')])
                    @can('tax_rate.view')
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped max-table" id="tax_rates_table">
                                <thead>
                                    <tr>
                                        <th>@lang('tax_rate.name')</th>
                                        <th>@lang('tax_rate.rate')</th>
                                        <th>@lang('tax_rate.min_amount')</th>

                                        <th>@lang('messages.action')</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    @endcan
                @endcomponent

                @component('components.widget', ['class' => 'box-primary'])
                    @slot('title')
                        @lang('tax_rate.tax_groups') ( @lang('lang_v1.combination_of_taxes') ) @show_tooltip(__('tooltip.tax_groups'))
                    @endslot
                    @can('tax_rate.create')
                        @slot('tool')
                            <div class="box-tools">
                                <button type="button" class="btn btn-block btn-primary btn-modal"
                                    data-href="{{ action('GroupTaxController@create') }}" data-container=".tax_group_modal">
                                    <i class="fa fa-plus"></i> @lang('messages.add')</button>
                            </div>
                        @endslot
                    @endcan
                    @can('tax_rate.view')
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped max-table" id="tax_groups_table">
                                <thead>
                                    <tr>
                                        <th>@lang('tax_rate.name')</th>
                                        <th>@lang('tax_rate.rate')</th>
                                        <th>@lang('tax_rate.sub_taxes')</th>
                                        <th>@lang('messages.action')</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    @endcan
                @endcomponent

                <div class="modal fade tax_rate_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
                </div>
                <div class="modal fade tax_group_modal" tabindex="-1" role="dialog"
                    aria-labelledby="gridSystemModalLabel">
                </div>
            </div>
        </div>
    </div>
@endsection
