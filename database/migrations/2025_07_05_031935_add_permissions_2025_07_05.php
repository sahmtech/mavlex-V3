<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{
    /** ---------------------------------
     *  NEW PERMISSIONS, 05-Jul-2025
     *  ---------------------------------
     */
    private array $permissions = [
        // Generic / UI
        ['name' => 'view_export_buttons'],
        ['name' => 'edit_invoice_number'],

        // Stock adjustment
        ['name' => 'adjustment.view'],
        ['name' => 'view_own_adjustment'],
        ['name' => 'adjustment.create'],
        ['name' => 'adjustment.update'],
        ['name' => 'adjustment.delete'],

        // Purchase-side extras
        ['name' => 'edit_purchase_payment'],
        ['name' => 'delete_purchase_payment'],

        // Purchase requisition
        ['name' => 'purchase_requisition.view_all'],
        ['name' => 'purchase_requisition.view_own'],
        ['name' => 'purchase_requisition.create'],
        ['name' => 'purchase_requisition.delete'],

        // Purchase order
        ['name' => 'purchase_order.view_all'],
        ['name' => 'purchase_order.view_own'],
        ['name' => 'purchase_order.create'],
        ['name' => 'purchase_order.update'],
        ['name' => 'purchase_order.delete'],

        // Direct sale / POS filters
        ['name' => 'direct_sell.view'],
        ['name' => 'direct_sell.access'],
        ['name' => 'direct_sell.update'],
        ['name' => 'direct_sell.delete'],
        ['name' => 'view_paid_sells_only'],
        ['name' => 'view_due_sells_only'],
        ['name' => 'view_partial_sells_only'],
        ['name' => 'view_overdue_sells_only'],
        ['name' => 'view_commission_agent_sell'],
        ['name' => 'access_types_of_service'],
        ['name' => 'access_own_sell_return'],

        // Sales order
        ['name' => 'so.view_all'],
        ['name' => 'so.view_own'],
        ['name' => 'so.create'],
        ['name' => 'so.update'],
        ['name' => 'so.delete'],

        // Drafts & quotations
        ['name' => 'draft.view_all'],
        ['name' => 'draft.view_own'],
        ['name' => 'draft.update'],
        ['name' => 'draft.delete'],
        ['name' => 'quotation.view_all'],
        ['name' => 'quotation.view_own'],
        ['name' => 'quotation.update'],
        ['name' => 'quotation.delete'],

        // Shipments
        ['name' => 'access_pending_shipments_only'],
        ['name' => 'access_own_shipping'],
        ['name' => 'access_commission_agent_shipping'],

        // Reports
        ['name' => 'profit_loss_report.view'],
        ['name' => 'purchase_sell_mismatch.view'],
        ['name' => 'purchase_sell_mismatch.fix'],

        // Expense / accounts
        ['name' => 'all_expense.access'],
        ['name' => 'expense.add'],
        ['name' => 'expense.edit'],
        ['name' => 'expense.delete'],
        ['name' => 'edit_account_transaction'],
        ['name' => 'delete_account_transaction'],

        // Bookings / tables
        ['name' => 'crud_all_bookings'],
        ['name' => 'crud_own_bookings'],
        ['name' => 'access_tables'],
    ];

    public function up(): void
    {
        $now = now()->toDateTimeString();

        $rows = collect($this->permissions)->map(function ($perm) use ($now) {
            return array_merge($perm, [
                'guard_name' => 'web',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        })->all();

        DB::table('permissions')->upsert(
            $rows,
            ['name', 'guard_name'],   
            []                      
        );

        Artisan::call('permission:cache-reset');
    }

    public function down(): void
    {
        // DB::table('permissions')
        //     ->whereIn('name', array_column($this->permissions, 'name'))
        //     ->where('guard_name', 'web')
        //     ->delete();

        // Artisan::call('permission:cache-reset');
    }
};
