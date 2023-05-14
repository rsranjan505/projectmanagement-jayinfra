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
        Schema::create('panchayats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('block_id');
            $table->string('code')->nullable();
            $table->string('name');
            $table->tinyInteger('is_active')->default(1);

            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panchayats');
    }
};
