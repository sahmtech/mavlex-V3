@extends('layouts.app')
@section('title', __('expense.expenses'))

@section('content')

<div class="main-container no-print">

    <!-- Sub Menu -->
    <div class="horizontal-scroll">
        <div class="storys-container">
    @include('layouts.partials.sub_menu.expense', ['link_class' => 'sub-menu-item'])
</div>
    </div>

    <!-- Card Wrapper for dashboard content -->
    <div class="card-wrapper">
        <!-- Filter through table -->
        <div class="overview-filter">
            <div class="title">
                <h1>@lang('expense.expenses')</h1>
                <p>@lang('lang_v1.list_expenses')</p>
            </div>
            <div class="filter">
                <div class="new-user">
                    @can('expense.add')
                    <a href="{{action('ExpenseController@create')}}" class="add-user-modal-btn"><i class="fa fa-plus"></i> @lang( 'messages.add' )</a>
                    @endcan
                </div>

                <a class="filter-modal-btn" data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                    <img src="{{ asset('img/icons/filter.svg') }}" alt="">
                   
                </a>
            </div>
        </div>
        <!-- End of Filter through table -->

        @component('components.filters', ['title' => __('report.filters')])
        @if(auth()->user()->can('all_expense.access'))
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('location_id', __('purchase.business_location') . ':') !!}
                {!! Form::select('location_id', $business_locations, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                {!! Form::label('expense_for', __('expense.expense_for').':') !!}
                {!! Form::select('expense_for', $users, null, ['class' => 'form-control select2', 'style' => 'width:100%']); !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('expense_contact_filter', __('contact.contact') . ':') !!}
                {!! Form::select('expense_contact_filter', $contacts, null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
            </div>
        </div>
        @endif
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('expense_category_id',__('expense.expense_category').':') !!}
                {!! Form::select('expense_category_id', $categories, null, ['placeholder' =>
                __('report.all'), 'class' => 'form-control select2', 'style' => 'width:100%', 'id' => 'expense_category_id']); !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('expense_date_range', __('report.date_range') . ':') !!}
                {!! Form::text('date_range', null, ['placeholder' => __('lang_v1.select_a_date_range'), 'class' => 'form-control', 'id' => 'expense_date_range', 'readonly']); !!}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {!! Form::label('expense_payment_status', __('purchase.payment_status') . ':') !!}
                {!! Form::select('expense_payment_status', ['paid' => __('lang_v1.paid'), 'due' => __('lang_v1.due'), 'partial' => __('lang_v1.partial')], null, ['class' => 'form-control select2', 'style' => 'width:100%', 'placeholder' => __('lang_v1.all')]); !!}
            </div>
        </div>
        @endcomponent
        <div class="content">
            <table class="max-table" id="expense_table">
                <thead>
                    <tr>
                        <th>@lang('messages.action')</th>
                        <th>@lang('messages.date')</th>
                        <th>@lang('purchase.ref_no')</th>
                        <th>@lang('expense.expense_category')</th>
                        <th>@lang('sale.payment_status')</th>
                        <th>@lang('sale.total_amount')</th>
                        <th>@lang('purchase.payment_due')</th>
                        <th>@lang('lang_v1.added_by')</th>
                    </tr>
                </thead>

                <tfoot>
                    <tr class="bg-gray font-17 text-center footer-total">
                        <td colspan="4"><strong>@lang('sale.total'):</strong></td>
                        <td class="footer_payment_status_count"></td>
                        <td class="footer_expense_total"></td>
                        <td class="footer_total_due"></td>
                        <td colspan="1"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>

<div class="modal fade payment_modal" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
</div>

<div class="modal fade edit_payment_modal" tabindex="-1" role="dialog"
    aria-labelledby="gridSystemModalLabel">
</div>
@stop
@section('javascript')
<script src="{{ asset('js/payment.js?v=' . $asset_v) }}"></script>
@endsection