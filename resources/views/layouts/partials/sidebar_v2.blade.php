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
<style>
    .tw-size-5 {
        width: 20px;
    }
</style>
<!-- Left side column. contains the logo and sidebar -->
<aside class="no-print main-sidebar" id="main-sidebar">
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
        <ul class="links">
            @if($is_superadmin_enabled)
            @if (auth()->user()->can('superadmin.access_superadmin_module'))
            <li>
                <a href="{{ action([\Modules\Superadmin\Http\Controllers\SuperadminController::class, 'index']) }}"
                    class="{{ request()->segment(1) == 'superadmin' ? 'active' : '' }}">
                    <svg aria-hidden="true" class="tw-size-5 tw-shrink-0" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M0 0h24v24H0z" stroke="none" />
                        <path
                            d="M8 7a4 4 0 1 0 8 0 4 4 0 0 0-8 0M6 21v-2a4 4 0 0 1 4-4h2.5m4.501 4a2 2 0 1 0 4 0 2 2 0 1 0-4 0m2-3.5V17m0 4v1.5m3.031-5.25-1.299.75m-3.463 2-1.3.75m0-3.5 1.3.75m3.463 2 1.3.75" />
                    </svg>
                    <h3>@lang('superadmin::lang.superadmin')</h3>
                </a>
            </li>
            @endif
            @endif
            {{-- ----------------------------- HOME ----------------------------- --}}
            <li class="nav-item toogle-sidebar-submenu">
                <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1) == 'home' ? 'active' : '' }}"
                    href="{{ action([\App\Http\Controllers\HomeController::class, 'index']) }}">

                    {{-- 24 × 24 SVG --}}
                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                        <path d="M10 12h4v4h-4z" />
                    </svg>

                    <h3>@lang('home.home')</h3>
                </a>
            </li>

            {{-- --------------------- USER MANAGEMENT DROPDOWN ------------------ --}}
            @if(auth()->user()->can('user.view') || auth()->user()->can('user.create') ||
            auth()->user()->can('roles.view'))
            @php
            $user_active = in_array(request()->segment(1), ['users', 'roles', 'sales-commission-agents']);
            @endphp
            <li class="nav-item toogle-sidebar-submenu {{ $user_active ? 'open active' : '' }}">
                <a class="nav-link toogle-sidebar-submenu-flex" href="#">

                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M9 7a4 4 0 1 0 0-8a4 4 0 0 0 0 8z" transform="translate(0 4)" />
                        <path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        <path d="M21 21v-2a4 4 0 0 0 -3-3.85" />
                    </svg>
                    <h3>@lang('user.user_management')</h3>
                    <span class="chevron" aria-hidden="true">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </span>
                </a>

                <ul class="side-submenu">
                    @can('user.view')
                    <a class="{{ request()->segment(1)=='users' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\ManageUserController::class, 'index']) }}">
                        @lang('user.users')
                    </a>
                    @endcan
                    @can('roles.view')
                    <a class="{{ request()->segment(1)=='roles' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\RoleController::class, 'index']) }}">
                        @lang('user.roles')
                    </a>
                    @endcan
                    @can('user.create')
                    <a class="{{ request()->segment(1)=='sales-commission-agents' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\SalesCommissionAgentController::class, 'index']) }}">
                        @lang('lang_v1.sales_commission_agents')
                    </a>
                    @endcan
                </ul>
            </li>
            @endif

            {{-- --------------------------- CONTACTS --------------------------- --}}
            @if(auth()->user()->can('supplier.view') || auth()->user()->can('customer.view')
            || auth()->user()->can('supplier.view_own') || auth()->user()->can('customer.view_own'))
            @php
            $contact_active = request()->segment(1)=='contacts'
            || request()->segment(1)=='customer-group';
            @endphp
            <li class="nav-item toogle-sidebar-submenu {{ $contact_active ? 'open active' : '' }}">
                <a class="nav-link toogle-sidebar-submenu-flex" href="#" id="tour_step4">

                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M20 6v12a2 2 0 0 1 -2 2H8a2 2 0 0 1 -2-2V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z" />
                        <path d="M10 16h6" />
                        <path d="M13 11a2 2 0 1 0 0-4a2 2 0 0 0 0 4z" />
                        <path d="M4 8h3M4 12h3M4 16h3" />
                    </svg>
                    <h3>@lang('contact.contacts')</h3>
                    <span class="chevron" aria-hidden="true">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </span>
                </a>
                <ul class="side-submenu">
                    {{-- Supplier --}}
                    @if(auth()->user()->can('supplier.view') || auth()->user()->can('supplier.view_own'))
                    <a class="{{ request()->input('type')=='supplier' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\ContactController::class, 'index'], ['type'=>'supplier']) }}">
                        @lang('report.supplier')
                    </a>
                    @endif
                    {{-- Customer --}}
                    @if(auth()->user()->can('customer.view') || auth()->user()->can('customer.view_own'))
                    <a class="{{ request()->input('type')=='customer' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\ContactController::class, 'index'], ['type'=>'customer']) }}">
                        @lang('report.customer')
                    </a>
                    <a class="{{ request()->segment(1)=='customer-group' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\CustomerGroupController::class, 'index']) }}">
                        @lang('lang_v1.customer_groups')
                    </a>
                    @endif
                    {{-- Import contacts --}}
                    @if(auth()->user()->can('supplier.create') || auth()->user()->can('customer.create'))
                    <a class="{{ request()->segment(1)=='contacts' && request()->segment(2)=='import' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\ContactController::class, 'getImportContacts']) }}">
                        @lang('lang_v1.import_contacts')
                    </a>
                    @endif
                    {{-- Map --}}
                    @if(!empty(env('GOOGLE_MAP_API_KEY')))
                    <a class="{{ request()->segment(1)=='contacts' && request()->segment(2)=='map' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\ContactController::class, 'contactMap']) }}">
                        @lang('lang_v1.map')
                    </a>
                    @endif
                </ul>

            </li>
            @endif

            {{-- ---------------------------- PRODUCTS -------------------------- --}}
            @if(
            auth()->user()->can('product.view') || auth()->user()->can('product.create') ||
            auth()->user()->can('brand.view') || auth()->user()->can('unit.view') ||
            auth()->user()->can('category.view')|| auth()->user()->can('brand.create') ||
            auth()->user()->can('unit.create') || auth()->user()->can('category.create')
            )
            @php
            $prod_active = in_array(request()->segment(1), [
            'products','update-product-price','labels','variation-templates',
            'import-products','import-opening-stock','selling-price-group',
            'units','taxonomies','brands','warranties'
            ]);
            @endphp
            <li class="nav-item toogle-sidebar-submenu {{ $prod_active ? 'open active' : '' }}">
                <a class="nav-link toogle-sidebar-submenu-flex" href="#" id="tour_step5">

                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 3l8 4.5v9l-8 4.5l-8-4.5v-9l8-4.5" />
                        <path d="M12 12l8-4.5" />
                        <path d="M8.2 9.8l7.6-4.6" />
                        <path d="M12 12v9" />
                        <path d="M12 12L4 7.5" />
                    </svg>
                    <h3>@lang('sale.products')</h3>
                    <span class="chevron" aria-hidden="true">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </span>
                </a>
                <ul class="side-submenu">
                    {{-- List products --}}
                    @can('product.view')
                    <a class="{{ request()->segment(1)=='products' && request()->segment(2)=='' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\ProductController::class, 'index']) }}">
                        @lang('lang_v1.list_products')
                    </a>
                    @endcan
                    {{-- Add product --}}
                    @can('product.create')
                    <a class="{{ request()->segment(1)=='products' && request()->segment(2)=='create' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\ProductController::class, 'create']) }}">
                        @lang('product.add_product')
                    </a>
                    @endcan
                    {{-- Update price --}}
                    @can('product.create')
                   
                        <a class="{{ request()->segment(1)=='update-product-price' ? 'active' : '' }}"
                            href="{{ action([\App\Http\Controllers\SellingPriceGroupController::class, 'updateProductPrice']) }}">
                            @lang('lang_v1.update_product_price')
                        </a>
                   
                    @endcan
                    {{-- Print labels --}}
                    @can('product.view')
                    <a class="{{ request()->segment(1)=='labels' && request()->segment(2)=='show' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\LabelsController::class, 'show']) }}">
                        @lang('barcode.print_labels')
                    </a>
                    @endcan
                    {{-- Variations & Import products --}}
                    @can('product.create')
                    <a class="{{ request()->segment(1)=='variation-templates' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\VariationTemplateController::class, 'index']) }}">
                        @lang('product.variations')
                    </a>
                    <a class="{{ request()->segment(1)=='import-products' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\ImportProductsController::class, 'index']) }}">
                        @lang('product.import_products')
                    </a>
                    @endcan
                    {{-- Opening stock --}}
                    @can('product.opening_stock')
                    <a class="{{ request()->segment(1)=='import-opening-stock' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\ImportOpeningStockController::class, 'index']) }}">
                        @lang('lang_v1.import_opening_stock')
                    </a>
                    @endcan
                    {{-- Selling price group --}}
                    @can('product.create')
                    <a class="{{ request()->segment(1)=='selling-price-group' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\SellingPriceGroupController::class, 'index']) }}">
                        @lang('lang_v1.selling_price_group')
                    </a>
                    @endcan
                    {{-- Units --}}
                    @if(auth()->user()->can('unit.view') || auth()->user()->can('unit.create'))
                    <a class="{{ request()->segment(1)=='units' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\UnitController::class, 'index']) }}">
                        @lang('unit.units')
                    </a>
                    @endif
                    {{-- Categories --}}
                    @if(auth()->user()->can('category.view') || auth()->user()->can('category.create'))
                    <a class="{{ request()->segment(1)=='taxonomies' && request()->get('type')=='product' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\TaxonomyController::class, 'index'], ['type'=>'product']) }}">
                        @lang('category.categories')
                    </a>
                    @endif
                    {{-- Brands --}}
                    @if(auth()->user()->can('brand.view') || auth()->user()->can('brand.create'))
                    <a class="{{ request()->segment(1)=='brands' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\BrandController::class, 'index']) }}">
                        @lang('brand.brands')
                    </a>
                    @endif
                    {{-- Warranties --}}

                    <a class="{{ request()->segment(1)=='warranties' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\WarrantyController::class, 'index']) }}">
                        @lang('lang_v1.warranties')
                    </a>

                </ul>

            </li>
            @endif

            {{-- ------------------------- PURCHASES --------------------------- --}}
            @if(in_array('purchases', $enabled_modules) &&
            (auth()->user()->can('purchase.view') || auth()->user()->can('purchase.create') ||
            auth()->user()->can('purchase.update')))
            @php
            $pur_active = in_array(request()->segment(1),
            ['purchase-requisition','purchase-order','purchases','purchase-return']);
            @endphp
            <li class="nav-item toogle-sidebar-submenu {{ $pur_active ? 'open active' : '' }}">
                <a class="nav-link toogle-sidebar-submenu-flex" href="#" id="tour_step6">

                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 3v12" />
                        <path d="M16 11l-4 4l-4 -4" />
                        <path d="M3 12a9 9 0 0 0 18 0" />
                    </svg>
                    <h3>@lang('purchase.purchases')</h3>
                    <span class="chevron" aria-hidden="true">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </span>
                </a>
                <ul class="side-submenu">
                    @if(!empty($common_settings['enable_purchase_requisition']) &&
                    (auth()->user()->can('purchase_requisition.view_all') ||
                    auth()->user()->can('purchase_requisition.view_own')))
                    <a class="{{ request()->segment(1)=='purchase-requisition' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\PurchaseRequisitionController::class, 'index']) }}">
                        @lang('lang_v1.purchase_requisition')
                    </a>
                    @endif

                    @if(!empty($common_settings['enable_purchase_order']) &&
                    (auth()->user()->can('purchase_order.view_all') || auth()->user()->can('purchase_order.view_own')))
                    <a class="{{ request()->segment(1)=='purchase-order' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\PurchaseOrderController::class, 'index']) }}">
                        @lang('lang_v1.purchase_order')
                    </a>
                    @endif

                    @if(auth()->user()->can('purchase.view') || auth()->user()->can('view_own_purchase'))
                    <a class="{{ request()->segment(1)=='purchases' && !request()->segment(2) ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\PurchaseController::class, 'index']) }}">
                        @lang('purchase.list_purchase')
                    </a>
                    @endif
                    @can('purchase.create')
                    <a class="{{ request()->segment(1)=='purchases' && request()->segment(2)=='create' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\PurchaseController::class, 'create']) }}">
                        @lang('purchase.add_purchase')
                    </a>
                    @endcan
                    @can('purchase.update')
                    <a class="{{ request()->segment(1)=='purchase-return' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\PurchaseReturnController::class, 'index']) }}">
                        @lang('lang_v1.list_purchase_return')
                    </a>
                    @endcan
                </ul>
            </li>
            @endif

            {{-- ----------------------------- SALES ---------------------------- --}}
            @if($is_admin || auth()->user()->hasAnyPermission([
            'sell.view', 'sell.create', 'direct_sell.access', 'view_own_sell_only',
            'view_commission_agent_sell', 'access_shipping', 'access_own_shipping',
            'access_commission_agent_shipping', 'access_sell_return', 'direct_sell.view',
            'direct_sell.update', 'access_own_sell_return'
            ]))
            @php
            $sale_active = in_array(request()->segment(1), [
            'sales-order','sells','pos','sell-return','shipments','discount',
            'subscriptions','import-sales'
            ]);
            @endphp
            <li class="nav-item toogle-sidebar-submenu {{ $sale_active ? 'open active' : '' }}">
                <a class="nav-link toogle-sidebar-submenu-flex" href="#" id="tour_step7">

                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 15V3" />
                        <path d="M16 7l-4-4-4 4" />
                        <path d="M3 12a9 9 0 0 0 18 0" />
                    </svg>
                    <h3>@lang('sale.sale')</h3>
                    <span class="chevron" aria-hidden="true">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </span>
                </a>
                <ul class="side-submenu">
                    {{-- Sales order --}}
                    @if(!empty($pos_settings['enable_sales_order']) && ($is_admin ||
                    auth()->user()->hasAnyPermission(['so.view_own','so.view_all','so.create'])))
                    <a class="{{ request()->segment(1)=='sales-order' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\SalesOrderController::class, 'index']) }}">
                        @lang('lang_v1.sales_order')
                    </a>
                    @endif

                    {{-- All sales --}}
                    @if($is_admin || auth()->user()->hasAnyPermission([
                    'sell.view','sell.create','direct_sell.access','direct_sell.view',
                    'view_own_sell_only','view_commission_agent_sell',
                    'access_shipping','access_own_shipping','access_commission_agent_shipping'
                    ]))
                    <a class="{{ request()->segment(1)=='sells' && !request()->segment(2) ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\SellController::class, 'index']) }}">
                        @lang('lang_v1.all_sales')
                    </a>
                    @endif

                    {{-- Add sale (direct) --}}
                    @if(in_array('add_sale', $enabled_modules) && auth()->user()->can('direct_sell.access'))
                    <a class="{{ request()->segment(1)=='sells' && request()->segment(2)=='create' && !request()->get('status') ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\SellController::class, 'create']) }}">
                        @lang('sale.add_sale')
                    </a>
                    @endif

                    {{-- POS --}}
                    @can('sell.create')
                    @if(in_array('pos_sale', $enabled_modules))
                    @can('sell.view')

                    <a class="{{ request()->segment(1)=='pos' && !request()->segment(2) ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\SellPosController::class, 'index']) }}">
                        @lang('sale.list_pos')
                    </a>

                    @endcan
                    <a class="{{ request()->segment(1)=='pos' && request()->segment(2)=='create' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\SellPosController::class, 'create']) }}">
                        @lang('sale.pos_sale')
                    </a>

                    @endif
                    @endcan

                    {{-- Add draft --}}
                    @if(in_array('add_sale', $enabled_modules) && auth()->user()->can('direct_sell.access'))
                    <a class="{{ request()->get('status')=='draft' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\SellController::class, 'create'], ['status'=>'draft']) }}">
                        @lang('lang_v1.add_draft')
                    </a>
                    @endif
                    {{-- List drafts --}}
                    @if(in_array('add_sale', $enabled_modules) && ($is_admin ||
                    auth()->user()->hasAnyPermission(['draft.view_all','draft.view_own'])))
                    <a class="{{ request()->segment(1)=='sells' && request()->segment(2)=='drafts' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\SellController::class, 'getDrafts']) }}">
                        @lang('lang_v1.list_drafts')
                    </a>
                    @endif

                    {{-- Add quotation --}}
                    @if(in_array('add_sale', $enabled_modules) && auth()->user()->can('direct_sell.access'))
                    <a class="{{ request()->get('status')=='quotation' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\SellController::class, 'create'], ['status'=>'quotation']) }}">
                        @lang('lang_v1.add_quotation')
                    </a>
                    @endif
                    {{-- List quotations --}}
                    @if(in_array('add_sale', $enabled_modules) && ($is_admin ||
                    auth()->user()->hasAnyPermission(['quotation.view_all','quotation.view_own'])))
                    <a class="{{ request()->segment(1)=='sells' && request()->segment(2)=='quotations' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\SellController::class, 'getQuotations']) }}">
                        @lang('lang_v1.list_quotations')
                    </a>
                    @endif

                    {{-- Sell return --}}
                    @if(auth()->user()->can('access_sell_return') || auth()->user()->can('access_own_sell_return'))
                    <a class="{{ request()->segment(1)=='sell-return' && !request()->segment(2) ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\SellReturnController::class, 'index']) }}">
                        @lang('lang_v1.list_sell_return')
                    </a>
                    @endif

                    {{-- Shipments --}}
                    @if($is_admin ||
                    auth()->user()->hasAnyPermission(['access_shipping','access_own_shipping','access_commission_agent_shipping']))
                    <a class="{{ request()->segment(1)=='shipments' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\SellController::class, 'shipments']) }}">
                        @lang('lang_v1.shipments')
                    </a>
                    @endif

                    {{-- Discounts --}}
                    @can('discount.access')
                    <a class="{{ request()->segment(1)=='discount' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\DiscountController::class, 'index']) }}">
                        @lang('lang_v1.discounts')
                    </a>
                    @endcan

                    {{-- Subscriptions --}}
                    @if(in_array('subscription', $enabled_modules) && auth()->user()->can('direct_sell.access'))
                    <a class="{{ request()->segment(1)=='subscriptions' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\SellPosController::class, 'listSubscriptions']) }}">
                        @lang('lang_v1.subscriptions')
                    </a>
                    @endif

                    {{-- Import sales --}}
                    @can('sell.create')
                    <a class="{{ request()->segment(1)=='import-sales' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\ImportSalesController::class, 'index']) }}">
                        @lang('lang_v1.import_sales')
                    </a>
                    @endcan
                </ul>

            </li>
            @endif



            {{-- ----------------------- STOCK TRANSFERS ------------------------ --}}
            @if(in_array('stock_transfers', $enabled_modules) &&
            (auth()->user()->can('purchase.view') || auth()->user()->can('purchase.create') ||
            auth()->user()->can('view_own_purchase')))
            @php
            $st_active = request()->segment(1)=='stock-transfers';
            @endphp
            <li class="nav-item toogle-sidebar-submenu {{ $st_active ? 'open active' : '' }}">
                <a class="nav-link toogle-sidebar-submenu-flex" href="#">

                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M7 17a2 2 0 1 0 4 0" />
                        <path d="M17 17a2 2 0 1 0 4 0" />
                        <path d="M5 17H3v-4M2 5h11v12m-4 0h6m4 0h2v-6H9M9 5h5l3 5" />
                        <path d="M3 9l4 0" />
                    </svg>
                    <h3>@lang('lang_v1.stock_transfers')</h3>
                    <span class="chevron" aria-hidden="true">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </span>
                </a>
                <ul class="side-submenu">
                    @if(auth()->user()->can('purchase.view') || auth()->user()->can('view_own_purchase'))
                    <a class="{{ request()->segment(1)=='stock-transfers' && !request()->segment(2) ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\StockTransferController::class, 'index']) }}">
                        @lang('lang_v1.list_stock_transfers')
                    </a>
                    @endif
                    @can('purchase.create')
                    <a class="{{ request()->segment(1)=='stock-transfers' && request()->segment(2)=='create' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\StockTransferController::class, 'create']) }}">
                        @lang('lang_v1.add_stock_transfer')
                    </a>
                    @endcan
                </ul>

            </li>
            @endif

            {{-- ---------------------- STOCK ADJUSTMENTS ----------------------- --}}
            @if(in_array('stock_adjustment', $enabled_modules) &&
            (auth()->user()->can('purchase.view') || auth()->user()->can('purchase.create') ||
            auth()->user()->can('view_own_purchase')))
            @php
            $sa_active = request()->segment(1)=='stock-adjustments';
            @endphp
            <li class="nav-item toogle-sidebar-submenu {{ $sa_active ? 'open active' : '' }}">
                <a class="nav-link toogle-sidebar-submenu-flex" href="#">

                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <ellipse cx="12" cy="6" rx="8" ry="3" />
                        <path d="M4 6v6a8 3 0 0 0 16 0V6" />
                        <path d="M4 12v6a8 3 0 0 0 16 0v-6" />
                    </svg>
                    <h3>@lang('stock_adjustment.stock_adjustment')</h3>
                    <span class="chevron" aria-hidden="true">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </span>
                </a>
                <ul class="side-submenu">
                    @if(auth()->user()->can('purchase.view') || auth()->user()->can('view_own_purchase'))
                    <a class="{{ request()->segment(1)=='stock-adjustments' && !request()->segment(2) ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\StockAdjustmentController::class, 'index']) }}">
                        @lang('stock_adjustment.list')
                    </a>
                    @endif
                    @can('purchase.create')
                    <a class="{{ request()->segment(1)=='stock-adjustments' && request()->segment(2)=='create' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\StockAdjustmentController::class, 'create']) }}">
                        @lang('stock_adjustment.add')
                    </a>
                    @endcan
                </ul>

            </li>
            @endif

            {{-- --------------------------- EXPENSES --------------------------- --}}
            @if(in_array('expenses', $enabled_modules) &&
            (auth()->user()->can('all_expense.access') || auth()->user()->can('view_own_expense')))
            @php
            $exp_active = request()->segment(1)=='expenses'
            || request()->segment(1)=='expense-categories'
            || request()->segment(1)=='import-expense';
            @endphp
            <li class="nav-item toogle-sidebar-submenu {{ $exp_active ? 'open active' : '' }}">
                <a class="nav-link toogle-sidebar-submenu-flex" href="#">

                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16l-3-2l-2 2l-2-2l-2 2l-2-2l-3 2" />
                        <path d="M14.8 8a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1" />
                        <path d="M12 6v10" />
                    </svg>
                    <h3>@lang('expense.expenses')</h3>
                    <span class="chevron" aria-hidden="true">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </span>
                </a>
                <ul class="side-submenu">
                    <a class="{{ request()->segment(1)=='expenses' || (request()->segment(1)=='import-expense' && !request()->segment(2)) ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\ExpenseController::class, 'index']) }}">
                        @lang('lang_v1.list_expenses')
                    </a>
                    @can('expense.add')
                    <a class="{{ request()->segment(1)=='expenses' && request()->segment(2)=='create' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\ExpenseController::class, 'create']) }}">
                        @lang('expense.add_expense')
                    </a>
                    @endcan
                    @if(auth()->user()->can('expense.add') || auth()->user()->can('expense.edit'))
                    <a class="{{ request()->segment(1)=='expense-categories' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\ExpenseCategoryController::class, 'index']) }}">
                        @lang('expense.expense_categories')
                    </a>
                    @endif
                </ul>

            </li>
            @endif

            {{-- --------------------------- ACCOUNTS --------------------------- --}}
            @if(auth()->user()->can('account.access') && in_array('account', $enabled_modules))
            @php
            $acc_active = request()->segment(1)=='account';
            @endphp
            <li class="nav-item toogle-sidebar-submenu {{ $acc_active ? 'open active' : '' }}">
                <a class="nav-link toogle-sidebar-submenu-flex" href="#">

                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 5a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3H6a3 3 0 0 1 -3-3z" />
                        <path d="M3 10h18" />
                        <path d="M7 15h.01" />
                        <path d="M11 15h2" />
                    </svg>
                    <h3>@lang('lang_v1.payment_accounts')</h3>
                    <span class="chevron" aria-hidden="true">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </span>
                </a>
                <ul class="side-submenu">
                    <a class="{{ request()->segment(1)=='account' && request()->segment(2)=='account' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\AccountController::class, 'index']) }}">
                        @lang('account.list_accounts')
                    </a>
                    <a class="{{ request()->segment(1)=='account' && request()->segment(2)=='balance-sheet' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\AccountReportsController::class, 'balanceSheet']) }}">
                        @lang('account.balance_sheet')
                    </a>
                    <a class="{{ request()->segment(1)=='account' && request()->segment(2)=='trial-balance' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\AccountReportsController::class, 'trialBalance']) }}">
                        @lang('account.trial_balance')
                    </a>
                    <a class="{{ request()->segment(1)=='account' && request()->segment(2)=='cash-flow' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\AccountController::class, 'cashFlow']) }}">
                        @lang('lang_v1.cash_flow')
                    </a>
                    <a class="{{ request()->segment(1)=='account' && request()->segment(2)=='payment-account-report' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\AccountReportsController::class, 'paymentAccountReport']) }}">
                        @lang('account.payment_account_report')
                    </a>
                </ul>

            </li>
            @endif

            {{-- --------------------------- REPORTS ---------------------------- --}}
            @if(
            auth()->user()->can('purchase_n_sell_report.view') || auth()->user()->can('contacts_report.view')
            || auth()->user()->can('stock_report.view') || auth()->user()->can('tax_report.view')
            || auth()->user()->can('trending_product_report.view')
            || auth()->user()->can('sales_representative.view') || auth()->user()->can('register_report.view')
            || auth()->user()->can('expense_report.view')
            )
            @php
            $rep_active = request()->segment(2) && request()->segment(1)=='reports';
            @endphp
            <li class="nav-item toogle-sidebar-submenu {{ $rep_active ? 'open active' : '' }}">
                <a class="nav-link toogle-sidebar-submenu-flex" href="#" id="tour_step8">

                    <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 5H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h5.697" />
                        <path d="M18 14v4h4" />
                        <path d="M18 11V7a2 2 0 0 0-2-2h-2" />
                        <rect x="6" y="3" width="6" height="4" rx="2" />
                        <circle cx="18" cy="18" r="4" />
                        <path d="M8 11h4M8 15h3" />
                    </svg>
                    <h3>@lang('report.reports')</h3>
                    <span class="chevron" aria-hidden="true">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </span>
                </a>
                <ul class="side-submenu">
                    {{-- Profit & loss --}}
                    @can('profit_loss_report.view')
                    <a class="{{ request()->segment(2)=='profit-loss' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\ReportController::class, 'getProfitLoss']) }}">
                        @lang('report.profit_loss')
                    </a>
                    @endcan
                    {{-- Report 606 & 607 (only if enabled in config/constants) --}}
                    @if(config('constants.show_report_606'))
                    <a class="{{ request()->segment(2)=='purchase-report' ? 'active' : '' }}"
                        href="{{ action([\App\Http\Controllers\ReportController::class, 'purchaseReport']) }}">
                        {{ 'Report 606 (' . __('lang_v1.purchase') . ')' }}
                    </a>
            </li>
            @endif
            @if(config('constants.show_report_607'))
            <a class="{{ request()->segment(2)=='sale-report' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'saleReport']) }}">
                {{ 'Report 607 (' . __('business.sale') . ')' }}
            </a>
            </li>
            @endif
            {{-- Purchase & sell --}}
            @if(
            (in_array('purchases', $enabled_modules) || in_array('add_sale', $enabled_modules) || in_array('pos_sale',
            $enabled_modules))
            && auth()->user()->can('purchase_n_sell_report.view')
            )
            <a class="{{ request()->segment(2)=='purchase-sell' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'getPurchaseSell']) }}">
                @lang('report.purchase_sell_report')
            </a>
            @endif
            {{-- Tax report --}}
            @can('tax_report.view')
            <a class="{{ request()->segment(2)=='tax-report' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'getTaxReport']) }}">
                @lang('report.tax_report')
            </a>
            @endcan
            {{-- Contacts report --}}
            @can('contacts_report.view')
            <a class="{{ request()->segment(2)=='customer-supplier' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'getCustomerSuppliers']) }}">
                @lang('report.contacts')
            </a>
            <a class="{{ request()->segment(2)=='customer-group' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'getCustomerGroup']) }}">
                @lang('lang_v1.customer_groups_report')
            </a>
            @endcan
            {{-- Stock related --}}
            @can('stock_report.view')
            <a class="{{ request()->segment(2)=='stock-report' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'getStockReport']) }}">
                @lang('report.stock_report')
            </a>
            @if(session('business.enable_product_expiry'))
            <a class="{{ request()->segment(2)=='stock-expiry' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'getStockExpiryReport']) }}">
                @lang('report.stock_expiry_report')
            </a>

            @endif
            @if(session('business.enable_lot_number'))

            <a class="{{ request()->segment(2)=='lot-report' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'getLotReport']) }}">
                @lang('lang_v1.lot_report')
            </a>

            @endif
            @if(in_array('stock_adjustment', $enabled_modules))

            <a class="{{ request()->segment(2)=='stock-adjustment-report' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'getStockAdjustmentReport']) }}">
                @lang('report.stock_adjustment_report')
            </a>
            @endif
            @endcan
            {{-- Trending products --}}
            @can('trending_product_report.view')
            <a class="{{ request()->segment(2)=='trending-products' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'getTrendingProducts']) }}">
                @lang('report.trending_products')
            </a>
            @endcan
            {{-- Items / product purchase / sell / payments --}}
            @can('purchase_n_sell_report.view')
            <a class="{{ request()->segment(2)=='items-report' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'itemsReport']) }}">
                @lang('lang_v1.items_report')
            </a>
            <a class="{{ request()->segment(2)=='product-purchase-report' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'getproductPurchaseReport']) }}">
                @lang('lang_v1.product_purchase_report')
            </a>
            <a class="{{ request()->segment(2)=='product-sell-report' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'getproductSellReport']) }}">
                @lang('lang_v1.product_sell_report')
            </a>
            <a class="{{ request()->segment(2)=='purchase-payment-report' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'purchasePaymentReport']) }}">
                @lang('lang_v1.purchase_payment_report')
            </a>
            <a class="{{ request()->segment(2)=='sell-payment-report' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'sellPaymentReport']) }}">
                @lang('lang_v1.sell_payment_report')
            </a>
            @endcan
            {{-- Expenses --}}
            @if(in_array('expenses', $enabled_modules) && auth()->user()->can('expense_report.view'))
            <a class="{{ request()->segment(2)=='expense-report' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'getExpenseReport']) }}">
                @lang('report.expense_report')
            </a>
            @endif
            {{-- Register --}}
            @can('register_report.view')
            <a class="{{ request()->segment(2)=='register-report' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'getRegisterReport']) }}">
                @lang('report.register_report')
            </a>
            @endcan
            {{-- Sales representative --}}
            @can('sales_representative.view')
            <a class="{{ request()->segment(2)=='sales-representative-report' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'getSalesRepresentativeReport']) }}">
                @lang('report.sales_representative')
            </a>
            @endcan
            {{-- Table report --}}
            @if(auth()->user()->can('purchase_n_sell_report.view') && in_array('tables', $enabled_modules))
            <a class="{{ request()->segment(2)=='table-report' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'getTableReport']) }}">
                @lang('restaurant.table_report')
            </a>
            @endif
            {{-- GST reports (India) --}}
            @if(auth()->user()->can('tax_report.view') && config('constants.enable_gst_report_india'))
            <a class="{{ request()->segment(2)=='gst-sales-report' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'gstSalesReport']) }}">
                @lang('lang_v1.gst_sales_report')
            </a>
            <a class="{{ request()->segment(2)=='gst-purchase-report' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'gstPurchaseReport']) }}">
                @lang('lang_v1.gst_purchase_report')
            </a>
            @endif
            {{-- Service staff --}}
            @if(auth()->user()->can('sales_representative.view') && in_array('service_staff', $enabled_modules))
            <a class="{{ request()->segment(2)=='service-staff-report' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'getServiceStaffReport']) }}">
                @lang('restaurant.service_staff_report')
            </a>
            @endif
            {{-- Activity log (admin) --}}
            @if($is_admin)
            <a class="{{ request()->segment(2)=='activity-log' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\ReportController::class, 'activityLog']) }}">
                @lang('lang_v1.activity_log')
            </a>
            @endif
        </ul>

        </li>
        @endif

        {{-- --------------------------- BACKUP ----------------------------- --}}
        @can('backup')
        <li class="nav-item toogle-sidebar-submenu">
            <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1)=='backup' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\BackUpController::class, 'index']) }}">

                <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M12 18h-5.343c-2.572-.004-4.657-2.011-4.657-4.487c0-2.475 2.085-4.482 4.657-4.482C7.05 7.269 8.45 5.831 10.332 5.258a5 5 0 0 1 5.444 1c1.488 1.19 2.162 3.007 1.77 4.769h.99c1.38 0 2.57.811 3.128 1.986" />
                    <path d="M19 22v-6" />
                    <path d="M22 19l-3-3-3 3" />
                </svg>
                <h3>@lang('lang_v1.backup')</h3>

            </a>
        </li>
        @endcan

        {{-- --------------------------- MODULES ---------------------------- --}}
        @can('manage_modules')
        <li class="nav-item toogle-sidebar-submenu">
            <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1)=='manage-modules' ? 'active' : '' }}"
                href="{{ action([\App\Http\Controllers\Install\ModulesController::class, 'index']) }}">

                <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 4l-8 4l8 4l8-4l-8-4" />
                    <path d="M4 12l8 4l8-4" />
                    <path d="M4 16l8 4l8-4" />
                </svg>
                <h3>@lang('lang_v1.modules')</h3>
            </a>
        </li>
        @endcan

        {{-- ------------------- BOOKING / KITCHEN / ORDERS ----------------- --}}
        @if(in_array('booking', $enabled_modules) && (auth()->user()->can('crud_all_bookings') ||
        auth()->user()->can('crud_own_bookings')))
        <li class="nav-item toogle-sidebar-submenu  {{ request()->segment(1)=='bookings' ? 'active' : '' }}">
            <a class="nav-link toogle-sidebar-submenu-flex"
                href="{{ action([\App\Http\Controllers\Restaurant\BookingController::class, 'index']) }}">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="icon icon-tabler"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M11.5 21H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6" />
                    <path d="M16 3v4" />
                    <path d="M8 3v4" />
                    <path d="M4 11h16" />
                    <path d="M15 19l2 2l4 -4" />
                </svg>
                <h3>@lang('restaurant.bookings')</h3>
            </a>
        </li>
        @endif

        @if(in_array('kitchen', $enabled_modules))
        <li
            class="nav-item toogle-sidebar-submenu {{ request()->segment(1)=='modules' && request()->segment(2)=='kitchen' ? 'active' : '' }}">
            <a class="nav-link toogle-sidebar-submenu-flex"
                href="{{ action([\App\Http\Controllers\Restaurant\KitchenController::class, 'index']) }}">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="icon icon-tabler"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M12 12c2 -2.96 0 -7 -1 -8c0 3.038 -1.773 4.741 -3 6c-1.226 1.26 -2 3.24 -2 5a6 6 0 1 0 12 0c0 -1.532 -1.056 -3.94 -2 -5c-1.786 3 -2.791 3 -4 2z" />
                </svg>
                <h3>@lang('restaurant.kitchen')</h3>
            </a>
        </li>
        @endif

        @if(in_array('service_staff', $enabled_modules))
        <li
            class="nav-item toogle-sidebar-submenu {{ request()->segment(1)=='modules' && request()->segment(2)=='orders' ? 'active' : '' }}">
            <a class="nav-link toogle-sidebar-submenu-flex"
                href="{{ action([\App\Http\Controllers\Restaurant\OrderController::class, 'index']) }}">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="18" class="icon icon-tabler"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 20h16" />
                    <path d="M4 12h16" />
                    <path d="M4 4h16" />
                </svg>
                <h3>@lang('restaurant.orders')</h3>
            </a>
        </li>
        @endif

        {{-- ------------------ NOTIFICATION TEMPLATES ---------------------- --}}
        @can('send_notifications')
        <li
            class="nav-item toogle-sidebar-submenu {{ request()->segment(1)=='notification-templates' ? 'active' : '' }}">
            <a class="nav-link toogle-sidebar-submenu-flex"
                href="{{ action([\App\Http\Controllers\NotificationTemplateController::class, 'index']) }}">

                <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <rect x="3" y="7" width="18" height="10" rx="2" />
                    <path d="M3 7l9 6l9-6" />
                </svg>
                <h3>@lang('lang_v1.notification_templates')</h3>
            </a>
        </li>
        @endcan

         {{-- --------------------------- Application SETTINGS --------------------------- --}}
         @if(auth()->user()->can('superadmin'))
        @php
        $set_active = in_array(request()->segment(1)=='app' && request()->segment(2), ['menus','settings','locked-users','migration'] );
        @endphp
        <li class="nav-item toogle-sidebar-submenu {{ $set_active ? 'open active' : '' }}">
            <a class="nav-link toogle-sidebar-submenu-flex" href="#" id="tour_step3">
                <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 32 32" stroke-width="0" stroke="currentColor" fill="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M16 18H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2M6 6v10h10V6Zm20 6v4h-4v-4zm0-2h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2m0 12v4h-4v-4zm0-2h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2m-10 2v4h-4v-4zm0-2h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2"/></svg>
                <h3>@lang('settings.application_settings')</h3>
                <span class="chevron" aria-hidden="true">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9" />
                    </svg>
                </span>
            </a>
            <ul class="side-submenu">
                @can('superadmin')
                <a class="{{ request()->segment(1)=='app' && request()->segment(2)=='settings' ? 'active' : '' }}"
                    href="/app/settings">
                    @lang('settings.app_settings')
                </a>
                <a class="{{request()->segment(1)=='app' && request()->segment(2)=='locked-users' ? 'active' : '' }}"
                    href="{{ url('/app/locked-users') }}">
                    @lang('settings.locked_users')
                </a>
                 <a class="{{request()->segment(1)=='app' && request()->segment(2)=='otp-verification' ? 'active' : '' }}"
                    href="{{ url('/app/otp-verification') }}">
                    @lang('settings.otp_verification')
                </a>
                <a class="{{request()->segment(1)=='app' && request()->segment(2)=='menus' ? 'active' : '' }}"
                    href="{{ url('/app/menus') }}">
                    @lang('settings.custom_menu')
                </a>
                <a class="{{request()->segment(1)=='app' && request()->segment(2)=='migration' ? 'active' : '' }}"
                    href="{{ url('/app/migration') }}">
                    @lang('settings.storage_migration')
                </a>
                <a class="{{request()->segment(1)=='app' && request()->segment(2)=='session-management' ? 'active' : '' }}"
                    href="{{ url('/app/session-management') }}">
                    @lang('settings.session_management')
                </a>
                @endcan
                
            </ul>
        </li>
        @endif

        {{-- --------------------------- SETTINGS --------------------------- --}}
        @if(
        auth()->user()->can('business_settings.access') ||
        auth()->user()->can('barcode_settings.access') ||
        auth()->user()->can('invoice_settings.access') ||
        auth()->user()->can('tax_rate.view') ||
        auth()->user()->can('tax_rate.create') ||
        auth()->user()->can('access_package_subscriptions')
        )
        @php
        $set_active = in_array(request()->segment(1), [
        'business','business-location','invoice-schemes','invoice-layouts',
        'barcodes','printers','tax-rates','modules','types-of-service'
        ]);
        @endphp
        <li class="nav-item toogle-sidebar-submenu {{ $set_active ? 'open active' : '' }}">
            <a class="nav-link toogle-sidebar-submenu-flex" href="#" id="tour_step3">
                <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543 .826-3.31 2.37-2.37c1 .608 2.296.07 2.572 -1.065z" />
                    <circle cx="12" cy="12" r="3" />
                </svg>
                <h3>@lang('business.settings')</h3>
                <span class="chevron" aria-hidden="true">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9" />
                    </svg>
                </span>
            </a>
            <ul class="side-submenu">
                {{-- Business settings / locations --}}
                @can('business_settings.access')
                <a id="tour_step2" class="{{ request()->segment(1)=='business' ? 'active' : '' }}"
                    href="/business/settings">
                    @lang('business.business_settings')
                </a>
                <a class="{{ request()->segment(1)=='business-location' ? 'active' : '' }}"
                    href="{{ action([\App\Http\Controllers\BusinessLocationController::class, 'index']) }}">
                    @lang('business.business_locations')
                </a>
                @endcan
                {{-- Invoice settings --}}
                @can('invoice_settings.access')
                <a class="{{ in_array(request()->segment(1), ['invoice-schemes','invoice-layouts']) ? 'active' : '' }}"
                    href="{{ action([\App\Http\Controllers\InvoiceSchemeController::class, 'index']) }}">
                    @lang('invoice.invoice_settings')
                </a>
                @endcan
                {{-- Barcode settings --}}
                @can('barcode_settings.access')
                <a class="{{ request()->segment(1)=='barcodes' ? 'active' : '' }}"
                    href="{{ action([\App\Http\Controllers\BarcodeController::class, 'index']) }}">
                    @lang('barcode.barcode_settings')
                </a>
                @endcan
                {{-- Printers --}}
                @can('access_printers')
                <a class="{{ request()->segment(1)=='printers' ? 'active' : '' }}"
                    href="{{ action([\App\Http\Controllers\PrinterController::class, 'index']) }}">
                    @lang('printer.receipt_printers')
                </a>
                @endcan
                {{-- Tax rates --}}
                @if(auth()->user()->can('tax_rate.view') || auth()->user()->can('tax_rate.create'))
                <a class="{{ request()->segment(1)=='tax-rates' ? 'active' : '' }}"
                    href="{{ action([\App\Http\Controllers\TaxRateController::class, 'index']) }}">
                    @lang('tax_rate.tax_rates')
                </a>
                @endif
                {{-- Restaurant specific --}}
                @if(in_array('tables', $enabled_modules) && auth()->user()->can('access_tables'))
                <a class="{{ request()->segment(1)=='modules' && request()->segment(2)=='tables' ? 'active' : '' }}"
                    href="{{ action([\App\Http\Controllers\Restaurant\TableController::class, 'index']) }}">
                    @lang('restaurant.tables')
                </a>
                @endif
                @if(in_array('modifiers', $enabled_modules) && (auth()->user()->can('product.view') ||
                auth()->user()->can('product.create')))
                <a class="{{ request()->segment(1)=='modules' && request()->segment(2)=='modifiers' ? 'active' : '' }}"
                    href="{{ action([\App\Http\Controllers\Restaurant\ModifierSetsController::class, 'index']) }}">
                    @lang('restaurant.modifiers')
                </a>
                @endif
                @if(in_array('types_of_service', $enabled_modules) && auth()->user()->can('access_types_of_service'))
                <a class="{{ request()->segment(1)=='types-of-service' ? 'active' : '' }}"
                    href="{{ action([\App\Http\Controllers\TypesOfServiceController::class, 'index']) }}">
                    @lang('lang_v1.types_of_service')
                </a>
                @endif
                @if (Module::has('Superadmin') && auth()->user()->can('access_package_subscriptions'))
                <a class="{{ request()->segment(1)=='subscription' ? 'active' : '' }}" href="{{ url('subscription') }}">
                    @lang('lang_v1.subscription')
                </a>
                @endif
            </ul>
        </li>
        @endif
        <div class="divider">
            <div class="rect"></div>
            <span>@lang('lang_v1.premium_modules')</span>
        </div>
        {{-- ------------------- ACCOUNTING MODULE GROUP ------------------- --}}
        @if(Module::has('Accounting') && $is_accounting_enabled)
        @php
        $accounting_active = (request()->segment(1) == 'accounting' && in_array(request()->segment(2),
        ['chart-of-accounts', 'transfer', 'journal-entry', 'budget', 'dashboard', 'transactions', 'reports'])) ||
        (request()->segment(2) == 'account-sub-type' || request()->segment(2) == 'account-detail-type') ||
        (Module::has('PaymentReconciliation') && $is_paymentreconciliation_enabled && request()->segment(1) ==
        'payment-reconciliation');
        @endphp
        <li class="nav-item toogle-sidebar-submenu {{ $accounting_active ? 'open active' : '' }}">
            <a class="nav-link toogle-sidebar-submenu-flex" href="#">

                <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <rect x="4" y="4" width="16" height="16" rx="2" />
                    <rect x="9" y="9" width="6" height="6" />
                    <path d="M15 3v18M9 3v18M3 9h18M3 15h18" />
                </svg>
                <h3>@lang('accounting::lang.accounting')</h3>
                <span class="chevron" aria-hidden="true">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9" />
                    </svg>
                </span>
            </a>
            <ul class="side-submenu">
                @if(auth()->user()->can('accounting.manage_accounts'))
                <a class="{{ request()->segment(2) == 'chart-of-accounts' || request()->segment(2) == 'transfer' || request()->segment(2) == 'account-sub-type' || request()->segment(2) == 'account-detail-type' ? 'active' : '' }}"
                    href="{{action([\Modules\Accounting\Http\Controllers\CoaController::class, 'index'])}}">
                    @lang('accounting::lang.chart_of_accounts')
                </a>
                @endif
                @if(auth()->user()->can('accounting.view_journal'))
                <a class="{{ request()->segment(2) == 'journal-entry' ? 'active' : '' }}"
                    href="{{action([\Modules\Accounting\Http\Controllers\JournalEntryController::class, 'index'])}}">
                    @lang('accounting::lang.journal_entry')
                </a>
                @endif
                @if(auth()->user()->can('accounting.manage_budget'))
                <a class="{{ request()->segment(2) == 'budget' ? 'active' : '' }}"
                    href="{{action([\Modules\Accounting\Http\Controllers\BudgetController::class, 'index'])}}">
                    @lang('accounting::lang.budget')
                </a>
                @endif
                @if(auth()->user()->can('accounting.access_accounting_module'))
                <a class="{{ (request()->segment(1) == 'accounting' && request()->segment(2) == 'dashboard') || request()->segment(2) == 'transactions' ? 'active' : '' }}"
                    href="{{ action('\Modules\Accounting\Http\Controllers\AccountingController@dashboard') }}">
                    @lang('lang_v1.account_overview')
                </a>
                @endif
                @if(Module::has('PaymentReconciliation') && $is_paymentreconciliation_enabled)
                <a class="{{ request()->segment(1) == 'payment-reconciliation' ? 'active' : '' }}"
                    href="{{ action([\Modules\PaymentReconciliation\Http\Controllers\PaymentReconciliationController::class, 'index']) }}">
                    @lang('paymentreconciliation::lang.payment_reconciliation')
                </a>
                @endif
            </ul>
        </li>
        @endif

        {{--Manufacturing--}}
        @if($is_mfg_enabled && (auth()->user()->can('manufacturing.access_recipe') ||
        auth()->user()->can('manufacturing.access_production')))
        <li class="nav-item toogle-sidebar-submenu">
            <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1) == 'manufacturing' ? 'active' : '' }}"
                href="{{ action('\Modules\Manufacturing\Http\Controllers\RecipeController@index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-size-20" width="20" height="20" stroke-width="32"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    viewBox="0 0 576 512">
                    <path
                        d="M64 32C46.3 32 32 46.3 32 64l0 240 0 48 0 80c0 26.5 21.5 48 48 48l416 0c26.5 0 48-21.5 48-48l0-128 0-151.8c0-18.2-19.4-29.7-35.4-21.1L352 215.4l0-63.2c0-18.2-19.4-29.7-35.4-21.1L160 215.4 160 64c0-17.7-14.3-32-32-32L64 32z" />
                </svg>
                <h3>@lang('manufacturing::lang.manufacturing')</h3>
            </a>
        </li>
        @endif
        {{-- Repair Module --}}
        @php
        $user = auth()->user();
        $hasRepairPermission = $user->can('superadmin') || $user->can('repair.view') ||
        $user->can('job_sheet.view_assigned') || $user->can('job_sheet.view_all');
        @endphp
        @if ($is_repair_enabled && $hasRepairPermission)
        <li class="nav-item toogle-sidebar-submenu">
            <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1) == 'repair' && request()->segment(2) != 'payroll' ? 'active' : '' }}"
                href="{{ action('\Modules\Repair\Http\Controllers\DashboardController@index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-size-20" width="20" height="20" stroke-width="32"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    viewBox="0 0 512 512">
                    <path
                        d="M352 320c88.4 0 160-71.6 160-160c0-15.3-2.2-30.1-6.2-44.2c-3.1-10.8-16.4-13.2-24.3-5.3l-76.8 76.8c-3 3-7.1 4.7-11.3 4.7L336 192c-8.8 0-16-7.2-16-16l0-57.4c0-4.2 1.7-8.3 4.7-11.3l76.8-76.8c7.9-7.9 5.4-21.2-5.3-24.3C382.1 2.2 367.3 0 352 0C263.6 0 192 71.6 192 160c0 19.1 3.4 37.5 9.5 54.5L19.9 396.1C7.2 408.8 0 426.1 0 444.1C0 481.6 30.4 512 67.9 512c18 0 35.3-7.2 48-19.9L297.5 310.5c17 6.2 35.4 9.5 54.5 9.5zM80 408a24 24 0 1 1 0 48 24 24 0 1 1 0-48z" />
                </svg>
                <h3>@lang('repair::lang.repair')</h3>
            </a>
        </li>
        @endif

        {{-- Woocommerce Module --}}
        @if($is_woocommerce_enabled && (auth()->user()->can('woocommerce.syc_categories') ||
        auth()->user()->can('woocommerce.sync_products') || auth()->user()->can('woocommerce.sync_orders') ||
        auth()->user()->can('woocommerce.map_tax_rates') ||
        auth()->user()->can('woocommerce.access_woocommerce_api_settings')))
        <li class="nav-item toogle-sidebar-submenu">
            <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1) == 'woocommerce' ? 'active' : '' }}"
                href="{{ action([\Modules\Woocommerce\Http\Controllers\WoocommerceController::class, 'index']) }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 -51.5 256 256"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M232.138 0H23.759C10.572 0-.103 10.78.001 23.862v79.542c0 13.187 10.676 23.863 23.863 23.863h98.694l45.11 25.118-10.258-25.118h74.728c13.187 0 23.862-10.676 23.862-23.863V23.862C256 10.675 245.325 0 232.138 0M19.364 18.42c-2.93.21-5.128 1.256-6.594 3.245-1.465 1.883-1.988 4.29-1.674 7.012q9.262 58.871 17.269 79.437c2.093 5.023 4.5 7.431 7.326 7.222 4.396-.315 9.629-6.385 15.804-18.211q4.867-10.048 15.07-30.143c5.652 19.781 13.397 34.643 23.13 44.586 2.722 2.825 5.548 4.081 8.268 3.872 2.408-.21 4.292-1.465 5.548-3.768q1.57-2.982 1.256-6.907c-.628-9.524.314-22.816 2.93-39.876 2.721-17.583 6.07-30.247 10.152-37.782.837-1.57 1.151-3.14 1.047-5.024-.21-2.407-1.256-4.395-3.245-5.965-1.988-1.57-4.186-2.303-6.593-2.094-3.035.21-5.338 1.675-6.908 4.605-6.489 11.827-11.094 30.98-13.815 57.563C84.358 66.145 81.01 54.32 78.392 40.4c-1.15-6.175-3.977-9.106-8.582-8.792q-4.71.315-7.85 6.28L39.04 81.53c-3.768-15.176-7.326-33.7-10.57-55.574q-1.1-8.164-9.106-7.536m201.68 7.536c7.431 1.57 12.978 5.547 16.746 12.14 3.349 5.652 5.023 12.455 5.023 20.619 0 10.78-2.72 20.618-8.163 29.618-6.28 10.467-14.443 15.7-24.595 15.7q-2.67 0-5.652-.629c-7.43-1.57-12.978-5.546-16.746-12.14q-5.023-8.634-5.023-20.723 0-16.17 8.163-29.514c6.385-10.466 14.548-15.699 24.596-15.699q2.669 0 5.651.628m-4.395 56.62c3.872-3.453 6.488-8.581 7.954-15.489.418-2.407.732-5.023.732-7.744 0-3.036-.628-6.28-1.884-9.525-1.57-4.081-3.663-6.28-6.175-6.802-3.767-.733-7.43 1.36-10.884 6.489-2.826 3.977-4.606 8.163-5.547 12.454-.524 2.407-.733 5.024-.733 7.64 0 3.035.628 6.28 1.884 9.524 1.57 4.082 3.663 6.28 6.175 6.803 2.616.523 5.442-.628 8.478-3.35m-44.481-44.48c-3.768-6.593-9.42-10.57-16.746-12.14q-2.983-.628-5.652-.628c-10.047 0-18.21 5.233-24.595 15.7q-8.164 13.343-8.163 29.513 0 12.09 5.023 20.723c3.768 6.594 9.315 10.57 16.746 12.14q2.982.628 5.652.628c10.152 0 18.315-5.232 24.595-15.699 5.442-9 8.163-18.839 8.163-29.618 0-8.164-1.675-14.967-5.023-20.618M158.98 67.088c-1.465 6.908-4.082 12.036-7.954 15.49-3.035 2.721-5.86 3.872-8.477 3.35-2.512-.524-4.606-2.722-6.175-6.804-1.256-3.244-1.884-6.489-1.884-9.524 0-2.616.209-5.233.733-7.64.941-4.291 2.72-8.477 5.546-12.454 3.455-5.129 7.118-7.222 10.885-6.49 2.512.524 4.605 2.722 6.175 6.803 1.256 3.245 1.884 6.49 1.884 9.525 0 2.72-.21 5.337-.733 7.744" />
                </svg>
                <h3>@lang('woocommerce::lang.woocommerce')</h3>
            </a>
        </li>
        @endif

        {{-- Project Module --}}
        @if(Module::has('Project') && $is_project_enabled)
        <li class="nav-item toogle-sidebar-submenu">
            <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1) == 'project' ? 'active' : '' }}"
                href="{{ action([\Modules\Project\Http\Controllers\ProjectController::class, 'index']) }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-size-20" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-brand-asana">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M12 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                    <path d="M17 16m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                    <path d="M7 16m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                </svg>
                <h3>@lang('project::lang.project')</h3>
            </a>
        </li>
        @endif

        {{-- ProductCatalogue --}}
        @if($is_productcatalogue_enabled)
        <li class="nav-item toogle-sidebar-submenu">
            <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1) == 'product-catalogue' ? 'active' : '' }}"
                href="{{ action([\Modules\ProductCatalogue\Http\Controllers\ProductCatalogueController::class, 'generateQr'])}}">

                <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <rect x="4" y="4" width="6" height="6" rx="1" />
                    <path d="M7 17l0 .01" />
                    <rect x="14" y="4" width="6" height="6" rx="1" />
                    <path d="M7 7l0 .01" />
                    <rect x="4" y="14" width="6" height="6" rx="1" />
                    <path d="M17 7l0 .01" />
                    <path d="M14 14l3 0" />
                    <path d="M20 14l0 .01" />
                    <path d="M14 14l0 3" />
                    <path d="M14 20l3 0" />
                    <path d="M17 20l3 0" />
                    <path d="M20 17l0 3" />
                </svg>
                <h3>@lang('productcatalogue::lang.catalogue_qr')</h3>
            </a>
        </li>
        @endif

        {{-- CMS Module --}}
        @if(auth()->user()->can('superadmin') && Module::has('Cms'))
        <li class="nav-item toogle-sidebar-submenu">
            <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1) == 'cms' ? 'active' : '' }}"
                href="{{ action([\Modules\Cms\Http\Controllers\CmsController::class, 'index']) }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-size-20" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M0 0h24v24H0z" stroke="none" />
                    <path
                        d="m17.8 20-12-1.5c-1-.1-1.8-.9-1.8-1.9V7.4c0-1 .8-1.8 1.8-1.9l12-1.5c1.2-.1 2.2.8 2.2 1.9V18c0 1.2-1.1 2.1-2.2 1.9zM12 5v14m-8-7h16" />
                </svg>
                <h3>@lang('cms::lang.cms')</h3>
            </a>
        </li>
        @endif

        {{-- Connector/API Module --}}
        @if (auth()->user()->can('superadmin') && $is_connector_enabled)
        <li class="nav-item toogle-sidebar-submenu">
            <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1) == 'connector' ? 'active' : '' }}"
                href="{{ action([\Modules\Connector\Http\Controllers\ClientController::class, 'index']) }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-size-20" width="20" height="20" stroke-width="32"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    viewBox="0 0 576 512">
                    <path
                        d="M96 0C78.3 0 64 14.3 64 32l0 96 64 0 0-96c0-17.7-14.3-32-32-32zM288 0c-17.7 0-32 14.3-32 32l0 96 64 0 0-96c0-17.7-14.3-32-32-32zM32 160c-17.7 0-32 14.3-32 32s14.3 32 32 32l0 32c0 77.4 55 142 128 156.8l0 67.2c0 17.7 14.3 32 32 32s32-14.3 32-32l0-67.2c12.3-2.5 24.1-6.4 35.1-11.5c-2.1-10.8-3.1-21.9-3.1-33.3c0-80.3 53.8-148 127.3-169.2c.5-2.2 .7-4.5 .7-6.8c0-17.7-14.3-32-32-32L32 160zM432 512a144 144 0 1 0 0-288 144 144 0 1 0 0 288zm47.9-225c4.3 3.7 5.4 9.9 2.6 14.9L452.4 356l35.6 0c5.2 0 9.8 3.3 11.4 8.2s-.1 10.3-4.2 13.4l-96 72c-4.5 3.4-10.8 3.2-15.1-.6s-5.4-9.9-2.6-14.9L411.6 380 376 380c-5.2 0-9.8-3.3-11.4-8.2s.1-10.3 4.2-13.4l96-72c4.5-3.4 10.8-3.2 15.1 .6z" />
                </svg>
                <h3>@lang('connector::lang.connector_clients')</h3>
            </a>
        </li>
        @endif

        {{-- Desktop App Module --}}
        @if (auth()->user()->can('superadmin') && $is_desktopapp_enabled)
        <li class="nav-item toogle-sidebar-submenu">
            <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1) == 'desktopapp' ? 'active' : '' }}"
                href="{{ action([\Modules\Desktopapp\Http\Controllers\ClientController::class, 'index']) }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" stroke-width="1.5" class="icon-size-20"
                    viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path
                        d="M3.5 8c0-.957.001-1.624.069-2.128.066-.49.186-.748.37-.933.185-.184.444-.304.933-.37C5.376 4.5 6.043 4.5 7 4.5h10c.957 0 1.624.001 2.128.069.49.066.748.186.933.37.184.185.305.444.37.933.068.504.069 1.171.069 2.128v8.5h-17zm.167 8.5c-.645 0-1.167.522-1.167 1.167 0 1.012.82 1.833 1.833 1.833h15.334c1.012 0 1.833-.82 1.833-1.833 0-.645-.522-1.167-1.167-1.167z" />
                </svg>
                <h3>@lang('desktopapp::lang.desktopapp_clients')</h3>
            </a>
        </li>
        @endif

        {{-- Spreadsheet Module --}}
        @if(Module::has('Spreadsheet') && $is_spreadsheet_enabled)
        <li class="nav-item toogle-sidebar-submenu">
            <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1) == 'spreadsheet' ? 'active' : '' }}"
                href="{{ action([\Modules\Spreadsheet\Http\Controllers\SpreadsheetController::class, 'index']) }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-size-20" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-file-percent">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M10 17l4 -4" />
                    <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                    <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                    <path d="M10 13h.01" />
                    <path d="M14 17h.01" />
                </svg>
                <h3>@lang('spreadsheet::lang.spreadsheet')</h3>
            </a>
        </li>
        @endif

        {{-- Hotel Management System Module --}}
        @if($is_hms_enabled)
        <li class="nav-item toogle-sidebar-submenu">
            <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1) == 'hms' ? 'active' : '' }}"
                href="{{ action([\Modules\Hms\Http\Controllers\HmsController::class, 'index']) }}">
                <svg fill="currentColor" class="icon-size-20" height="24" width="24" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 430.96 430.96" xml:space="preserve" stroke="#fff">
                    <g stroke-width="0" />
                    <g stroke-linecap="round" stroke-linejoin="round" stroke="CCCCCC" stroke-width="1.724" />
                    <path
                        d="M286.304 373.835v12.522a8 8 0 0 1-8 8h-52.768a8 8 0 0 1-8-8v-45.102a8 8 0 0 1 16 0v37.102h36.768v-4.522a8 8 0 0 1 16 0zM225.537 97.7a8 8 0 0 0 8-8V75.15h36.766V89.7a8 8 0 0 0 16 0V44.598a8 8 0 0 0-16 0V59.15h-36.766V44.598a8 8 0 0 0-16 0V89.7a8 8 0 0 0 8 8zm52.766 176.665a8 8 0 0 0 0-16h-52.766a8 8 0 0 0-8 8v45.103a8 8 0 0 0 8 8h52.766a8 8 0 0 0 0-16h-44.766v-6.551h18.383a8 8 0 0 0 0-16h-18.383v-6.552zm61.064-251.17v384.566c0 12.79-10.406 23.196-23.196 23.196H190.952c-12.79 0-23.195-10.406-23.195-23.196v-57.344h-60.165v28.112a8 8 0 0 1-16 0v-35.931l-.002-.181q0-.091.002-.181v-35.93a8 8 0 0 1 16 0v28.111h60.165V96.537h-60.165v28.112a8 8 0 0 1-16 0V88.717l-.002-.181q0-.091.002-.181v-35.93a8 8 0 0 1 16 0v28.111h60.165V23.195C167.757 10.405 178.163 0 190.952 0H316.17c12.791 0 23.197 10.405 23.197 23.195zm-16 0c0-3.967-3.229-7.195-7.196-7.195H190.952c-3.967 0-7.195 3.228-7.195 7.195v384.566c0 3.968 3.228 7.196 7.195 7.196H316.17c3.968 0 7.196-3.228 7.196-7.196zm-37.063 114.677c0 16.846-13.705 30.552-30.551 30.552h-7.667c-16.846 0-30.55-13.706-30.55-30.552s13.705-30.55 30.55-30.55h7.667c16.846-.001 30.551 13.704 30.551 30.55zm-16 0c0-8.023-6.527-14.55-14.551-14.55h-7.667c-8.023 0-14.55 6.527-14.55 14.55s6.527 14.552 14.55 14.552h7.667c8.024-.001 14.551-6.528 14.551-14.552zm8 45.99h-52.768a8 8 0 0 0 0 16h18.384v37.102a8 8 0 0 0 16 0v-37.102h18.384a8 8 0 0 0 0-16z" />
                </svg>
                <h3>@lang('hms::lang.hms')</h3>
            </a>
        </li>
        @endif

        {{-- Zatca Module --}}
        @if(Module::has('Zatca') && $is_zatca_enabled)
        <li class="nav-item toogle-sidebar-submenu">
            <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1) == 'zatca' ? 'active' : '' }}"
                href="{{ action([\Modules\Zatca\Http\Controllers\ZatcaController::class, 'index']) }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-size-20" width="24" height="24" stroke-width="20"
                    viewBox="0 0 800 800" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path
                        d="M408.5 54.71c9.142 2.876 18.444 5.08 27.75 7.352q5.29 1.294 10.578 2.598l2.387.578c4.621 1.14 9.104 2.503 13.607 4.042 3.355 1.11 6.757 1.997 10.178 2.876l2.184.571q3.406.89 6.816 1.773 4.5 1.168 9 2.344l2.027.52c3.517.92 6.962 1.948 10.402 3.122 4.516 1.532 9.074 2.742 13.7 3.889l5.135 1.297q3.982.999 7.964 1.994 3.89.976 7.776 1.959l2.374.587c5.034 1.276 9.775 2.925 14.622 4.788 1.52.458 3.047.892 4.586 1.281l2.364.608 2.425.611q2.538.654 5.074 1.313l2.412.624c5.208 1.37 10.334 2.98 15.459 4.634 10.301 3.305 20.692 6.096 31.18 8.742q2.42.614 4.84 1.232 5.828 1.484 11.66 2.955v2c1.147.125 2.295.25 3.477.377 4.392.552 8.61 1.5 12.898 2.584l2.33.58q2.42.603 4.84 1.215c2.447.617 4.896 1.224 7.346 1.83l4.734 1.187 2.185.54a101 101 0 0 1 11.933 3.86c2.48.909 4.98 1.674 7.513 2.424l2.7.801L697 135q.036 40.572.052 81.144.007 18.849.023 37.698c.087 96.642.087 96.642-.454 130.474l-.046 3.33c-.226 15.383-1.097 30.545-4.057 45.675-.602 3.111-1.118 6.232-1.631 9.359-2.424 14.598-5.205 28.985-8.887 43.32h-2l-.324 2.883c-.69 4.802-2.08 9.359-3.489 13.992l-.751 2.566c-1.732 5.754-3.916 11.112-6.436 16.559q-1.512 3.39-3.016 6.785L657 549h-2l-.84 2.16c-3.713 9.09-8.592 17.315-13.976 25.48-2.496 3.794-4.761 7.71-6.993 11.665L632 590h-2l-.758 2.691c-1.298 3.458-2.718 5.465-5.117 8.246l-2.402 2.829-1.312 1.54a242 242 0 0 0-4.602 5.74l-1.632 2.08a886 886 0 0 0-3.19 4.098c-1.284 1.629-2.63 3.208-3.987 4.776h-2l-.773 1.73c-3.598 6.657-9.715 11.833-15.426 16.657-2.028 1.738-2.028 1.738-4.301 4.613-3.16 3.791-6.752 6.811-10.5 10l-1.746 1.549c-4.772 4.231-9.68 8.213-14.754 12.076l-2.145 1.656c-3.433 2.624-6.868 5.078-10.574 7.305-3.427 2.083-5.978 4.534-8.781 7.414a170 170 0 0 1-6.5 4.563c-3.968 2.665-7.785 5.425-11.5 8.437a304 304 0 0 1-5.125 3.75l-2.57 1.86C508 705 508 705 505 705l-.582 1.727c-2.011 3.224-4.917 4.744-8.106 6.648-4.535 2.802-8.704 5.608-12.656 9.207C474.992 730 474.992 730 471 730l-1 3c-2.293 1.684-2.293 1.684-5.187 3.438l-3.036 1.87L459 740c-4.483 2.87-8.633 6.036-12.816 9.316C438.812 755 438.812 755 436 755l-1 3c-2.074 1.465-2.074 1.465-4.687 2.938-3.012 1.727-5.964 3.45-8.813 5.437C419 768 419 768 417 768l-1 3a101 101 0 0 1-5.875 3.938c-3.786 2.367-6.7 4.272-9.125 8.062-3.541-.393-5.01-1.92-7.363-4.465-2.907-2.726-6.304-4.798-9.625-6.984L382 770v-2l-2.059-.727c-3.568-1.544-6.753-3.538-10.003-5.648l-1.854-1.172c-3.43-2.21-6.229-4.562-9.084-7.453a94 94 0 0 0-4.875-2.937c-3.498-1.969-6.498-4.15-9.55-6.758-2.658-2.202-5.496-4.143-8.325-6.117-4.346-3.061-8.573-6.192-12.687-9.563-2.723-2.226-5.35-4.191-8.438-5.875C312 720 312 720 310.117 718.082c-2.231-2.194-4.406-3.595-7.117-5.144-6.262-3.6-6.262-3.6-9-5.938v-2l-2.133-.766c-7.518-3.236-14.239-8.484-20.293-13.937-1.62-1.334-3.229-2.303-5.074-3.297a32.7 32.7 0 0 1-6.562-4.625c-3.372-3.007-6.995-5.596-10.688-8.187-7.266-5.12-14.466-10.38-20.746-16.7-2.39-2.374-4.844-4.427-7.504-6.488-3.602-2.792-6.813-5.743-10-9l-2.395-2.324c-4.846-4.737-9.264-9.57-13.417-14.922-2.598-3.27-5.324-6.414-8.063-9.567-6.9-7.981-13.735-16.093-19.125-25.187a139 139 0 0 0-2.625-3.375c-4.282-5.625-7.745-11.758-11.322-17.843-1.431-2.421-2.9-4.819-4.365-7.22a130 130 0 0 1-5.633-10.398 176 176 0 0 0-2.422-4.766c-3.296-6.335-6.013-12.707-8.365-19.439-1.326-3.723-2.864-7.187-4.694-10.693-2.863-5.609-4.793-11.402-6.699-17.391q-1.002-3.098-2.008-6.195l-.96-2.97a140 140 0 0 0-2.497-6.835c-1.712-4.485-2.798-9.072-3.847-13.75l-.644-2.84c-2.328-10.62-3.9-21.35-5.404-32.112-.281-1.733-.58-3.466-.964-5.18-1.615-7.287-2.224-14.523-2.664-21.965l-.127-2.149c-1.332-23.36-1.018-46.784-.967-70.172.015-6.942.017-13.883.02-20.825q.007-18.556.036-37.113.029-17.985.041-35.97l.002-2.255.007-11.198q.032-46.173.101-92.346 3.79-1.193 7.582-2.383l2.143-.675c6.382-2 12.81-3.793 19.275-5.505l3.366-.896Q139.18 124.263 144 123l2.667-.702q3.351-.878 6.708-1.736l3.648-.933C160 119 160 119 164 119v-2l1.617-.397a9065 9065 0 0 0 16.742-4.138q3.12-.773 6.239-1.539 4.5-1.108 8.996-2.227l2.791-.682c5.38-1.345 10.447-3.009 15.615-5.017a220 220 0 0 1 5.645-1.719l3.052-.886 3.115-.895 3.08-.895A760 760 0 0 1 245.7 94.47c3.168-.854 6.265-1.78 9.356-2.875 8.314-2.842 16.996-4.63 25.53-6.687q3.589-.87 7.173-1.75l2.191-.522c4.59-1.13 8.698-2.766 13.051-4.635 2.769-.862 5.568-1.568 8.383-2.262l2.355-.592q2.448-.613 4.896-1.218c2.493-.616 4.982-1.245 7.471-1.875l4.778-1.19 2.241-.568c3.696-.903 7.067-1.518 10.876-1.295v-2l3.713-.962q6.87-1.783 13.737-3.573 2.962-.771 5.927-1.539 4.28-1.11 8.557-2.227l2.643-.682c4.892-1.281 9.676-2.72 14.442-4.413 5.657-1.725 10.044-.681 15.481 1.107m-17.04 5.278-2.492.638-2.593.687-2.67.688q-2.637.68-5.27 1.366a907 907 0 0 1-9.685 2.446l-2.828.707L364 67v2l-1.732.275c-9.6 1.63-19.008 4.02-28.455 6.35q-2.599.638-5.198 1.273Q322.307 78.444 316 80v2c-.984.125-1.969.25-2.983.377-4.17.598-8.211 1.56-12.294 2.584l-2.334.58q-2.43.605-4.858 1.215c-2.456.616-4.914 1.223-7.373 1.83l-4.748 1.187-2.194.54c-4.2 1.064-8.177 2.396-12.214 3.959-3.38 1.23-6.846 2.085-10.334 2.955l-2.298.585q-3.59.911-7.183 1.813-3.618.915-7.235 1.835a2128 2128 0 0 1-4.481 1.131c-2.86.723-5.67 1.475-8.471 2.409v2c-.541.099-1.083.197-1.64.3-7.365 1.402-14.611 3.221-21.865 5.104q-3.084.798-6.173 1.586l-4.013 1.037-3.6.93c-2.736.77-5.392 1.595-8.078 2.511-4.628 1.567-9.304 2.819-14.041 4.012l-2.585.66q-4.033 1.028-8.067 2.047l-5.514 1.405Q144.713 128.302 138 130v2l-3.352.344c-5.115.64-10.036 1.875-15.023 3.156l-2.73.684c-4.563 1.086-4.563 1.086-8.895 2.816a118346 118346 0 0 0-.111 107.294 43274 43274 0 0 1-.043 35.688q-.029 18.375-.034 36.749-.003 10.293-.023 20.587c-.286 50.464-.286 50.464 4.711 100.62l.645 4.392c1.386 9.372 2.978 18.375 6.074 27.335 1.401 4.19 2.536 8.455 3.719 12.71C125 491.712 127.178 498.913 130 506h2l.355 2.078C136.373 526.29 146.698 543.475 155 560h2l.777 2.09c4.038 9.611 9.895 18.097 16.254 26.285 1.611 2.148 2.958 4.203 4.219 6.563 1.89 3.307 4.032 5.409 6.75 8.062a157 157 0 0 1 2.875 3.813c3.143 4.283 6.59 8.225 10.125 12.187a3021 3021 0 0 1 3.375 3.875c8.183 11.159 8.183 11.159 18.75 18.625l1.875.5.785 1.754c1.64 3.031 3.82 4.57 6.528 6.683 2.903 2.278 5.631 4.507 8.23 7.13 2.36 2.338 4.694 4.102 7.457 5.933 3.755 2.56 6.785 5.285 10 8.5a137 137 0 0 0 4.09 2.75c4.727 3.11 9.33 6.366 13.91 9.688.79.57 1.58 1.14 2.393 1.729 3.907 2.833 7.77 5.698 11.545 8.708 4.015 3.197 8.3 5.877 12.68 8.547C302 705 302 705 303.377 706.41c2.58 2.53 5.652 4.343 8.685 6.278.637.415 1.274.83 1.931 1.26 3.242 2.283 3.242 2.283 7.006 3.052v2c2.042 1.683 2.042 1.683 4.625 3.375 1.37.936 1.37.936 2.77 1.89a417 417 0 0 0 5.918 3.86C337 730 337 730 339.188 732.313c3.335 3.186 6.93 5.377 10.843 7.796 3.91 2.49 7.61 5.226 11.336 7.98 2.42 1.756 4.876 3.409 7.383 5.036a66.4 66.4 0 0 1 7.875 6c4.022 3.563 8.244 6.165 13.375 7.875l1 3c2.088 1.456 2.088 1.456 4.563 2.688l2.503 1.324L400 775q2.257-1.426 4.5-2.875l2.531-1.617L409 769v-2l1.695-.824c2.449-1.25 4.813-2.591 7.18-3.989l2.492-1.457c2.515-1.653 4.77-3.48 7.058-5.43 2.64-2.18 5.444-4.11 8.262-6.05l1.721-1.207c2.523-1.745 4.665-3.067 7.592-4.043l2-2.125c3.278-3.458 7.32-5.692 11.379-8.129 2.566-1.71 4.453-3.57 6.621-5.746q2.521-1.689 5.125-3.25c3.867-2.398 7.43-4.915 10.938-7.812 3.99-3.292 8.078-5.938 12.613-8.418 2.473-1.5 2.473-1.5 4.703-3.938 2.872-2.83 5.773-4.671 9.246-6.707 3.541-2.083 6.526-3.943 9.375-6.875a267 267 0 0 1 5.938-4.125c5.561-3.791 10.957-7.746 16.308-11.832a132 132 0 0 1 5.957-4.156c2.863-1.793 2.863-1.793 5.11-4.262 2.344-2.29 4.456-3.865 7.187-5.625 3.636-2.354 6.504-4.85 9.5-8a280 280 0 0 1 3.75-3.312l2.047-1.782q2.355-2.037 4.719-4.062l2.484-2.157 2.313-1.988c1.922-1.536 1.922-1.536 1.687-3.699h2c1.307-1.558 1.307-1.558 2.625-3.562 2.794-3.883 5.904-6.733 9.563-9.782 2.445-2.234 4.01-4.892 5.812-7.656a406 406 0 0 1 4.36-3.453c2.837-2.676 4.818-5.973 6.98-9.2C617 600 617 600 619.625 597.438c2.634-2.703 4.047-5.333 5.793-8.648 2.017-3.556 4.288-6.907 6.582-10.289 6.737-8.638 6.737-8.638 10-18.5h2c5.27-9.753 5.27-9.753 10.313-19.625C656 537 656 537 657.414 534.789c1.975-3.473 3.296-7.038 4.649-10.789q.765-2.094 1.535-4.187l.723-1.993a121 121 0 0 1 1.863-4.633c.99-2.266.99-2.266.816-5.187h2c3.905-12.327 7.58-24.634 10.401-37.259l.556-2.468.468-2.143c.575-2.13.575-2.13 1.564-4.473 1.194-3.139 1.71-6.124 2.23-9.442l.313-1.987q.327-2.089.645-4.178c.314-2.055.64-4.108.968-6.161 3.02-19.277 4.209-38.382 4.474-57.884l.114-7.133c.359-23.52.399-47.038.368-70.56-.006-5.853-.006-11.707-.008-17.56q-.005-16.476-.021-32.953-.015-18.82-.022-37.643-.015-38.577-.05-77.156a4349 4349 0 0 0-6.766-2.27 91 91 0 0 0-7.172-2.011l-2.523-.614L672 133.5q-2.532-.604-5.062-1.219l-2.223-.529c-2.357-.653-4.64-1.394-6.953-2.184-4.581-1.545-9.2-2.78-13.89-3.943l-5.136-1.297q-3.982-.999-7.964-1.994a3436 3436 0 0 1-7.776-1.959l-2.374-.587c-4.356-1.104-8.492-2.45-12.679-4.076-3.154-1.156-6.395-1.958-9.654-2.755l-2.104-.525q-2.175-.542-4.35-1.076a1739 1739 0 0 1-6.675-1.659c-6.509-1.882-6.509-1.882-13.16-2.697v-2a6488 6488 0 0 0-15.796-4.218 2609 2609 0 0 1-5.365-1.434q-3.871-1.038-7.745-2.063l-2.394-.647c-4.897-1.29-9.661-2.114-14.7-2.638v-2q-8.22-2.145-16.443-4.272-2.797-.726-5.593-1.456c-2.68-.7-5.36-1.392-8.042-2.085l-2.523-.662-2.365-.607-2.072-.538c-2.284-.507-2.284-.507-5.962-.38v-2a9499 9499 0 0 0-18.58-4.7q-3.16-.798-6.32-1.6-4.54-1.153-9.084-2.294l-2.854-.729-2.669-.667-2.342-.592c-2.44-.545-2.44-.545-6.151-.418v-2a3710 3710 0 0 0-13.77-3.418q-2.34-.578-4.678-1.164c-2.248-.563-4.497-1.116-6.747-1.668l-2.094-.53c-5.688-1.38-10.58-1.71-16.25-.232"
                        fill="#000" />
                    <path
                        d="m287 210 3.785.367c11.512 1.402 20.389 5.67 30.215 11.633l2.37 1.414c14.953 8.965 28.173 19.361 41.325 30.746 3.775 3.26 7.637 6.408 11.516 9.543a271 271 0 0 1 6.078 5.156l1.713 1.486q1.625 1.415 3.233 2.85c7.58 6.572 14.39 8.416 24.343 8.817l3.3.177c3.457.183 6.914.342 10.372.498q5.207.26 10.415.531 3.231.165 6.464.314l2.954.143 2.592.118c2.259.201 4.195.421 6.325 1.207 1.703 2.941 1.703 2.941 3.25 6.563l1.578 3.628L460 298l2.082-.035c.901-.01 1.802-.018 2.73-.027l2.708-.036C470 298 470 298 473 299c1.29 1.688 1.29 1.688 2.625 4l1.598 2.723c1.317 2.43 2.534 4.84 3.71 7.336 4.402 9.161 8.764 15.199 16.833 21.375 3.317 2.545 6.131 5.398 8.921 8.503l2.387 2.653c2.322 2.906 3.735 5.168 4.301 8.848-.497 3.396-2.194 4.98-4.375 7.562l1.022 1.478c15.13 21.98 15.13 21.98 16.978 32.522l1.906.086c5.313.592 8.49 1.646 11.907 5.851A226 226 0 0 1 545 408q1.62 2.357 3.246 4.71a1105 1105 0 0 1 8.233 12.137L558 427l1.458 2.65c4.087 3.778 8.776 3.669 14.167 4.229l3.452.42c3.639.443 7.28.856 10.923 1.264 3.643.413 7.284.832 10.923 1.273q3.396.411 6.798.772l3.115.375 2.736.304c3.661 1.075 5.54 3.4 7.632 6.493a287 287 0 0 1 3.109 5.908l1.126 2.029c3.478 6.781 2.59 11.946.404 19.036-1.213 3.676-2.506 7.32-3.826 10.958a996 996 0 0 0-2.449 6.851c-1.265 3.56-2.577 7.1-3.909 10.635a115 115 0 0 0-1.586 4.729c-1.136 3.247-2.023 5.38-4.941 7.307-2.671 1.146-5.339 1.96-8.132 2.767l-5.836 1.899c-3.73 1.2-7.478 2.338-11.226 3.476l-2.418.736c-19.06 5.781-38.193 10.349-57.77 14.014l-2.077.39c-6.579 1.232-13.155 2.433-19.778 3.4-15.132 2.3-28.424 7.554-37.895 20.085-2.662 3.657-5.215 7.386-7.764 11.123l-1.529 2.209-1.36 1.991C450 576 450 576 447 578c-5.173-.094-8.868-1.3-13.562-3.437-7.022-3.066-13.868-3.807-21.438-4.563a939 939 0 0 1-8.437-1l-2.06-.238c-3.443-.416-6.6-1.016-9.878-2.137-4.647-.801-6.976.56-11.164 2.473-3.906 1.432-6.447.87-10.461-.098a95 95 0 0 1-4-2v3.813c-.766 7.218-5.698 13.295-11.043 17.976-3.106 1.922-5.405 1.718-8.957 1.211-2.062-1.875-2.062-1.875-4-5l-1.504-2.312c-4.85-7.668-6.589-13.702-6.496-22.688l-3.332-.809c-6.935-2.3-12.044-4.993-15.456-11.711-2.576-6.368-4.41-12.96-6.231-19.573l-.586-2.126-.575-2.09c-2.51-8.7-7.829-17.07-15.82-21.691a204 204 0 0 0-5.768-1.295c-6.032-1.303-9.917-2.65-13.49-7.924-5.307-9.204-7.842-16.49-6.242-27.094 1.447-10.672.09-20.484-2.812-30.812l-.565-2.024c-1.91-6.534-3.743-12.603-9.564-16.636-3.953-2.14-8.113-3.67-12.323-5.222-3.587-1.593-6.156-3.946-8.861-6.743l-2.54-2.61c-2.15-3.093-2.64-4.888-2.835-8.64l.836-3.672c.875-6.107-3.031-10.664-6.211-15.578l-4.145-6.645-2.213-3.498c-3.488-5.527-6.85-11.13-10.23-16.725a1676 1676 0 0 0-7.218-11.839 124 124 0 0 1-3.392-6.043c-2.744-5.476-2.744-5.476-8.005-8.125l-3.672.125c-2.25.038-4.5.046-6.75 0-2-2-2-2-2.328-5.527.132-5.057 1.78-9.357 3.578-14.036 2.765-7.486 5.066-14.905 6.926-22.664C185 276 185 276 187 274c6.123-.637 11.175 1.054 16.938 3l2.65.867q3.21 1.053 6.412 2.133l.59-1.865.793-2.451.778-2.428c1.444-3.88 3.3-6.516 7.058-8.322 4.192-1.408 8.447-1.811 12.82-2.372 3.133-.396 3.133-.396 5.961-2.562-.298-6.863-3.327-11.33-7-17-7.123-10.996-7.123-10.996-7-17 2.364-3.311 5.47-3.998 9.258-5.121l3.811-1.141q2.028-.589 4.056-1.175l4.118-1.21c28.99-8.459 28.99-8.459 38.757-7.353m-14.078 5.32-3.495.865-3.677.94-3.765.956c-7.28 1.88-14.518 3.853-21.673 6.169l-2.245.708c-2.22.717-2.22.717-5.067 2.042-1.354 2.925-1.354 2.925.064 5.328l1.647 2.707 1.773 2.951 1.891 3.077q1.825 3.017 3.648 6.035l1.654 2.703c2.224 3.696 2.665 5.834 2.323 10.199-.934 2.59-.934 2.59-3 5-3.04.992-6.15 1.328-9.312 1.75-6.557 1.026-6.557 1.026-12.168 4.29-1.483 2.278-2.548 4.426-3.52 6.96q-.924 1.788-1.875 3.563L215 284c-6.311-.386-11.853-2.182-17.719-4.448-3.655-1.384-3.655-1.384-7.411-.863-2.366 1.658-2.59 2.63-3.179 5.424l-.567 2.516-.561 2.683c-1.675 7.416-3.679 14.185-6.743 21.157-.878 2.71-.822 3.908.18 6.531l2.605-.52c4.155-.34 7.643-.354 11.395 1.52 4.923 4.802 7.877 11.5 11.085 17.497 3.318 6.07 6.916 11.975 10.474 17.907a1234 1234 0 0 1 3.643 6.137l1.168 1.978q1.14 1.935 2.278 3.874c1.844 3.13 3.73 6.214 5.727 9.249l1.141 1.76a460 460 0 0 0 3.118 4.695c1.633 3.47 1.45 5.37.741 9.09-.64 3.85-.747 5.224 1.367 8.575 5.926 6.175 13.11 11.11 21.242 13.925 3.314 1.297 5.446 2.314 7.247 5.47 1 2.715 1.79 5.418 2.519 8.218l.851 3.009a550 550 0 0 1 1.643 5.942 84 84 0 0 0 2.15 6.569c3.078 8.677 2.43 15.841 1.086 24.757-1.251 9.448 2.365 17.084 7.369 24.864 2.668 3.44 6.08 3.836 10.151 4.484 9.07 2.708 15.081 7.064 19.934 15.27 1.899 3.928 3.084 8.008 4.265 12.195 4.16 17.398 4.16 17.398 15.646 29.986 3.356 1.503 6.587 2.646 10.155 3.549l-.037 1.833-.03 2.425-.037 2.395c.34 7.671 5.248 15.666 10.104 21.347h4c6.003-6.055 10.006-12.476 11-21 6.422-.257 6.422-.257 9.813 1.25 4.384 1.032 6.792-.513 10.816-2.277 4.73-1.94 8.179-1.048 12.871.402 5.8 1.713 11.502 2.123 17.5 2.563 7.971.61 14.659 1.77 22 5.062q2.584.904 5.188 1.75l2.23.734L445 574q2.285-2.934 4.563-5.875l1.386-1.785a177 177 0 0 0 7.676-10.778c2.614-3.76 5.195-6.533 9.039-9.037a91 91 0 0 0 4.545-3.168c10.182-6.902 21.695-8.045 33.604-9.982 4.216-.713 8.43-1.438 12.644-2.164l3.156-.54c16.067-2.78 31.939-6.187 47.512-11.046l3.8-1.178q3.764-1.17 7.524-2.352a400 400 0 0 1 9.989-2.915l5.687-1.68 2.583-.677c3.261-1.007 5.558-1.783 7.566-4.63 1.085-2.36 1.915-4.725 2.726-7.193q1.102-2.856 2.219-5.707 1.144-3.051 2.281-6.106l1.145-3.04a688 688 0 0 0 2.238-6.075 355 355 0 0 1 2.36-6.296l1.163-3.163 1.073-2.83c1.004-5.362-1.894-9.868-4.417-14.47l-1.527-2.825c-2.54-4.137-2.54-4.137-6.823-6.054l-2.715-.274-3.086-.336-3.333-.332q-3.492-.4-6.984-.805c-3.67-.412-7.34-.812-11.014-1.182a652 652 0 0 1-10.627-1.2l-3.309-.295c-5.837-.735-8.99-1.664-12.697-6.384A155 155 0 0 1 552 427a411 411 0 0 0-3.098-4.316q-1.486-2.121-2.965-4.247a901 901 0 0 0-4.45-6.333 246 246 0 0 1-3.016-4.368c-2.826-4.227-2.826-4.227-7.069-6.752l-2.465-.234c-3.403-.798-4.566-1.156-6.445-4.168q-1.21-3.106-2.293-6.258c-3.051-8.459-8.41-15.932-13.914-22.972-1.63-2.982-1.63-5.002-1.285-8.352l1.625-2.062L508 355c-1.194-4.482-3.895-7.505-7-10.812l-1.473-1.6c-3.066-3.254-6.245-6.035-9.84-8.713-6.184-4.76-9.082-10.601-12.464-17.484l-.931-1.889a460 460 0 0 1-2.581-5.4c-1.683-3.051-2.886-5.067-5.711-7.102-3.06-.268-3.06-.268-6.25.25l-3.266.39c-.82.12-1.64.238-2.484.36l-.348-2.203c-.67-2.878-1.64-4.983-3.09-7.547l-1.308-2.36c-1.122-2.031-1.122-2.031-3.254-2.89a86 86 0 0 0-4.614-.357l-2.904-.162-3.15-.165-6.584-.373q-5.197-.287-10.395-.565c-3.34-.18-6.68-.37-10.021-.562l-3.12-.158c-8.081-.47-14.155-1.236-20.462-6.72l-2.875-2.458L381 274a1252 1252 0 0 0-5.25-4.25 385 385 0 0 1-11.001-9.353C351.624 248.864 337.811 238.28 323 229l-2.423-1.546c-14.814-9.363-29.749-16.58-47.655-12.134"
                        fill="#000" />
                </svg>
                <h3>@lang('zatca::lang.zatca')</h3>
            </a>
        </li>
        @endif

        {{-- Gym Module --}}
        @if(Module::has('Gym') && $is_gym_enabled)
        <li class="nav-item toogle-sidebar-submenu">
            <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1) == 'gym' ? 'active' : '' }}"
                href="{{ action([\Modules\Gym\Http\Controllers\GymController::class, 'index']) }}">

                <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M2 12h1" />
                    <path d="M6 8h-2a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h2" />
                    <path d="M6 7v10a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1" />
                    <path d="M9 12h6" />
                    <path d="M15 7v10a1 1 0 0 0 1 1h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1" />
                    <path d="M18 8h2a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-2" />
                    <path d="M21 12h1" />
                </svg>
                <h3>@lang('gym::lang.gym')</h3>
            </a>
        </li>
        @endif

        {{-- Login Layouts Module --}}
        @if(Module::has('LoginLayouts') && $is_loginlayouts_enabled)
        <li class="nav-item toogle-sidebar-submenu">
            <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1) == 'login-layouts' ? 'active' : '' }}"
                href="{{ action([\Modules\LoginLayouts\Http\Controllers\LoginLayoutsController::class, 'index']) }}">

                <svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <rect x="3" y="4" width="18" height="12" rx="1" />
                    <path d="M7 8l0 .01" />
                    <path d="M7 12l0 .01" />
                    <path d="M11 8l6 0" />
                    <path d="M11 12l6 0" />
                </svg>
                <h3>@lang('loginlayouts::lang.login_layouts')</h3>
            </a>
        </li>
        @endif

        {{-- Currency Exchange Rate --}}
        @if(Module::has('CurrencyExchangeRate') && $is_currency_exchange_enabled)
        @if (auth()->user()->can('currencyexchangerate.currencyexchangerate.view'))
        <li class="nav-item toogle-sidebar-submenu">
            <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1) == 'exchange-rates' ? 'active' : '' }}"
                href="{{action([\Modules\CurrencyExchangeRate\Http\Controllers\CurrencyExchangeRateController::class, 'index'])}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-size-20" width="20" height="20" stroke-width="32"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    viewBox="0 0 512 512">
                    <path
                        d="M512 80c0 18-14.3 34.6-38.4 48c-29.1 16.1-72.5 27.5-122.3 30.9c-3.7-1.8-7.4-3.5-11.3-5C300.6 137.4 248.2 128 192 128c-8.3 0-16.4 .2-24.5 .6l-1.1-.6C142.3 114.6 128 98 128 80c0-44.2 86-80 192-80S512 35.8 512 80zM160.7 161.1c10.2-.7 20.7-1.1 31.3-1.1c62.2 0 117.4 12.3 152.5 31.4C369.3 204.9 384 221.7 384 240c0 4-.7 7.9-2.1 11.7c-4.6 13.2-17 25.3-35 35.5c0 0 0 0 0 0c-.1 .1-.3 .1-.4 .2c0 0 0 0 0 0s0 0 0 0c-.3 .2-.6 .3-.9 .5c-35 19.4-90.8 32-153.6 32c-59.6 0-112.9-11.3-148.2-29.1c-1.9-.9-3.7-1.9-5.5-2.9C14.3 274.6 0 258 0 240c0-34.8 53.4-64.5 128-75.4c10.5-1.5 21.4-2.7 32.7-3.5zM416 240c0-21.9-10.6-39.9-24.1-53.4c28.3-4.4 54.2-11.4 76.2-20.5c16.3-6.8 31.5-15.2 43.9-25.5l0 35.4c0 19.3-16.5 37.1-43.8 50.9c-14.6 7.4-32.4 13.7-52.4 18.5c.1-1.8 .2-3.5 .2-5.3zm-32 96c0 18-14.3 34.6-38.4 48c-1.8 1-3.6 1.9-5.5 2.9C304.9 404.7 251.6 416 192 416c-62.8 0-118.6-12.6-153.6-32C14.3 370.6 0 354 0 336l0-35.4c12.5 10.3 27.6 18.7 43.9 25.5C83.4 342.6 135.8 352 192 352s108.6-9.4 148.1-25.9c7.8-3.2 15.3-6.9 22.4-10.9c6.1-3.4 11.8-7.2 17.2-11.2c1.5-1.1 2.9-2.3 4.3-3.4l0 3.4 0 5.7 0 26.3zm32 0l0-32 0-25.9c19-4.2 36.5-9.5 52.1-16c16.3-6.8 31.5-15.2 43.9-25.5l0 35.4c0 10.5-5 21-14.9 30.9c-16.3 16.3-45 29.7-81.3 38.4c.1-1.7 .2-3.5 .2-5.3zM192 448c56.2 0 108.6-9.4 148.1-25.9c16.3-6.8 31.5-15.2 43.9-25.5l0 35.4c0 44.2-86 80-192 80S0 476.2 0 432l0-35.4c12.5 10.3 27.6 18.7 43.9 25.5C83.4 438.6 135.8 448 192 448z" />
                </svg>
                <h3>@lang('currencyexchangerate::lang.currency_exchange_rate')</h3>
            </a>
        </li>
        @endif
        @endif

        {{-- --------------------------- CRM MODULE ------------------------ --}}
        @if($is_crm_enabled)
        @php
        $crm_active = request()->segment(1) == 'crm' && in_array(request()->segment(2), ['campaigns', 'dashboard']) ||
        request()->get('type') == 'life_stage' || request()->get('type') == 'source';
        @endphp
        @if((auth()->user()->can('crm.access_all_campaigns') || auth()->user()->can('crm.access_own_campaigns')))
        <li class="nav-item toogle-sidebar-submenu {{ $crm_active ? 'open active' : '' }}">
            <a class="nav-link toogle-sidebar-submenu-flex" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-size-20"
                    style="width:24px;height:24px;vertical-align:middle;fill:currentColor;overflow:hidden"
                    viewBox="0 0 1024 1024" stroke-width="1">
                    <path
                        d="M32 545.344c0 49.408 12.992 88.32 38.912 116.672 25.92 28.224 61.568 42.368 106.88 42.368 36.608 0 66.688-10.496 90.112-31.36s38.016-48 43.712-81.344H245.44c-4.352 15.744-9.856 27.648-16.448 35.52-11.968 14.656-29.376 22.016-52.224 22.016a69.12 69.12 0 0 1-55.04-25.6q-21.696-25.728-21.696-77.184c0-51.456 6.848-60.864 20.544-79.616s32.384-28.16 56.064-28.16c23.296 0 40.896 6.656 52.736 19.968 6.656 7.424 12.032 18.496 16.32 33.216h66.56c-1.024-19.136-8.256-38.144-21.824-57.088-24.512-33.792-63.296-50.688-116.288-50.688q-59.424 0-97.92 37.824C46.72 450.816 32 491.968 32 545.344m473.408-102.272c13.696 0 24 1.728 30.848 5.376 12.096 6.4 18.24 18.816 18.24 37.376 0 17.152-6.272 28.608-18.88 34.432-7.104 3.328-17.728 4.992-32 4.992h-71.68v-82.176zm13.824-53.184h-152.32v305.984h65.024v-120h65.024c18.56 0 31.168 3.264 37.888 9.792s10.24 19.52 10.496 38.976l.512 28.416a143.4 143.4 0 0 0 7.104 42.752h73.344v-7.616a25.6 25.6 0 0 1-12.224-17.408 152 152 0 0 1-1.728-28.48v-20.48c0-21.504-3.008-37.44-9.152-47.872s-16.576-18.496-31.168-24.192c17.472-5.824 30.144-15.744 37.76-29.824a88.96 88.96 0 0 0 11.52-42.88c0-12.032-1.984-22.72-5.888-32.192a97 97 0 0 0-16.064-25.728 78.46 78.46 0 0 0-29.888-21.376c-11.712-4.8-28.48-7.424-50.24-7.872m319.488 240.64-57.984-240.64H683.84v305.984h62.016V488.96c0-6.016 0-14.336-.128-25.088l-.256-24.832 59.904 256.832h64.768l60.352-256.832-.256 24.832-.256 25.088v206.912H992V389.888h-95.744zM142.656 320a416.128 416.128 0 0 1 738.624 0h70.528C877.632 150.528 708.736 32 512 32S146.304 150.528 72.128 320zM840 768a415.488 415.488 0 0 1-656 0h-77.568a479.04 479.04 0 0 0 811.072 0z" />
                </svg>
                <h3>@lang('crm::lang.crm')</h3>
                <span class="chevron" aria-hidden="true">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 12 15 18 9" />
                    </svg>
                </span>
            </a>
            <ul class="side-submenu">
                <a class="{{ request()->segment(1) == 'crm' && request()->segment(2) == 'campaigns' ? 'active' : '' }}"
                    href="{{ action('\Modules\Crm\Http\Controllers\CampaignController@index') }}">
                    @lang('crm::lang.campaigns')
                </a>
                <a class="{{ request()->segment(1) == 'crm' && request()->segment(2) == 'dashboard' || request()->get('type') == 'life_stage' || request()->get('type') == 'source' ? 'active' : '' }}"
                    href="{{ action('\Modules\Crm\Http\Controllers\CrmDashboardController@index') }}">
                    @lang('crm::lang.overview')
                </a>
            </ul>
        </li>
        @endif
        @endif

        {{-- --------------------------- ESSENTIALS ------------------------ --}}
        @if(Module::has('CurrencyExchangeRate') && $is_currency_exchange_enabled)
        @if (auth()->user()->can('currencyexchangerate.currencyexchangerate.view'))
        <li class="nav-item toogle-sidebar-submenu">
            <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1) == 'exchange-rates' ? 'active' : '' }}"
                href="{{action([\Modules\CurrencyExchangeRate\Http\Controllers\CurrencyExchangeRateController::class, 'index'])}}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-size-20" width="20" height="20" stroke-width="32"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    viewBox="0 0 512 512">
                    <path
                        d="M512 80c0 18-14.3 34.6-38.4 48c-29.1 16.1-72.5 27.5-122.3 30.9c-3.7-1.8-7.4-3.5-11.3-5C300.6 137.4 248.2 128 192 128c-8.3 0-16.4 .2-24.5 .6l-1.1-.6C142.3 114.6 128 98 128 80c0-44.2 86-80 192-80S512 35.8 512 80zM160.7 161.1c10.2-.7 20.7-1.1 31.3-1.1c62.2 0 117.4 12.3 152.5 31.4C369.3 204.9 384 221.7 384 240c0 4-.7 7.9-2.1 11.7c-4.6 13.2-17 25.3-35 35.5c0 0 0 0 0 0c-.1 .1-.3 .1-.4 .2c0 0 0 0 0 0s0 0 0 0c-.3 .2-.6 .3-.9 .5c-35 19.4-90.8 32-153.6 32c-59.6 0-112.9-11.3-148.2-29.1c-1.9-.9-3.7-1.9-5.5-2.9C14.3 274.6 0 258 0 240c0-34.8 53.4-64.5 128-75.4c10.5-1.5 21.4-2.7 32.7-3.5zM416 240c0-21.9-10.6-39.9-24.1-53.4c28.3-4.4 54.2-11.4 76.2-20.5c16.3-6.8 31.5-15.2 43.9-25.5l0 35.4c0 19.3-16.5 37.1-43.8 50.9c-14.6 7.4-32.4 13.7-52.4 18.5c.1-1.8 .2-3.5 .2-5.3zm-32 96c0 18-14.3 34.6-38.4 48c-1.8 1-3.6 1.9-5.5 2.9C304.9 404.7 251.6 416 192 416c-62.8 0-118.6-12.6-153.6-32C14.3 370.6 0 354 0 336l0-35.4c12.5 10.3 27.6 18.7 43.9 25.5C83.4 342.6 135.8 352 192 352s108.6-9.4 148.1-25.9c7.8-3.2 15.3-6.9 22.4-10.9c6.1-3.4 11.8-7.2 17.2-11.2c1.5-1.1 2.9-2.3 4.3-3.4l0 3.4 0 5.7 0 26.3zm32 0l0-32 0-25.9c19-4.2 36.5-9.5 52.1-16c16.3-6.8 31.5-15.2 43.9-25.5l0 35.4c0 10.5-5 21-14.9 30.9c-16.3 16.3-45 29.7-81.3 38.4c.1-1.7 .2-3.5 .2-5.3zM192 448c56.2 0 108.6-9.4 148.1-25.9c16.3-6.8 31.5-15.2 43.9-25.5l0 35.4c0 44.2-86 80-192 80S0 476.2 0 432l0-35.4c12.5 10.3 27.6 18.7 43.9 25.5C83.4 438.6 135.8 448 192 448z" />
                </svg>
                <h3>@lang('currencyexchangerate::lang.currency_exchange_rate')</h3>
            </a>
        </li>
        @endif
        @endif
        @if($is_essentials_enabled)

        <li class="nav-item toogle-sidebar-submenu ">
            <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1) == 'hrm' ? 'active' : '' }}"
                href="{{ action('\Modules\Essentials\Http\Controllers\DashboardController@hrmDashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-size-20" width="20" height="20" stroke-width="32"
                    stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"
                    viewBox="0 0 640 512">
                    <path
                        d="M144 0a80 80 0 1 1 0 160A80 80 0 1 1 144 0zM512 0a80 80 0 1 1 0 160A80 80 0 1 1 512 0zM0 298.7C0 239.8 47.8 192 106.7 192l42.7 0c15.9 0 31 3.5 44.6 9.7c-1.3 7.2-1.9 14.7-1.9 22.3c0 38.2 16.8 72.5 43.3 96c-.2 0-.4 0-.7 0L21.3 320C9.6 320 0 310.4 0 298.7zM405.3 320c-.2 0-.4 0-.7 0c26.6-23.5 43.3-57.8 43.3-96c0-7.6-.7-15-1.9-22.3c13.6-6.3 28.7-9.7 44.6-9.7l42.7 0C592.2 192 640 239.8 640 298.7c0 11.8-9.6 21.3-21.3 21.3l-213.3 0zM224 224a96 96 0 1 1 192 0 96 96 0 1 1 -192 0zM128 485.3C128 411.7 187.7 352 261.3 352l117.3 0C452.3 352 512 411.7 512 485.3c0 14.7-11.9 26.7-26.7 26.7l-330.7 0c-14.7 0-26.7-11.9-26.7-26.7z" />
                </svg>
                <h3>@lang('essentials::lang.hrm')</h3>
            </a>
        </li>
        <li class="nav-item toogle-sidebar-submenu ">
            <a class="nav-link toogle-sidebar-submenu-flex {{ request()->segment(1) == 'essentials' ? 'active' : '' }}"
                href="{{ action('\Modules\Essentials\Http\Controllers\ToDoController@index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon-size-20" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-circle-check">
                    <path d="M0 0h24v24H0z" stroke="none" />
                    <path d="M3 12a9 9 0 1 0 18 0 9 9 0 1 0-18 0" />
                    <path d="m9 12 2 2 4-4" />
                </svg>
                <h3>@lang('essentials::lang.essentials')</h3>
            </a>
        </li>
        @endif


        </ul>
    </div>
</aside>