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
        Schema::create('item_transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model_type')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();
            $table->enum('type',['purchase','sell','damage','used'])->nullable();
            $table->decimal('quantity','6','4')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedBigInteger('tax_rate_id')->nullable();
            $table->decimal('unit_amount','10','2');
            $table->decimal('total_amount','10','2');
            $table->decimal('cgst','10','2');
            $table->decimal('sgst','10','2');
            $table->decimal('igst','10','2');
            $table->decimal('tax_amount','10','2');
            $table->decimal('net_amount','10','2');
            $table->unsignedBigInteger('created_by');
            $table->tinyInteger('is_active')->default(1);
            $table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->foreign('tax_rate_id')->references('id')->on('tax_rates')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_transactions');
    }
};
