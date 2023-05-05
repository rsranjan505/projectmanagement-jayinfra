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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_category_id')->nullable();
            $table->string('sku');
			$table->string('name');
            $table->string('code')->nullable();
            $table->string('brand')->nullable();
            $table->string('model_no')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->unsignedBigInteger('tax_rate_id')->nullable();
            $table->string('hsn_code')->nullable();
            $table->decimal('mrp',12,2)->nullable();
            $table->decimal('sell_price',12,2)->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('is_active')->default(1);
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();

            $table->foreign('tax_rate_id')->references('id')->on('tax_rates')->onDelete('cascade');
            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
