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
        Schema::create('villages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('panchayat_id');
            $table->string('code')->nullable();
            $table->string('name');
            $table->tinyInteger('is_active')->default(1);
            $table->timestamps();
            $table->foreign('panchayat_id')->references('id')->on('panchayats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villages');
    }
};
