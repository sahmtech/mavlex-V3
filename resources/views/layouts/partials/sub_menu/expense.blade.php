@php
  $link_class = $link_class ?? ''; 
@endphp
    {{-- List Expenses --}}
    @canany(['all_expense.access', 'view_own_expense'])
    <a href="{{ action('ExpenseController@index') }}"
        class="{{ $link_class }} {{ request()->segment(1) == 'expenses' && request()->segment(2) == null ? 'active' : '' }}">
        @lang('lang_v1.list_expenses')
    </a>
    @endcanany

    {{-- Expense Categories --}}
    @canany(['expense.add', 'expense.edit'])
    <a href="{{ action('ExpenseCategoryController@index') }}"
        class="{{ $link_class }} {{ request()->segment(1) == 'expense-categories' ? 'active' : '' }}">
        @lang('expense.expense_categories')
    </a>
    @endcanany

    <a href="{{action([\App\Http\Controllers\ExpenseController::class, 'importExpense'])}}" class="{{ $link_class }} {{ request()->segment(1) == 'import-expense' ? 'active' : '' }}">
        @lang('expense.import_expense')
    </a>
