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
        Schema::create('stock_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->nullable(false);
            $table->decimal('quantity','6','4')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_items');
    }
};
