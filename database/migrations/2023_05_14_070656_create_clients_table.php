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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type',['government','private'])->nullable();
            $table->string('business_name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile')->nullable();
            $table->string('address');
			$table->unsignedBigInteger('state_id')->nullable();
			$table->unsignedBigInteger('city_id')->nullable();
            $table->string('postcode',20)->nullable();
            $table->unsignedBigInteger('created_by');
            $table->tinyInteger('is_active')->default(1);
            $table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
