<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'user.view'],
            ['name' => 'user.create'],
            ['name' => 'user.update'],
            ['name' => 'user.delete'],

            ['name' => 'supplier.view'],
            ['name' => 'supplier.create'],
            ['name' => 'supplier.update'],
            ['name' => 'supplier.delete'],

            ['name' => 'customer.view'],
            ['name' => 'customer.create'],
            ['name' => 'customer.update'],
            ['name' => 'customer.delete'],

            ['name' => 'product.view'],
            ['name' => 'product.create'],
            ['name' => 'product.update'],
            ['name' => 'product.delete'],

            ['name' => 'purchase.view'],
            ['name' => 'purchase.create'],
            ['name' => 'purchase.update'],
            ['name' => 'purchase.delete'],

            ['name' => 'sell.view'],
            ['name' => 'sell.create'],
            ['name' => 'sell.update'],
            ['name' => 'sell.delete'],

            ['name' => 'purchase_n_sell_report.view'],
            ['name' => 'contacts_report.view'],
            ['name' => 'stock_report.view'],
            ['name' => 'tax_report.view'],
            ['name' => 'trending_product_report.view'],
            ['name' => 'register_report.view'],
            ['name' => 'sales_representative.view'],
            ['name' => 'expense_report.view'],

            ['name' => 'business_settings.access'],
            ['name' => 'barcode_settings.access'],
            ['name' => 'invoice_settings.access'],

            ['name' => 'brand.view'],
            ['name' => 'brand.create'],
            ['name' => 'brand.update'],
            ['name' => 'brand.delete'],

            ['name' => 'tax_rate.view'],
            ['name' => 'tax_rate.create'],
            ['name' => 'tax_rate.update'],
            ['name' => 'tax_rate.delete'],

            ['name' => 'unit.view'],
            ['name' => 'unit.create'],
            ['name' => 'unit.update'],
            ['name' => 'unit.delete'],

            ['name' => 'category.view'],
            ['name' => 'category.create'],
            ['name' => 'category.update'],
            ['name' => 'category.delete'],

            ['name' => 'expense.access'],

            ['name' => 'access_all_locations'],

            ['name' => 'dashboard.data'],

            ['name' => 'view_cash_register'],
            ['name' => 'close_cash_register'],

            ['name' => 'supplier.view_own'],

            ['name' => 'view_product_stock_value'],

            ['name' => 'access_sell_return'],
            ['name' => 'customer.view_own'],
            ['name' => 'view_own_expense'],
            ['name' => 'view_own_purchase'],
            ['name' => 'access_printers'],

            ['name' => 'product.opening_stock'],
            ['name' => 'access_default_selling_price'],
            ['name' => 'purchase.payments'],
            ['name' => 'sell.payments'],
            ['name' => 'edit_product_price_from_sale_screen'],
            ['name' => 'edit_product_discount_from_sale_screen'],
            ['name' => 'roles.view'],
            ['name' => 'roles.create'],
            ['name' => 'roles.update'],
            ['name' => 'roles.delete'],
            ['name' => 'account.access'],
            ['name' => 'discount.access'],
            ['name' => 'view_purchase_price'],
            ['name' => 'view_own_sell_only'],
            ['name' => 'edit_product_discount_from_pos_screen'],
            ['name' => 'edit_product_price_from_pos_screen'],
            ['name' => 'access_shipping'],
            ['name' => 'purchase.update_status'],
            ['name' => 'list_drafts'],
            ['name' => 'list_quotations'],
            ['name' => 'print_invoice'],


        ];

        $insert_data = [];
        $time_stamp = \Carbon::now()->toDateTimeString();
        foreach ($data as $d) {
            $d['guard_name'] = 'web';
            $d['created_at'] = $time_stamp;
            $insert_data[] = $d;
        }
        Permission::insert($insert_data);
    }
}
