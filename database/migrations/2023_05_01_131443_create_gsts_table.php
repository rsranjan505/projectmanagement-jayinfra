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
        Schema::create('gsts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model_id');
			$table->string('model_type');
            $table->string('gstin');
            $table->tinyInteger('is_primary')->default(0);
            $table->string('address')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
			$table->unsignedBigInteger('state_id')->nullable();
			$table->unsignedBigInteger('city_id')->nullable();
            $table->string('postcode',20)->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gsts');
    }
};
