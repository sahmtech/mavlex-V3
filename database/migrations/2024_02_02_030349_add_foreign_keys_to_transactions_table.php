<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign(['business_id'])->references(['id'])->on('business')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['contact_id'])->references(['id'])->on('contacts')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['created_by'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['expense_category_id'])->references(['id'])->on('expense_categories')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['expense_for'])->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('CASCADE');
            $table->foreign(['location_id'])->references(['id'])->on('business_locations')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['tax_id'])->references(['id'])->on('tax_rates')->onUpdate('NO ACTION')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign('transactions_business_id_foreign');
            $table->dropForeign('transactions_contact_id_foreign');
            $table->dropForeign('transactions_created_by_foreign');
            $table->dropForeign('transactions_expense_category_id_foreign');
            $table->dropForeign('transactions_expense_for_foreign');
            $table->dropForeign('transactions_location_id_foreign');
            $table->dropForeign('transactions_tax_id_foreign');
        });
    }
};
