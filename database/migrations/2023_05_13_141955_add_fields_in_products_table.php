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
            $table->dropColumn('brand');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('sku');
            $table->string('name_desc')->nullable()->after('color');
            $table->unsignedBigInteger('brand_id')->nullable()->after('code');
            $table->unsignedBigInteger('created_by')->nullable()->after('description');

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('name_desc');
            $table->string('sku')->nullable()->after('id');
            $table->string('brand')->nullable()->after('code');
            $table->dropForeign('brand_id');
            $table->dropColumn('brand_id');
            $table->dropForeign('created_by');
            $table->dropColumn('created_by');
        });
    }
};
