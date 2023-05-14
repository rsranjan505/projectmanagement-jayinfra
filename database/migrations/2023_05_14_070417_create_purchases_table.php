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
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id')->nullable(false);
            $table->unsignedBigInteger('supplier_id')->nullable(false);
            $table->string('invoice_number','100')->nullable(false);
            $table->date('invoice_date')->nullable(false);
            $table->decimal('amount','10','2')->nullable();
            $table->unsignedBigInteger('tax_rate_id')->nullable();
            $table->decimal('tax_amount','10','2');
            $table->decimal('invoice_amount','10','2');
            $table->unsignedBigInteger('created_by');
            $table->tinyInteger('is_active')->default(1);
            $table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
            $table->foreign('tax_rate_id')->references('id')->on('tax_rates')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
