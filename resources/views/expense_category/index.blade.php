@extends('layouts.app')
@section('title', __('expense.expense_categories'))

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
                <p>@lang( 'expense.manage_your_expense_categories' )</p>
            </div>

            <div class="filter">
               <div class="new-user">
                    @can('expense.add')
                        <button type="button" class="add-user-modal-btn btn-modal btn-primary" 
                            data-href="{{action('ExpenseCategoryController@create')}}" 
                            data-container=".expense_category_modal">
                            <i class="fa fa-plus"></i> @lang( 'messages.add' )
                        </button>
                    @endcan
                </div>
            </div>
        </div>
        <!-- End of Filter through table -->
        <div class="content">
            <table class="table table-bordered table-striped max-table" id="expense_category_table">
                <thead>
                    <tr>
                        <th>@lang( 'expense.category_name' )</th>
                        <th>@lang( 'expense.category_code' )</th>
                        <th>@lang( 'messages.action' )</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>

    <div class="modal fade expense_category_modal" tabindex="-1" role="dialog" 
        aria-labelledby="gridSystemModalLabel">
    </div>

</div>


@endsection
