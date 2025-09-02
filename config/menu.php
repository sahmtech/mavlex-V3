<?php

/*
|--------------------------------------------------------------------------
| Core Application Menu
|--------------------------------------------------------------------------
|
| This file defines the core menu items for the application.
| Each item is an array with a structure that matches the items
| loaded from the modules, ensuring a consistent menu system.
// Option 1: Using role: prefix
'permission' => 'adjustment.view|view_own_adjustment|role:Admin'

// Option 2: Using @ prefix (shorter)
'permission' => 'adjustment.view|view_own_adjustment|@Admin'

// Option 3: Mixed permissions and roles
'permission' => 'adjustment.view|@Admin|role:Manager'

// Option 4: Specific business admin
'permission' => 'role:Admin#123'  // For business ID 123 specifically
|
*/

return [
    /*────────────────────────── HOME ──────────────────────────*/
    [
        'label' => 'home.home',
        'url' => '/home',
        'icon_type' => 'svg',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0"/><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"/><path d="M10 12h4v4h-4z"/></svg>',
        'sort_order' => 1
    ],

    /*────────────────────── USER MANAGEMENT ───────────────────*/
    [
        'label' => 'user.user_management',
        'icon_type' => 'svg',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7a4 4 0 1 0 0-8a4 4 0 0 0 0 8z" transform="translate(0 4)"/><path d="M3 21v-2a4 4 0 0 1 4-4h4a4 4 0 0 1 4 4v2"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/><path d="M21 21v-2a4 4 0 0 0 -3-3.85"/></svg>',
        'permission' => 'user.view||user.create||roles.view||@Admin',
        'sort_order' => 2,
        'children' => [
            [
                'label' => 'user.users',
                'url' => '/users',
                'permission' => 'user.view||user.create||@Admin',
                'sort_order' => 1
            ],
            [
                'label' => 'user.roles',
                'url' => '/roles',
                'permission' => 'roles.view',
                'sort_order' => 2
            ],
            [
                'label' => 'lang_v1.sales_commission_agents',
                'url' => '/sales-commission-agents',
                'permission' => 'user.create||@Admin',
                'sort_order' => 3
            ]
        ]
    ],

    /*──────────────────────── CONTACTS ─────────────────────────*/
    [
        'label' => 'contact.contacts',
        'icon_type' => 'svg',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 6v12a2 2 0 0 1 -2 2H8a2 2 0 0 1 -2-2V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"/><path d="M10 16h6"/><path d="M13 11a2 2 0 1 0 0-4a2 2 0 0 0 0 4z"/><path d="M4 8h3M4 12h3M4 16h3"/></svg>',
        'permission' => 'supplier.create||customer.create||supplier.view||customer.view||supplier.view_own||customer.view_own||@Admin',
        'sort_order' => 3,
        'children' => [
            [
                'label' => 'report.supplier',
                'url' => '/contacts?type=supplier',
                'permission' => 'supplier.view||supplier.view_own||@Admin',
                'sort_order' => 1
            ],
            [
                'label' => 'report.customer',
                'url' => '/contacts?type=customer',
                'permission' => 'customer.view||customer.view_own||@Admin',
                'sort_order' => 2
            ],
            [
                'label' => 'lang_v1.customer_groups',
                'url' => '/customer-group',
                'permission' => 'customer.view||customer.view_own||@Admin',
                'sort_order' => 3
            ],
            [
                'label' => 'lang_v1.import_contacts',
                'url' => '/contacts/import',
                'permission' => 'supplier.create||customer.create||@Admin',
                'sort_order' => 4
            ],
            [
                'label' => 'lang_v1.map',
                'url' => '/contacts/map',
                'extra' => 'env:GOOGLE_MAP_API_KEY',
                'sort_order' => 5
            ]
        ]
    ],

    /*──────────────────────── PRODUCTS ─────────────────────────*/
    [
        'label' => 'sale.products',
        'icon_type' => 'svg',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5v9l-8 4.5l-8-4.5v-9l8-4.5"/><path d="M12 12l8-4.5"/><path d="M8.2 9.8l7.6-4.6"/><path d="M12 12v9"/><path d="M12 12L4 7.5"/></svg>',
        'permission' => 'product.view||product.create||brand.view||unit.view||category.view||brand.create||unit.create||category.create||product.opening_stock||@Admin',
        'sort_order' => 4,
        'children' => [
            [
                'label' => 'lang_v1.list_products',
                'url' => '/products',
                'permission' => 'product.view||@Admin',
                'sort_order' => 1
            ],
            [
                'label' => 'product.add_product',
                'url' => '/products/create',
                'permission' => 'product.create||@Admin',
                'sort_order' => 2
            ],
            [
                'label' => 'product.variations',
                'url' => '/variation-templates',
                'permission' => 'product.create||@Admin',
                'sort_order' => 3
            ],
            [
                'label' => 'product.import_products',
                'url' => '/import-products',
                'permission' => 'product.create||@Admin',
                'sort_order' => 4
            ],
            [
                'label' => 'lang_v1.import_opening_stock',
                'url' => '/import-opening-stock',
                'permission' => 'product.opening_stock||@Admin',
                'sort_order' => 5
            ],
            [
                'label' => 'lang_v1.selling_price_group',
                'url' => '/selling-price-group',
                'permission' => 'product.create||@Admin',
                'sort_order' => 6
            ],
            [
                'label' => 'unit.units',
                'url' => '/units',
                'permission' => 'unit.view||unit.create||@Admin',
                'sort_order' => 7
            ],
            [
                'label' => 'category.categories',
                'url' => '/taxonomies?type=product',
                'permission' => 'category.view||category.create||@Admin',
                'sort_order' => 8
            ],
            [
                'label' => 'brand.brands',
                'url' => '/brands',
                'permission' => 'brand.view||brand.create||@Admin',
                'sort_order' => 9
            ],
            [
                'label' => 'lang_v1.warranties',
                'url' => '/warranties',
                'extra' => 'cs:enable_product_warranty',
                'sort_order' => 10
                
            ],
            [
                'label' => 'barcode.print_labels',
                'url' => '/labels/show',
                'permission' => 'product.view||@Admin',
                'sort_order' => 11
            ]
        ]
    ],

    /*──────────────────────── PURCHASES ───────────────────────*/
    [
        'label' => 'purchase.purchases',
        'icon_type' => 'svg',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3v12"/><path d="M16 11l-4 4l-4 -4"/><path d="M3 12a9 9 0 0 0 18 0"/></svg>',
        'permission' => 'purchase.view||view_own_purchase||purchase.create||purchase.update||purchase_requisition.view_own||purchase_requisition.view_all||purchase_order.view_all||purchase_order.view_own||@Admin',
        'sort_order' => 5,
        'module' => 'purchases',
        'children' => [
            [
                'label' => 'lang_v1.purchase_requisition',
                'url' => '/purchase-requisition',
                'permission' => 'purchase_requisition.view_all,purchase_requisition.view_own||@Admin',
                'extra' => 'cs:enable_purchase_requisition',
                'sort_order' => 1
            ],
            [
                'label' => 'lang_v1.purchase_order',
                'url' => '/purchase-order',
                'permission' => 'purchase_order.view_all||purchase_order.view_own||@Admin',
                'extra' => 'cs:enable_purchase_order',
                'sort_order' => 2
            ],
            [
                'label' => 'purchase.list_purchase',
                'url' => '/purchases',
                'permission' => 'purchase.view||view_own_purchase||@Admin',
                'sort_order' => 3
            ],
            [
                'label' => 'purchase.add_purchase',
                'url' => '/purchases/create',
                'permission' => 'purchase.create||@Admin',
                'sort_order' => 4
            ],
            [
                'label' => 'lang_v1.list_purchase_return',
                'url' => '/purchase-return',
                'permission' => 'purchase.update||@Admin',
                'sort_order' => 5
            ]
        ]
    ],

    /*────────────────────────── SALES ─────────────────────────*/
    [
        'label' => 'sale.sale',
        'icon_type' => 'svg',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 15V3"/><path d="M16 7l-4-4-4 4"/><path d="M3 12a9 9 0 0 0 18 0"/></svg>',
        'permission' => 'sell.view||sell.create||direct_sell.access||view_own_sell_only||view_commission_agent_sell||access_shipping||access_own_shipping||access_commission_agent_shipping||access_sell_return||direct_sell.view||direct_sell.update||access_own_sell_return||@Admin',
        'sort_order' => 6,
        'children' => [
            [
                'label' => 'lang_v1.sales_order',
                'url' => '/sales-order',
                'permission' => 'so.view_all||so.view_own||so.create||@Admin',
                'extra' => 'ps:enable_sales_order',
                'sort_order' => 1
            ],
            [
                'label' => 'lang_v1.all_sales',
                'url' => '/sells',
                'permission' => 'sell.view||@Admin',
                'sort_order' => 2
            ],
            [
                'label' => 'sale.add_sale',
                'url' => '/sells/create',
                'permission' => 'direct_sell.access||@Admin',
                'sort_order' => 3
            ],
            [
                'label' => 'sale.list_pos',
                'url' => '/pos',
                'permission' => 'sell.view||@Admin',
                'module' => 'pos_sale',
                'sort_order' => 4
            ],
            [
                'label' => 'sale.pos_sale',
                'url' => '/pos/create',
                'permission' => 'sell.create||@Admin',
                'module' => 'pos_sale',
                'sort_order' => 5
            ],
            [
                'label' => 'lang_v1.add_draft',
                'url' => '/sells/create?status=draft',
                'permission' => 'direct_sell.access||@Admin',
                'sort_order' => 6
            ],
            [
                'label' => 'lang_v1.list_drafts',
                'url' => '/sells/drafts',
                'permission' => 'draft.view_all||draft.view_own||@Admin',
                'sort_order' => 7
            ],
            [
                'label' => 'lang_v1.add_quotation',
                'url' => '/sells/create?status=quotation',
                'permission' => 'direct_sell.access||@Admin',
                'sort_order' => 8
            ],
            [
                'label' => 'lang_v1.list_quotations',
                'url' => '/sells/quotations',
                'permission' => 'quotation.view_all||quotation.view_own||@Admin',
                'sort_order' => 9
            ],
            [
                'label' => 'lang_v1.list_sell_return',
                'url' => '/sell-return',
                'permission' => 'access_sell_return||access_own_sell_return||@Admin',
                'sort_order' => 10
            ],
            [
                'label' => 'lang_v1.shipments',
                'url' => '/shipments',
                'permission' => 'access_shipping||access_own_shipping||access_commission_agent_shipping||@Admin',
                'sort_order' => 11
            ],
            [
                'label' => 'lang_v1.discounts',
                'url' => '/discount',
                'permission' => 'discount.access||@Admin',
                'sort_order' => 12
            ],
            [
                'label' => 'lang_v1.subscriptions',
                'url' => '/subscription',
                'permission' => 'direct_sell.access||@Admin',
                'module' => 'subscription',
                'sort_order' => 13
            ],
            [
                'label' => 'lang_v1.import_sales',
                'url' => '/import-sales',
                'permission' => 'sell.create||@Admin',
                'sort_order' => 14
            ]
        ]
    ],

    /*────────────────────── STOCK TRANSFERS ──────────────────*/
    [
        'label' => 'lang_v1.stock_transfers',
        'icon_type' => 'svg',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 17a2 2 0 1 0 4 0"/><path d="M17 17a2 2 0 1 0 4 0"/><path d="M5 17H3v-4M2 5h11v12m-4 0h6m4 0h2v-6H9M9 5h5l3 5"/><path d="M3 9l4 0"/></svg>',
        'permission' => 'purchase.view||view_own_purchase||purchase.create||@Admin',
        'sort_order' => 7,
        'module' => 'stock_transfers',
        'children' => [
            [
                'label' => 'lang_v1.list_stock_transfers',
                'url' => '/stock-transfers',
                'permission' => 'purchase.view||view_own_purchase||@Admin',
                'sort_order' => 1
            ],
            [
                'label' => 'lang_v1.add_stock_transfer',
                'url' => '/stock-transfers/create',
                'permission' => 'purchase.create||@Admin',
                'sort_order' => 2
            ]
        ]
    ],

    /*─────────────────── STOCK ADJUSTMENTS ───────────────────*/
    [
        'label' => 'stock_adjustment.stock_adjustment',
        'icon_type' => 'svg',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><ellipse cx="12" cy="6" rx="8" ry="3"/><path d="M4 6v6a8 3 0 0 0 16 0V6"/><path d="M4 12v6a8 3 0 0 0 16 0v-6"/></svg>',
        'permission' => 'adjustment.view||view_own_adjustment||adjustment.create||@Admin',
        'sort_order' => 8,
        'module' => 'stock_adjustment',
        'children' => [
            [
                'label' => 'stock_adjustment.list',
                'url' => '/stock-adjustments',
                'permission' => 'adjustment.view||view_own_adjustment||@Admin',
                'sort_order' => 1
            ],
            [
                'label' => 'stock_adjustment.add',
                'url' => '/stock-adjustments/create',
                'permission' => 'adjustment.create||@Admin',
                'sort_order' => 2
            ]
        ]
    ],

    /*──────────────────────── EXPENSES ───────────────────────*/
    [
        'label' => 'expense.expenses',
        'icon_type' => 'svg',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16l-3-2l-2 2l-2-2l-2 2l-2-2l-3 2"/><path d="M14.8 8a2 2 0 0 0 -1.8 -1h-2a2 2 0 1 0 0 4h2a2 2 0 1 1 0 4h-2a2 2 0 0 1 -1.8 -1"/><path d="M12 6v10"/></svg>',
        'permission' => 'all_expense.access||view_own_expense||expense.add||expense.edit||@Admin',
        'sort_order' => 9,
        'module' => 'expenses',
        'children' => [
            [
                'label' => 'lang_v1.list_expenses',
                'url' => '/expenses',
                'permission' => 'all_expense.access||view_own_expense||@Admin',
                'sort_order' => 1
            ],
            [
                'label' => 'expense.add_expense',
                'url' => '/expenses/create',
                'permission' => 'expense.add||@Admin',
                'sort_order' => 2
            ],
            [
                'label' => 'expense.expense_categories',
                'url' => '/expense-categories',
                'permission' => 'expense.add||expense.edit||@Admin',
                'sort_order' => 3
            ]
        ]
    ],

    /*──────────────────────── ACCOUNTS ───────────────────────*/
    [
        'label' => 'lang_v1.payment_accounts',
        'icon_type' => 'svg',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 5a3 3 0 0 1 3-3h12a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3H6a3 3 0 0 1 -3-3z"/><path d="M3 10h18"/><path d="M7 15h.01"/><path d="M11 15h2"/></svg>',
        'permission' => 'account.access||@Admin',
        'sort_order' => 10,
        'module' => 'account',
        'children' => [
            [
                'label' => 'account.list_accounts',
                'url' => '/account/account',
                'sort_order' => 1
            ],
            [
                'label' => 'account.balance_sheet',
                'url' => '/account/balance-sheet',
                'sort_order' => 2
            ],
            [
                'label' => 'account.trial_balance',
                'url' => '/account/trial-balance',
                'sort_order' => 3
            ],
            [
                'label' => 'lang_v1.cash_flow',
                'url' => '/account/cash-flow',
                'sort_order' => 4
            ],
            [
                'label' => 'account.payment_account_report',
                'url' => '/account/payment-account-report',
                'sort_order' => 5
            ]
        ]
    ],

    /*──────────────────────── REPORTS ───────────────────────*/
    [
        'label' => 'report.reports',
        'icon_type' => 'svg',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 5H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h5.7"/><path d="M18 14v4h4"/><path d="M18 11V7a2 2 0 0 0-2-2h-2"/><rect x="6" y="3" width="6" height="4" rx="2"/><circle cx="18" cy="18" r="4"/><path d="M8 11h4M8 15h3"/></svg>',
        'permission' => 'profit_loss_report.view||purchase_n_sell_report.view||contacts_report.view||stock_report.view||tax_report.view||trending_product_report.view||sales_representative.view||register_report.view||expense_report.view||@Admin',
        'sort_order' => 11,
        'children' => [
            [
                'label' => 'report.profit_loss',
                'url' => '/reports/profit-loss',
                'permission' => 'profit_loss_report.view||@Admin',
                'sort_order' => 1
            ],
            [
                'label' => 'report.purchase_sell_report',
                'url' => '/reports/purchase-sell',
                'permission' => 'purchase_n_sell_report.view||@Admin',
                'sort_order' => 2
            ],
            [
                'label' => 'report.tax_report',
                'url' => '/reports/tax-report',
                'permission' => 'tax_report.view||@Admin',
                'sort_order' => 3
            ],
            [
                'label' => 'report.contacts',
                'url' => '/reports/customer-supplier',
                'permission' => 'contacts_report.view||@Admin',
                'sort_order' => 4
            ],
            [
                'label' => 'lang_v1.customer_groups_report',
                'url' => '/reports/customer-group',
                'permission' => 'contacts_report.view||@Admin',
                'sort_order' => 5
            ],
            [
                'label' => 'report.stock_report',
                'url' => '/reports/stock-report',
                'permission' => 'stock_report.view||@Admin',
                'sort_order' => 6
            ],
            [
                'label' => 'report.stock_expiry_report',
                'url' => '/reports/stock-expiry',
                'permission' => 'stock_report.view||@Admin',
                'extra' => 'cs:enable_product_expiry',
                'sort_order' => 7
            ],
            [
                'label' => 'lang_v1.lot_report',
                'url' => '/reports/lot-report',
                'permission' => 'stock_report.view||@Admin',
                'extra' => 'cs:enable_lot_number',
                'sort_order' => 8
            ],
            [
                'label' => 'report.stock_adjustment_report',
                'url' => '/reports/stock-adjustment-report',
                'permission' => 'stock_report.view||@Admin',
                'module' => 'stock_adjustment',
                'sort_order' => 9
            ],
            [
                'label' => 'report.trending_products',
                'url' => '/reports/trending-products',
                'permission' => 'trending_product_report.view||@Admin',
                'sort_order' => 10
            ],
            [
                'label' => 'lang_v1.items_report',
                'url' => '/reports/items-report',
                'permission' => 'purchase_n_sell_report.view||@Admin',
                'sort_order' => 11
            ],
            [
                'label' => 'lang_v1.product_purchase_report',
                'url' => '/reports/product-purchase-report',
                'permission' => 'purchase_n_sell_report.view||@Admin',
                'sort_order' => 12
            ],
            [
                'label' => 'lang_v1.product_sell_report',
                'url' => '/reports/product-sell-report',
                'permission' => 'purchase_n_sell_report.view||@Admin',
                'sort_order' => 13
            ],
            [
                'label' => 'lang_v1.purchase_payment_report',
                'url' => '/reports/purchase-payment-report',
                'permission' => 'purchase_n_sell_report.view||@Admin',
                'sort_order' => 14
            ],
            [
                'label' => 'lang_v1.sell_payment_report',
                'url' => '/reports/sell-payment-report',
                'permission' => 'purchase_n_sell_report.view||@Admin',
                'sort_order' => 15
            ],
            [
                'label' => 'report.expense_report',
                'url' => '/reports/expense-report',
                'permission' => 'expense_report.view||@Admin',
                'module' => 'expenses',
                'sort_order' => 16
            ],
            [
                'label' => 'report.register_report',
                'url' => '/reports/register-report',
                'permission' => 'register_report.view||@Admin',
                'sort_order' => 17
            ],
            [
                'label' => 'report.sales_representative',
                'url' => '/reports/sales-representative-report',
                'permission' => 'sales_representative.view||@Admin',
                'sort_order' => 18
            ],
            [
                'label' => 'restaurant.table_report',
                'url' => '/reports/table-report',
                'permission' => 'purchase_n_sell_report.view||@Admin',
                'module' => 'tables',
                'sort_order' => 19
            ],
            [
                'label' => 'lang_v1.gst_sales_report',
                'url' => '/reports/gst-sales-report',
                'permission' => 'tax_report.view||@Admin',
                'extra' => 'cs:enable_gst_report_india',
                'sort_order' => 20
            ],
            [
                'label' => 'lang_v1.gst_purchase_report',
                'url' => '/reports/gst-purchase-report',
                'permission' => 'tax_report.view||@Admin',
                'extra' => 'cs:enable_gst_report_india',
                'sort_order' => 21
            ],
            [
                'label' => 'restaurant.service_staff_report',
                'url' => '/reports/service-staff-report',
                'permission' => 'sales_representative.view||@Admin',
                'module' => 'service_staff',
                'sort_order' => 22
            ],
            [
                'label' => 'lang_v1.activity_log',
                'url' => '/reports/activity-log',
                'permission' => 'superadmin',
                'sort_order' => 23
            ]
        ]
    ],

   
   // BACKUP
    [
        'label' => 'lang_v1.backup',
        'url' => '/backup',
        'permission' => 'backup',
        'icon_type' => 'svg',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 18h-5.343c-2.572-.004-4.657-2.011-4.657-4.487c0-2.475 2.085-4.482 4.657-4.482C7.05 7.269 8.45 5.831 10.332 5.258a5 5 0 0 1 5.444 1c1.488 1.19 2.162 3.007 1.77 4.769h.99c1.38 0 2.57.811 3.128 1.986"/><path d="M19 22v-6"/><path d="M22 19l-3-3-3 3"/></svg>',
        'sort_order' => 12,
    ],

    // MODULES
    [
        'label' => 'lang_v1.modules',
        'url' => '/manage-modules',
        'permission' => 'manage_modules',
        'icon_type' => 'svg',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 4l-8 4l8 4l8-4l-8-4"/><path d="M4 12l8 4l8-4"/><path d="M4 16l8 4l8-4"/></svg>',
        'sort_order' => 13,
    ],

    // BOOKING
    [
        'label' => 'restaurant.bookings',
        'url' => '/bookings',
        'permission' => 'crud_all_bookings||crud_own_bookings||@Admin',
        'icon_type' => 'svg',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="icon icon-tabler" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.5 21H6a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v6"/><path d="M16 3v4"/><path d="M8 3v4"/><path d="M4 11h16"/><path d="M15 19l2 2l4 -4"/></svg>',
        'sort_order' => 14,
        'module' => 'booking',
    ],

    // KITCHEN
    [
        'label' => 'restaurant.kitchen',
        'url' => '/modules/kitchen',
        'icon_type' => 'svg',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="icon icon-tabler" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12c2 -2.96 0 -7 -1 -8c0 3.038 -1.773 4.741 -3 6c-1.226 1.26 -2 3.24 -2 5a6 6 0 1 0 12 0c0 -1.532 -1.056 -3.94 -2 -5c-1.786 3 -2.791 3 -4 2z"/></svg>',
        'sort_order' => 15,
        'module' => 'kitchen',
    ],

    // ORDERS
    [
        'label' => 'restaurant.orders',
        'url' => '/modules/orders',
        'icon_type' => 'svg',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="18" class="icon icon-tabler" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 20h16"/><path d="M4 12h16"/><path d="M4 4h16"/></svg>',
        'sort_order' => 16,
        'module' => 'service_staff',
    ],

    // NOTIFICATION TEMPLATES
    [
        'label' => 'lang_v1.notification_templates',
        'url' => '/notification-templates',
        'permission' => 'send_notifications||@Admin',
        'icon_type' => 'svg',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="3" y="7" width="18" height="10" rx="2"/><path d="M3 7l9 6l9-6"/></svg>',
        'sort_order' => 17,
    ],
 //Application Settings(SuperAdmin)
    [
        'label' => 'settings.app_settings',
        'icon_type' => 'svg',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 32 32" stroke-width="0" stroke="currentColor" fill="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M16 18H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2M6 6v10h10V6Zm20 6v4h-4v-4zm0-2h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2m0 12v4h-4v-4zm0-2h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2m-10 2v4h-4v-4zm0-2h-4a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2"/></svg>',
        'permission' => 'superadmin',
        'sort_order' => 19,
        'module' => 'Superadmin',
        'children' => [
            [
                'label' => 'settings.app_settings',
                'url' => '/app/settings',
                'permission' => 'superadmin',
                'sort_order' => 1
            ],
             [
                'label' => 'settings.locked_users',
                'url' => '/app/locked-users',
                'permission' => 'superadmin',
                'sort_order' => 2
            ],
             [
                'label' => 'settings.otp_verification',
                'url' => '/app/otp-verification',
                'permission' => 'superadmin',
                'sort_order' => 3
            ],
           
            [
                'label' => 'settings.custom_menu',
                'url' => '/app/menus',
                'permission' => 'superadmin',
                'sort_order' => 4
            ],
            [
                'label' => 'settings.storage_migration',
                'url' => '/app/migration',
                'permission' => 'superadmin',
                'sort_order' => 5
            ],
             [
                'label' => 'settings.session_management',
                'url' => '/app/session-management',
                'permission' => 'superadmin',
                'sort_order' => 6,
            ]
        ]
    ],
    // SETTINGS
    [
        'label' => 'business.settings',
        'permission' => 'business_settings.access||barcode_settings.access||invoice_settings.access||tax_rate.view||tax_rate.create||access_package_subscriptions||product.view||product.create||access_types_of_service||access_tables||access_printers||@Admin',
        'icon_type' => 'svg',
        'icon_svg' => '<svg xmlns="http://www.w3.org/2000/svg" class="tw-size-5" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94-1.543 .826-3.31 2.37-2.37c1 .608 2.296.07 2.572 -1.065z"/><circle cx="12" cy="12" r="3"/></svg>',
        'sort_order' => 19,
        'children' => [
            [
                'label' => 'business.business_settings',
                'url' => '/business/settings',
                'permission' => 'business_settings.access||@Admin',
                'sort_order' => 1
            ],
            [
                'label' => 'business.business_locations',
                'url' => '/business-location',
                'permission' => 'business_settings.access||@Admin',
                'sort_order' => 2
            ],
            [
                'label' => 'invoice.invoice_settings',
                'url' => '/invoice-schemes',
                'permission' => 'invoice_settings.access||@Admin',
                'sort_order' => 3
            ],
            [
                'label' => 'barcode.barcode_settings',
                'url' => '/barcodes',
                'permission' => 'barcode_settings.access||@Admin',
                'sort_order' => 4
            ],
            [
                'label' => 'printer.receipt_printers',
                'url' => '/printers',
                'permission' => 'access_printers||@Admin',
                'sort_order' => 5
            ],
            [
                'label' => 'tax_rate.tax_rates',
                'url' => '/tax-rates',
                'permission' => 'tax_rate.view||tax_rate.create||@Admin',
                'sort_order' => 6
            ],
            [
                'label' => 'restaurant.tables',
                'url' => '/modules/tables',
                'permission' => 'access_tables||@Admin',
                'module' => 'tables',
                'sort_order' => 7
            ],
            [
                'label' => 'restaurant.modifiers',
                'url' => '/modules/modifiers',
                'permission' => 'product.view||product.create||@Admin',
                'module' => 'modifiers',
                'sort_order' => 8
            ],
            [
                'label' => 'lang_v1.types_of_service',
                'url' => '/types-of-service',
                'permission' => 'access_types_of_service||@Admin',
                'module' => 'types_of_service',
                'sort_order' => 9
            ],
            [
                'label' => 'superadmin::lang.subscription',
                'url' => '/subscription',
                'permission' => 'superadmin.access_package_subscriptions||@Admin',
                'module' => 'Superadmin',
                'sort_order' => 10
            ]
        ]
    ],

];