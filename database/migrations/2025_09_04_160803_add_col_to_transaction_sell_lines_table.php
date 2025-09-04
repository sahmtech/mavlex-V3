<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('transaction_sell_lines', function (Blueprint $table) {
            $table->unsignedInteger('tax_id_2')->nullable()->after('tax_id');
            $table->foreign('tax_id_2')->references('id')->on('tax_rates')->onDelete('CASCADE');
            $table->decimal('item_tax_2', 22, 4)->nullable()->after('tax_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_sell_lines', function (Blueprint $table) {
            $table->dropForeign(['tax_id_2']);
            $table->dropColumn(['tax_id_2', 'item_tax_2']);
        });
    }
};
