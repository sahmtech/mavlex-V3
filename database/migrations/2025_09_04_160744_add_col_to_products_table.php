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
        Schema::table('products', function (Blueprint $table) {
            $table->enum('tax_2_type', ['inclusive', 'exclusive'])->index()->after('tax_type');
            $table->unsignedInteger('tax_2')->nullable()->after('tax');
            $table->foreign('tax_2')->references('id')->on('tax_rates')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['tax_2']);
            $table->dropColumn(['tax_2_type', 'tax_2']);
        });
    }
};