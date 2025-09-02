<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('label');
            $table->string('route')->nullable();
            $table->string('url')->nullable();
            $table->enum('icon_type', ['svg','fa'])->default('svg');
            $table->text('icon_svg')->nullable();
            $table->string('icon_fa')->nullable();
            $table->text('permission')->nullable();
            $table->string('module')->nullable();
            $table->json('extra')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            // CRITICAL: Index on parent_id for hierarchical queries
            $table->index('parent_id');
            
            // Composite index for common query patterns
            $table->index(['parent_id', 'sort_order']);
            $table->index(['is_active', 'sort_order']);
            $table->index(['is_active', 'parent_id', 'sort_order']);
            
            // Add foreign key constraint separately for better control
            $table->foreign('parent_id')
                  ->references('id')
                  ->on('menus')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};