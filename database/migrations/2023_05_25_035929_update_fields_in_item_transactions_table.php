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
        Schema::table('stock_items', function (Blueprint $table) {
            $table->decimal('quantity','16','2')->nullable()->change();
        });

        Schema::table('item_transactions', function (Blueprint $table) {
            $table->decimal('quantity','16','2')->nullable()->change();
            $table->decimal('unit_amount','16','2')->nullable()->change();
            $table->decimal('total_amount','16','2')->nullable()->change();
            $table->decimal('cgst','16','2')->nullable()->change();
            $table->decimal('sgst','16','2')->nullable()->change();
            $table->decimal('igst','16','2')->nullable()->change();
            $table->decimal('tax_amount','16','2')->nullable()->change();
            $table->decimal('net_amount','16','2')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('item_transactions', function (Blueprint $table) {
            //
        });
    }
};
