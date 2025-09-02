@inject('module_util', 'App\Utils\ModuleUtil')

@php
$common_settings = !empty(session('business.common_settings')) ? session('business.common_settings') : [];
$pos_settings = !empty(session('business.pos_settings')) ? json_decode(session('business.pos_settings'), true) : [];
$business_id = session()->get('user.business_id');
$is_admin = auth()->user()->hasRole('Admin#' . session('business.id')) ? true : false;
$enabled_modules = !empty(session('business.enabled_modules')) ? session('business.enabled_modules') : [];
$is_mfg_enabled = $module_util->moduleSidebar($business_id, 'Manufacturing');
$is_crm_enabled = $module_util->moduleSidebar($business_id, 'Crm');
$is_essentials_enabled = $module_util->moduleSidebar($business_id, 'Essentials');
$is_accounting_enabled = $module_util->moduleSidebar($business_id, 'Accounting');
$is_superadmin_enabled = $module_util->moduleSidebar($business_id, 'Superadmin');
$is_repair_enabled = $module_util->moduleSidebar($business_id, 'Repair');
$is_connector_enabled = $module_util->moduleSidebar($business_id, 'Connector');
$is_desktopapp_enabled = $module_util->moduleSidebar($business_id, 'Desktopapp');
$is_hms_enabled = $module_util->moduleSidebar($business_id, 'Hms');
$is_woocommerce_enabled = $module_util->moduleSidebar($business_id, 'Woocommerce');
$is_poscustom_enabled = $module_util->moduleSidebar($business_id, 'PosCustom');
$is_productcatalogue_enabled = $module_util->moduleSidebar($business_id, 'ProductCatalogue');
$is_zatca_enabled = $module_util->moduleSidebar($business_id, 'Zatca');
$is_currency_exchange_enabled = $module_util->moduleSidebar($business_id, 'CurrencyExchangeRate');
$is_project_enabled = $module_util->moduleSidebar($business_id, 'Project');
$is_paymentreconciliation_enabled = $module_util->moduleSidebar($business_id, 'PaymentReconciliation');
$is_gym_enabled = $module_util->moduleSidebar($business_id, 'Gym');
$is_loginlayouts_enabled =$module_util->moduleSidebar($business_id, 'LoginLayouts');
$is_kitchen_enabled = in_array('kitchen', $enabled_modules);
$is_spreadsheet_enabled = $module_util->moduleSidebar($business_id, 'Spreadsheet');
@endphp

<!-- Left side column. contains the logo and sidebar -->
<aside class="no-print main-sidebar " id="main-sidebar">
  <!-- Sidebar top -->
  <div class="top">
    <div class="logo">
      @include('layouts.partials.logo')
    </div>
    <!-- Toggle Sidebar Button -->
    <button id="close-btn">
      <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M18.4325 6.90405L6.4325 18.9041" stroke="black" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
        <path d="M6.4325 6.90405L18.4325 18.9041" stroke="black" stroke-width="2" stroke-linecap="round"
          stroke-linejoin="round" />
      </svg>
    </button>
  </div>
  <!-- sidebar: style can be found in sidebar.less -->
  <div class="sidebar">
    <ul class="links"> {{-- Changed div.links to ul.links for top-level items --}}
      <!--Super Admin Module -->
      @if($is_superadmin_enabled)
      @if (auth()->user()->can('superadmin.access_superadmin_module'))
      <li>
        <a href="{{ action([\Modules\Superadmin\Http\Controllers\SuperadminController::class, 'index']) }}"
          class="{{ request()->segment(1) == 'superadmin' ? 'active' : '' }}">
          <img src="{{ asset('img/icons/user-management.svg?v=' . $asset_v) }}" alt="">
          <h3>@lang('superadmin::lang.superadmin')</h3>
        </a>
      </li>
      @endif
      @endif
      <li>
        <a href="{{ action('HomeController@index') }}" class="{{ request()->segment(1) == 'home' ? 'active' : '' }}">
          <img src="{{ asset('img/icons/dashboard.svg?v=' . $asset_v) }}" alt="">
          <h3>@lang('home.home')</h3>
        </a>
      </li>
    </ul>

    @if($is_admin || in_array('pos_sale', $enabled_modules) || auth()->user()->hasAnyPermission(['sell.view',
    'sell.create', 'direct_sell.access', 'view_own_sell_only', 'view_commission_agent_sell', 'access_shipping',
    'access_own_shipping', 'access_commission_agent_shipping', 'access_sell_return', 'direct_sell.view',
    'direct_sell.update', 'access_own_sell_return']) || in_array('purchases', $enabled_modules) &&
    (auth()->user()->can('purchase.view') || auth()->user()->can('purchase.create') ||
    auth()->user()->can('purchase.update')) || auth()->user()->can('product.view') ||
    auth()->user()->can('product.create') || auth()->user()->can('brand.view') || auth()->user()->can('unit.view') ||
    auth()->user()->can('category.view') || auth()->user()->can('brand.create') || auth()->user()->can('unit.create') ||
    auth()->user()->can('category.create') || in_array('stock_adjustment', $enabled_modules) ||
    in_array('stock_transfers', $enabled_modules) && (auth()->user()->can('adjustment.view') ||
    auth()->user()->can('adjustment.create')) || $is_mfg_enabled && (auth()->user()->can('manufacturing.access_recipe')
    || auth()->user()->can('manufacturing.access_production')) || in_array('add_sale', $enabled_modules) &&
    (auth()->user()->hasAnyPermission(['quotation.view_all', 'quotation.view_own'])))
    <div class="divider">
      <div class="rect"></div>
      <span>@lang('lang_v1.sales_inventory')</span>
    </div>
    @endif

    <ul class="links"> {{-- Changed div.links to ul.links --}}
      <!-- Sells Menu -->
      @if($is_admin || auth()->user()->hasAnyPermission(['sell.view', 'sell.create', 'direct_sell.access',
      'view_own_sell_only', 'view_commission_agent_sell', 'access_shipping', 'access_own_shipping',
      'access_commission_agent_shipping', 'access_sell_return', 'direct_sell.view', 'direct_sell.update',
      'access_own_sell_return', 'discount.access', 'list_subscriptions']))
      @if ($app_settings->enable_sidebar_dropdown)
      @php
      $sells_active = Str::startsWith(request()->path(), ['sells', 'pos', 'sell-return', 'discount', 'subscriptions',
      'import-sales', 'sales-order', 'shipments']) || (request()->segment(1) == 'sells' && request()->get('status') ==
      'draft');
      @endphp
      <li class="nav-item toogle-sidebar-submenu {{ $sells_active ? 'open active' : '' }}">
        <a class="nav-link toogle-sidebar-submenu-flex" href="#">
          <img src="{{ asset('img/icons/shop-add.svg?v=' . $asset_v) }}" alt="">
          <h3>@lang('sale.sells')</h3>
          <span class="chevron" aria-hidden="true">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <polyline points="6 9 12 15 18 9" />
            </svg>
          </span>

        </a>
        <ul class="side-submenu">
          @include('layouts.partials.sub_menu.sell', ['link_class' => ''])
          @include('layouts.partials.sub_menu.invoice', ['link_class' => ''])
        </ul>
      </li>
      @else
      {{-- Original POS Sales Link --}}
      @if($is_admin || in_array('pos_sale', $enabled_modules) && auth()->user()->hasAnyPermission(['sell.view',
      'sell.create']) )
      <a href="{{ action('SellPosController@index') }}"
        class="{{ request()->segment(1) == 'pos' && request()->segment(2) == null || in_array(request()->segment(1), ['sales-order', 'shipments', 'discount', 'subscriptions', 'import-sales']) || request()->get('status') == 'draft' || request()->segment(1) == 'sells' && request()->segment(2) == 'drafts'  || request()->segment(1) == 'sell-return' && request()->segment(2) == null ? 'active' : '' }}">
        <img src="{{ asset('img/icons/POSS.svg?v=' . $asset_v) }}" alt="">
        <h3>@lang('lang_v2.pos_sales')</h3>
      </a>
      @endif
      {{-- Original Sells Link --}}
      <a href="{{ action('SellController@index') }}"
        class="{{ request()->segment(1) == 'sells' && request()->segment(2) == null || request()->segment(1) == 'sells' && request()->segment(2) == 'create' ? 'active' : '' }}">
        <img src="{{ asset('img/icons/shop-add.svg?v=' . $asset_v) }}" alt="">
        <h3>@lang('sale.sells')</h3>
      </a>
      {{-- Original Quotations Link --}}
      @if(in_array('add_sale', $enabled_modules) && ( $is_admin ||
      auth()->user()->hasAnyPermission(['quotation.view_all', 'quotation.view_own'])) )
      <a href="{{ action('SellController@getQuotations') }}"
        class="{{ request()->segment(1) == 'sells' && request()->segment(2) == 'quotations' ? 'active' : '' }}">
        <img src="{{ asset('img/icons/Quotation.svg?v=' . $asset_v) }}" alt="">
        <h3>@lang('lang_v1.quotations')</h3>
      </a>
      @endif
      @endif
      @endif

      <!-- Purchase Menu -->
      @if(in_array('purchases', $enabled_modules) && (auth()->user()->can('purchase.view') ||
      auth()->user()->can('purchase.create') || auth()->user()->can('purchase.update')))
      @if ($app_settings->enable_sidebar_dropdown)
      @php
      $purchase_active = Str::startsWith(request()->path(), ['purchases', 'purchase-order', 'purchase-return']);
      @endphp
      <li class="nav-item toogle-sidebar-submenu {{ $purchase_active ? 'open active' : '' }}">
        <a class="nav-link toogle-sidebar-submenu-flex" href="#">
          <img src="{{ asset('img/icons/purchases.svg?v=' . $asset_v) }}" alt="">
          <h3>@lang('purchase.purchases')</h3>
          <span class="chevron" aria-hidden="true">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <polyline points="6 9 12 15 18 9" />
            </svg>
          </span>

        </a>
        <ul class="side-submenu">
          @include('layouts.partials.sub_menu.purchase', ['link_class' => ''])
        </ul>
      </li>
      @else
      <a href="{{ action('PurchaseController@index') }}"
        class="{{ request()->segment(1) == 'purchases' && request()->segment(2) == null || in_array(request()->segment(1), ['purchase-order', 'purchase-return']) || request()->segment(1) == 'purchases' && request()->segment(2) == 'create' ? 'active' : '' }}">
        <img src="{{ asset('img/icons/purchases.svg?v=' . $asset_v) }}" alt="">
        <h3>@lang('purchase.purchases')</h3>
      </a>
      @endif
      @endif

      <!-- Products Menu -->
      @if(auth()->user()->can('product.view') || auth()->user()->can('product.create') ||
      auth()->user()->can('brand.view') || auth()->user()->can('unit.view') || auth()->user()->can('category.view') ||
      auth()->user()->can('brand.create') || auth()->user()->can('unit.create') ||
      auth()->user()->can('category.create'))
      @if ($app_settings->enable_sidebar_dropdown)
      @php
      $product_active = Str::startsWith(request()->path(), ['products', 'labels', 'variation-templates',
      'import-products', 'selling-price-group', 'units', 'brands', 'warranties']) || (request()->segment(1) ==
      'taxonomies' && request()->get('type') == 'product');
      @endphp
      <li class="nav-item toogle-sidebar-submenu {{ $product_active ? 'open active' : '' }}">
        <a class="nav-link toogle-sidebar-submenu-flex" href="#">
          <img src="{{ asset('img/icons/products.svg?v=' . $asset_v) }}" alt="">
          <h3>@lang('sale.products')</h3>
          <span class="chevron" aria-hidden="true">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <polyline points="6 9 12 15 18 9" />
            </svg>
          </span>

        </a>
        <ul class="side-submenu">
          @include('layouts.partials.sub_menu.product', ['link_class' => ''])
        </ul>
      </li>
      @else
      <a href="{{ action('ProductController@index') }}"
        class="{{ request()->segment(1) == 'products' && request()->segment(2) == null || request()->segment(1) == 'products' && request()->segment(2) == 'create' || request()->segment(1) == 'labels' && request()->segment(2) == 'show' || request()->segment(1) == 'taxonomies' && request()->get('type') == 'product' || in_array(request()->segment(1), ['variation-templates', 'import-products', 'selling-price-group', 'units', 'brands', 'warranties']) ? 'active' : '' }}">
        <img src="{{ asset('img/icons/products.svg?v=' . $asset_v) }}" alt="">
        <h3>@lang('sale.products')</h3>
      </a>
      @endif
      @endif
      <!-- Stock Manager Menu -->
      @if($is_admin || in_array('stock_adjustment', $enabled_modules) && (auth()->user()->can('adjustment.view') ||
      auth()->user()->can('adjustment.create')) || in_array('stock_transfers', $enabled_modules) &&
      (auth()->user()->can('purchase.view') || auth()->user()->can('purchase.create')))
      @if ($app_settings->enable_sidebar_dropdown)
      @php
      $stock_manager_active = Str::startsWith(request()->path(), ['stock-transfers', 'stock-adjustments',
      'import-opening-stock']);
      @endphp
      <li class="nav-item toogle-sidebar-submenu {{ $stock_manager_active ? 'open active' : '' }}">
        <a class="nav-link toogle-sidebar-submenu-flex" href="#">
          <img src="{{ asset('img/icons/Stock-Manager.svg?v=' . $asset_v) }}" alt="">
          <h3>@lang('lang_v1.stock_manager')</h3>
          <span class="chevron" aria-hidden="true">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <polyline points="6 9 12 15 18 9" />
            </svg>
          </span>

        </a>
        <ul class="side-submenu">
          @include('layouts.partials.sub_menu.stock-manager', ['link_class' => ''])
        </ul>
      </li>
      @else
      <a href="{{ action('StockTransferController@index') }}"
        class="{{ request()->segment(1) == 'stock-transfers' && request()->segment(2) == null || request()->segment(1) == 'stock-transfers' && request()->segment(2) == 'create' || request()->segment(1) == 'stock-adjustments' && request()->segment(2) == null || request()->segment(1) == 'stock-adjustments' && request()->segment(2) == 'create' || request()->segment(1) == 'import-opening-stock' ? 'active' : '' }}">
        <img src="{{ asset('img/icons/Stock-Manager.svg?v=' . $asset_v) }}" alt="">
        <h3>@lang('lang_v1.stock_manager')</h3>
      </a>
      @endif
      @endif
    </ul>

    @if($is_admin || in_array('expenses', $enabled_modules) && (auth()->user()->can('all_expense.access') ||
    auth()->user()->can('view_own_expense')) || auth()->user()->can('account.access') && in_array('account',
    $enabled_modules) || auth()->user()->can('purchase_n_sell_report.view') ||
    auth()->user()->can('contacts_report.view') || auth()->user()->can('stock_report.view') ||
    auth()->user()->can('tax_report.view') || auth()->user()->can('trending_product_report.view') ||
    auth()->user()->can('sales_representative.view') || auth()->user()->can('register_report.view') ||
    auth()->user()->can('expense_report.view'))
    <div class="divider">
      <div class="rect"></div>
      <span>@lang('lang_v1.accounting')</span>
    </div>
    @endif

    <ul class="links"> {{-- Changed div.links to ul.links --}}
      <!-- Expense Menu -->
      @if(in_array('expenses', $enabled_modules) && (auth()->user()->can('all_expense.access') ||
      auth()->user()->can('view_own_expense')))
      @if ($app_settings->enable_sidebar_dropdown)
      @php
      $expense_active = Str::startsWith(request()->path(), ['expenses', 'expense-categories']);
      @endphp
      <li class="nav-item toogle-sidebar-submenu {{ $expense_active ? 'open active' : '' }}">
        <a class="nav-link toogle-sidebar-submenu-flex" href="#">
          <img src="{{ asset('img/icons/expenses.svg?v=' . $asset_v) }}" alt="">
          <h3>@lang('expense.expenses')</h3>
          <span class="chevron" aria-hidden="true">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <polyline points="6 9 12 15 18 9" />
            </svg>
          </span>

        </a>
        <ul class="side-submenu">
          @include('layouts.partials.sub_menu.expense', ['link_class' => ''])
        </ul>
      </li>
      @else
      <a href="{{ action('ExpenseController@index') }}"
        class="{{ request()->segment(1) == 'expenses' && request()->segment(2) == null || request()->segment(1) == 'expenses' && request()->segment(2) == 'create' || request()->segment(1) == 'expense-categories' ? 'active' : '' }}">
        <img src="{{ asset('img/icons/expenses.svg?v=' . $asset_v) }}" alt="">
        <h3>@lang('expense.expenses')</h3>
      </a>
      @endif
      @endif

      <!-- Payment Accounts (Original individual link) -->
      @if(auth()->user()->can('account.access') && in_array('account', $enabled_modules) &&
      !$app_settings->enable_sidebar_dropdown)
      <a href="{{ action('AccountController@index') }}"
        class="{{ request()->segment(1) == 'account' && request()->segment(2) == 'account' || request()->segment(1) == 'account' && request()->segment(2) == 'balance-sheet' || request()->segment(1) == 'account' && request()->segment(2) == 'trial-balance' || request()->segment(1) == 'account' && request()->segment(2) == 'cash-flow' || request()->segment(1) == 'account' && request()->segment(2) == 'payment-account-report' ? 'active' : '' }}">
        <img src="{{ asset('img/icons/payments-account.svg?v=' . $asset_v) }}" alt="">
        <h3>@lang('lang_v1.payment_accounts')</h3>
      </a>
      @endif

      <!-- Accounting Module Group (becomes dropdown if enabled) -->
      @if(Module::has('Accounting') && $is_accounting_enabled)
      @if ($app_settings->enable_sidebar_dropdown)
      @php
      $accounting_module_active = (request()->segment(1) == 'accounting' && in_array(request()->segment(2),
      ['chart-of-accounts', 'transfer', 'journal-entry', 'budget', 'dashboard', 'transactions', 'reports'])) ||
      (request()->segment(2) == 'account-sub-type' || request()->segment(2) == 'account-detail-type') ||
      (Module::has('PaymentReconciliation') && $is_paymentreconciliation_enabled && request()->segment(1) ==
      'payment-reconciliation');
      @endphp
      <li class="nav-item toogle-sidebar-submenu {{ $accounting_module_active ? 'open active' : '' }}">
        <a class="nav-link toogle-sidebar-submenu-flex" href="#">
          <img src="{{ asset('img/icons/crm.svg?v=' . $asset_v) }}" alt=""> 
          <h3>@lang('accounting::lang.accounting')</h3>
          <span class="chevron" aria-hidden="true">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <polyline points="6 9 12 15 18 9" />
            </svg>
          </span>

        </a>
        <ul class="side-submenu">
          {{-- This will now include links from original Payment Accounts, COA, Journal, Budget, Overview and
          PaymentReconciliation include --}}
          @if(auth()->user()->can('account.access') && in_array('account', $enabled_modules))
          @include('layouts.partials.sub_menu.account', ['link_class' => '']) {{-- New partial for payment account links
          --}}
          @endif
          @if(auth()->user()->can('accounting.manage_accounts'))
          <li
            class="{{ request()->segment(2) == 'chart-of-accounts' || request()->segment(2) == 'transfer' || request()->segment(2) == 'account-sub-type' || request()->segment(2) == 'account-detail-type' ? 'active' : '' }}">
            <a
              href="{{action([\Modules\Accounting\Http\Controllers\CoaController::class, 'index'])}}">@lang('accounting::lang.chart_of_accounts')</a>
          </li>
          @endif
          @if(auth()->user()->can('accounting.view_journal'))
          <li class="{{ request()->segment(2) == 'journal-entry' ? 'active' : '' }}">
            <a
              href="{{action([\Modules\Accounting\Http\Controllers\JournalEntryController::class, 'index'])}}">@lang('accounting::lang.journal_entry')</a>
          </li>
          @endif
          @if(auth()->user()->can('accounting.manage_budget'))
          <li class="{{ request()->segment(2) == 'budget' ? 'active' : '' }}">
            <a
              href="{{action([\Modules\Accounting\Http\Controllers\BudgetController::class, 'index'])}}">@lang('accounting::lang.budget')</a>
          </li>
          @endif
          @if(auth()->user()->can('accounting.access_accounting_module'))
          <li
            class="{{ (request()->segment(1) == 'accounting' && request()->segment(2) == 'dashboard') || request()->segment(2) == 'transactions' ? 'active' : '' }}">
            <a
              href="{{ action('\Modules\Accounting\Http\Controllers\AccountingController@dashboard') }}">@lang('lang_v1.account_overview')</a>
          </li>
          @endif
          @if(Module::has('PaymentReconciliation') && $is_paymentreconciliation_enabled)
          @include('paymentreconciliation::layouts.sidebar')
          @endif
        </ul>
      </li>
      @else
      {{-- Original Accounting Module Links --}}
      @if(auth()->user()->can('accounting.manage_accounts'))
      <a href="{{action([\Modules\Accounting\Http\Controllers\CoaController::class, 'index'])}}"
        class="{{ request()->segment(2) == 'chart-of-accounts' || request()->segment(2) == 'transfer' || request()->segment(2) == 'account-sub-type' || request()->segment(2) == 'account-detail-type' ? 'active' : '' }}">
        <img src="{{ asset('img/icons/crm.svg?v=' . $asset_v) }}" alt="">
        <h3>@lang('accounting::lang.chart_of_accounts')</h3>
      </a>
      @endif
      @if(auth()->user()->can('accounting.view_journal'))
      <a href="{{action([\Modules\Accounting\Http\Controllers\JournalEntryController::class, 'index'])}}"
        class="{{ request()->segment(2) == 'journal-entry' ? 'active' : '' }}">
        <img src="{{ asset('img/icons/crm.svg?v=' . $asset_v) }}" alt="">
        <h3>@lang('accounting::lang.journal_entry')</h3>
      </a>
      @endif
      @if(auth()->user()->can('accounting.manage_budget'))
      <a href="{{action([\Modules\Accounting\Http\Controllers\BudgetController::class, 'index'])}}"
        class="{{ request()->segment(2) == 'budget' ? 'active' : '' }}">
        <img src="{{ asset('img/icons/crm.svg?v=' . $asset_v) }}" alt="">
        <h3>@lang('accounting::lang.budget')</h3>
      </a>
      @endif
      @if (auth()->user()->can('accounting.access_accounting_module') )
      <a href="{{ action('\Modules\Accounting\Http\Controllers\AccountingController@dashboard') }}"
        class="{{ request()->segment(1) == 'accounting' && request()->segment(2) == 'dashboard' || request()->segment(2) == 'transactions' ? 'active' : '' }}">
        <img src="{{ asset('img/icons/crm.svg?v=' . $asset_v) }}" alt="">
        <h3>@lang('lang_v1.account_overview')</h3>
      </a>
      @endif
      @if(Module::has('PaymentReconciliation') && $is_paymentreconciliation_enabled)
      @include('paymentreconciliation::layouts.sidebar')
      @endif
      @endif
      @endif

      <!-- Reports Menu -->
      @if(auth()->user()->can('purchase_n_sell_report.view') || auth()->user()->can('contacts_report.view') ||
      auth()->user()->can('stock_report.view') || auth()->user()->can('tax_report.view') ||
      auth()->user()->can('trending_product_report.view') || auth()->user()->can('sales_representative.view') ||
      auth()->user()->can('register_report.view') || auth()->user()->can('expense_report.view') ||
      auth()->user()->can('accounting.view_reports'))
      @if ($app_settings->enable_sidebar_dropdown)
      @php
      // Simplified active check for reports, assuming any /reports URL or specific report routes make it active
      $reports_active = request()->segment(1) == 'reports' ||
      request()->segment(2) == 'product-sell-report' ||
      request()->segment(2) == 'stock-report' ||
      request()->segment(2) == 'product-purchase-report' ||
      request()->segment(2) == 'profit-loss' ||
      request()->segment(2) == 'expense-report' ||
      request()->segment(2) == 'customer-supplier';
      @endphp
      <li class="nav-item toogle-sidebar-submenu {{ $reports_active ? 'open active' : '' }}">
        <a class="nav-link toogle-sidebar-submenu-flex" href="#">
          <img src="{{ asset('img/icons/reports.svg?v=' . $asset_v) }}" alt="">
          <h3>@lang('report.reports')</h3>
          <span class="chevron" aria-hidden="true">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <polyline points="6 9 12 15 18 9" />
            </svg>
          </span>

        </a>
        <ul class="side-submenu">
          @include('layouts.partials.sub_menu.report', ['link_class' => ''])
        </ul>
      </li>
      @else
      <div class="toogle-sidebar-submenu">
        <div class="toogle-sidebar-submenu-flex">
          <img src="{{ asset('img/icons/reports.svg?v=' . $asset_v) }}" alt="">
          <h3>@lang('report.reports')</h3>
        </div>
        <div class="side-submenu">
          @include('layouts.partials.sub_menu.report', ['link_class' => '']) {{-- This was already the structure for
          reports --}}
        </div>
      </div>
      @endif
      @endif
    </ul>

    @if($is_crm_enabled || auth()->user()->can('supplier.view') || auth()->user()->can('customer.view') ||
    auth()->user()->can('supplier.view_own') || auth()->user()->can('customer.view_own') ||
    auth()->user()->can('crm.access_all_leads') || auth()->user()->can('crm.access_own_leads'))
    <div class="divider">
      <div class="rect"></div>
      <span>@lang('lang_v1.crm_marketing')</span>
    </div>
    @endif

    <ul class="links"> {{-- Changed div.links to ul.links --}}
      <!-- Contacts Menu -->
      @if(auth()->user()->can('supplier.view') || auth()->user()->can('customer.view') ||
      auth()->user()->can('supplier.view_own') || auth()->user()->can('customer.view_own'))
      @if ($app_settings->enable_sidebar_dropdown)
      @php
      $contact_active = in_array(request()->input('type'), ['supplier', 'customer']) ||
      Str::startsWith(request()->path(), ['customer-group', 'contacts/import', 'contacts/map']);
      @endphp
      <li class="nav-item toogle-sidebar-submenu {{ $contact_active ? 'open active' : '' }}">
        <a class="nav-link toogle-sidebar-submenu-flex" href="#">
          <img src="{{ asset('img/icons/contacts.svg?v=' . $asset_v) }}" alt="">
          <h3>@lang('contact.contacts')</h3>
          <span class="chevron" aria-hidden="true">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <polyline points="6 9 12 15 18 9" />
            </svg>
          </span>

        </a>
        <ul class="side-submenu">
          @include('layouts.partials.sub_menu.contact', ['link_class' => ''])
        </ul>
      </li>
      @else
      <a href="{{ action('ContactController@index', ['type' => 'customer']) }}"
        class="{{ in_array(request()->input('type'), ['supplier', 'customer']) || request()->segment(1) == 'customer-group' || request()->segment(1) == 'contacts' && request()->segment(2) == 'import' || request()->segment(1) == 'contacts' && request()->segment(2) == 'map' ? 'active' : '' }}">
        <img src="{{ asset('img/icons/contacts.svg?v=' . $asset_v) }}" alt="">
        <h3>@lang('contact.contacts')</h3>
      </a>
      @endif
      @endif

      {{-- CRM Module links (Campaigns, Overview) - These seem to be standalone, not grouped into a dropdown by default
      here --}}
      @if($is_crm_enabled)
      @if((auth()->user()->can('crm.access_all_campaigns') || auth()->user()->can('crm.access_own_campaigns')))
      <li><a href="{{ action('\Modules\Crm\Http\Controllers\CampaignController@index') }}"
          class="{{ request()->segment(1) == 'crm' && request()->segment(2) == 'campaigns' ? 'active' : '' }}">
          <img src="{{ asset('img/icons/Broadcast.svg?v=' . $asset_v) }}" alt="">
          <h3>@lang('crm::lang.campaigns')</h3>
        </a></li>
      @endif

      @if((auth()->user()->can('crm.access_all_campaigns') || auth()->user()->can('crm.access_own_campaigns')))
      <li><a href="{{ action('\Modules\Crm\Http\Controllers\CrmDashboardController@index') }}"
          class="{{ request()->segment(1) == 'crm' && request()->segment(2) == 'dashboard' || request()->get('type') == 'life_stage' || request()->get('type') == 'source' ? 'active' : '' }}">
          <img src="{{ asset('img/icons/crm.svg?v=' . $asset_v) }}" alt="">
          <h3>@lang('crm::lang.overview')</h3>
        </a></li>
      @endif
      @endif
    </ul>

    {{-- HRM & Essentials --}}
    @if($is_essentials_enabled || (in_array('booking', $enabled_modules) && (auth()->user()->can('crud_all_bookings') ||
    auth()->user()->can('crud_own_bookings'))))
    <div class="divider">
      <div class="rect"></div>
      <span>@lang('lang_v1.hrm_essentials')</span>
    </div>
    @endif
    <ul class="links">
      @if($is_essentials_enabled)
      {{-- User did not specify Essentials/HRM as a dropdown target, keeping as individual links --}}
      <li><a href="{{ action('\Modules\Essentials\Http\Controllers\DashboardController@hrmDashboard') }}"
          class="{{ request()->segment(1) == 'hrm' && request()->segment(2) != 'payroll' ? 'active' : '' }}">
          <img src="{{ asset('img/icons/crm.svg?v=' . $asset_v) }}" alt="">
          <h3>@lang('essentials::lang.hrm')</h3>
        </a></li>
      <li><a href="{{ action('\Modules\Essentials\Http\Controllers\ToDoController@index') }}"
          class="{{ request()->segment(1) == 'essentials' ? 'active' : '' }}">
          <img src="{{ asset('img/icons/task-square.svg?v=' . $asset_v) }}" alt="">
          <h3>@lang('essentials::lang.essentials')</h3>
        </a></li>
      @endif
      @if(in_array('booking', $enabled_modules) && (auth()->user()->can('crud_all_bookings') ||
      auth()->user()->can('crud_own_bookings')))
      <li><a href="{{ action('Restaurant\BookingController@index') }}"
          class="{{ request()->segment(1) == 'bookings' ? 'active' : '' }}">
          <img src="{{ asset('img/icons/crm.svg?v=' . $asset_v) }}" alt="">
          <h3>@lang('restaurant.bookings')</h3>
        </a></li>
      @endif
    </ul>

    <!-- Kitchen Module - New Section -->
    @if ($is_kitchen_enabled && $app_settings->enable_sidebar_dropdown)
    <div class="divider">
      <div class="rect"></div>
      <span>@lang('restaurant.kitchen')</span> {{-- Assuming a lang key, adjust if needed --}}
    </div>
    <ul class="links">
      @php
      $kitchen_active = Str::startsWith(request()->path(), 'kitchen'); // Basic active check
      @endphp
      <li class="nav-item toogle-sidebar-submenu {{ $kitchen_active ? 'open active' : '' }}">
        <a class="nav-link toogle-sidebar-submenu-flex" href="#">
          <img src="{{ asset('img/icons/kitchen.svg?v=' . $asset_v) }}" alt=""> {{-- Placeholder icon --}}
          <h3>@lang('restaurant.kitchen')</h3>
          <span class="chevron" aria-hidden="true">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
              stroke-linecap="round" stroke-linejoin="round">
              <polyline points="6 9 12 15 18 9" />
            </svg>
          </span>

        </a>
        <ul class="side-submenu">
          @include('layouts.partials.sub_menu.restaurant', ['link_class' => ''])
        </ul>
      </li>
    </ul>
    @endif


      <!-- Premium Modules-->
      <div class="divider">
        <div class="rect"></div>
        <span>@lang('lang_v1.premium_modules')</span>
      </div>
      <div class="links">

      <!-- Manufacturing Module -->
      @if($is_mfg_enabled && (auth()->user()->can('manufacturing.access_recipe') || auth()->user()->can('manufacturing.access_production')))
        <a href="{{ action('\Modules\Manufacturing\Http\Controllers\RecipeController@index') }}" class="{{ request()->segment(1) == 'manufacturing' ? 'active' : '' }}">
          <img src="{{ asset('img/icons/manufacturing.svg?v=' . $asset_v) }}" alt="">
          <h3>@lang('manufacturing::lang.manufacturing')</h3>
        </a>
      @endif

      <!-- Repair Module -->
      @php
        $user = auth()->user();
        $hasRepairPermission = $user->can('superadmin') || $user->can('repair.view') || $user->can('job_sheet.view_assigned') || $user->can('job_sheet.view_all');
      @endphp

      @if ($is_repair_enabled && $hasRepairPermission)
        <a href="{{ action('\Modules\Repair\Http\Controllers\DashboardController@index') }}" class="{{ request()->segment(1) == 'repair' && request()->segment(2) != 'payroll' ? 'active' : '' }}">
            <i class="fa fa-wrench"></i>
            <h3>@lang('repair::lang.repair')</h3>
        </a>
      @endif

      <!-- Shopify Module -->
      @if(Module::has('Shopify'))
      @endif
      <!-- Woocommerce Module -->
      @if($is_woocommerce_enabled && (auth()->user()->can('woocommerce.syc_categories') || auth()->user()->can('woocommerce.sync_products') || auth()->user()->can('woocommerce.sync_orders') || auth()->user()->can('woocommerce.map_tax_rates') || auth()->user()->can('woocommerce.access_woocommerce_api_settings'))) 
      <a href="{{ action([\Modules\Woocommerce\Http\Controllers\WoocommerceController::class, 'index']) }}" class="{{ request()->segment(1) == 'woocommerce'  ? 'active' : '' }}">
        <i class="fab fa-wordpress"></i>
        <h3>@lang('woocommerce::lang.woocommerce')</h3>
      </a>
      @endif
      <!-- Project Module -->
      @if(Module::has('Project') && $is_project_enabled)
      @include('project::layouts.partials.sidebar')
      @endif
     
      <!-- ProductCatalogue -->
      @if($is_productcatalogue_enabled) 
        <a href="{{ action([\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'generateQr'])}}" class="{{ request()->segment(1) == 'product-catalogue'  ? 'active' : '' }}">
          <i class="fa fas fa-qrcode"></i>
          <h3>@lang('productcatalogue::lang.catalogue_qr')</h3>
        </a>
      @endif
      <!-- AiAssistance Module -->
      @if(Module::has('AiAssistance'))
      @endif
      <!-- AssetManagement Module -->
      @if(Module::has('AssetManagement'))
      @endif
      <!-- Cms Module -->
      @if(Module::has('Cms'))
      @include('cms::layouts.sidebar')
      @endif
      <!-- Connector/API Module -->
      @if (auth()->user()->can('superadmin') && $is_connector_enabled) 
        <a href="{{ action([\Modules\Connector\Http\Controllers\ClientController::class, 'index']) }}" class="{{ request()->segment(1) == 'connector'  ? 'active' : '' }}">
          <i class="fa fas fa-network-wired"></i>
          <h3>@lang('connector::lang.connector_clients')</h3>
        </a>
      @endif
      <!-- Connector/API Module -->
      @if (auth()->user()->can('superadmin') && $is_desktopapp_enabled) 
        <a href="{{ action([\Modules\Desktopapp\Http\Controllers\ClientController::class, 'index']) }}" class="{{ request()->segment(1) == 'desktopapp'  ? 'active' : '' }}">
          <i class="fa fas fa-network-wired"></i>
          <h3>@lang('desktopapp::lang.desktopapp_clients')</h3>
        </a>
      @endif
      <!-- Spreadsheet Module -->
      @if(Module::has('Spreadsheet') && $is_spreadsheet_enabled)
      @include('spreadsheet::layouts.sidebar')
      @endif
      <!-- Quickbooks Module -->
      @if(Module::has('Quickbooks'))
      @endif
      <!-- Hotel Management System Module -->
      @if($is_hms_enabled)
        <a href="{{ action([\Modules\Hms\Http\Controllers\HmsController::class, 'index']) }}" class="{{ request()->segment(1) == 'hms'  ? 'active' : '' }}">
        <i class="fas fa-hotel"></i>
        <h3>@lang('hms::lang.hms')</h3>
        </a>
      @endif    
      <!-- CustomDashboard Module-->
      @if(Module::has('CustomDashboard'))
      @endif
      <!-- InboxReport Module -->
      @if(Module::has('InboxReport'))
      @endif
      <!-- FieldForce Module -->
      @if(Module::has('FieldForce'))
      @endif
      <!-- Ecommerce Module -->
      @if(Module::has('Shop'))
      @endif
      <!-- Partner Management Module -->
      @if(Module::has('Partner'))
      @endif
      <!-- Advance Inventory Mangement Module -->
      @if(Module::has('InvetoryMangament'))
      @endif
      <!-- Whatsapp Module -->
      @if(Module::has('Whatsapp'))
      @endif
      <!-- Queue Management Module -->
      @if(Module::has('Queue'))
      @endif
      <!-- Garage Management Module -->
      @if(Module::has('Garage'))
      @endif
      <!-- Table Order Module -->
      @if(Module::has('TableOrder'))
      @endif
      <!-- Zatca Module -->
      @if(Module::has('Zatca') && $is_zatca_enabled)
        @include('zatca::layouts.sidebar')
      @endif
       <!-- Gym Module -->
      @if(Module::has('Gym') && $is_gym_enabled)
        @include('gym::layouts.sidebar')
      @endif
       <!-- Login Layouts Module -->
       @if(Module::has('LoginLayouts') && $is_loginlayouts_enabled)
        @include('loginlayouts::layouts.sidebar')
       @endif
      <!-- Super Backup Module-->
      @if(Module::has('SuperBackup'))
      @endif
      <!-- Track and Trace Module-->
      @if(Module::has('TrackAndTrace'))
      @endif
      <!-- Currency Exchange Rate -->
      @if(Module::has('CurrencyExchangeRate') && $is_currency_exchange_enabled) 
      @if (auth()->user()->can('currencyexchangerate.currencyexchangerate.view'))
        <a href="{{action([\Modules\CurrencyExchangeRate\Http\Controllers\CurrencyExchangeRateController::class, 'index'])}}" class="{{ request()->segment(1) == 'exchange-rates'  ? 'active' : '' }}"><i class="fas fa-coins"></i><h3>@lang('currencyexchangerate::lang.currency_exchange_rate')</h3></a> 
      @endif
      @endif 
     {{-- @php
          $module_path = base_path('Modules'); 
          $modules = is_dir($module_path) ? array_diff(scandir($module_path), ['.', '..']) : [];
          $business_id = session()->get('user.business_id');
      @endphp
      @foreach ($modules as $module)
        @php
          $module_lower = strtolower($module);
          $sidebar_view = "{$module_lower}::layouts.sidebar";
          $is_enabled = $module_util->moduleSidebar($business_id, $module);
        @endphp
        @if ($is_enabled && View::exists($sidebar_view))
              @includeIf($sidebar_view)
        @endif
      @endforeach  --}}
    
    </div>
  </div>
</aside>