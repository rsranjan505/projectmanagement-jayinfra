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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
			$table->string('business_name');
            $table->string('pan');
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address');
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
        Schema::dropIfExists('suppliers');
    }
};
