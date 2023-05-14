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
        Schema::create('project_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->tinyInteger('is_primary')->default(0);
            $table->unsignedBigInteger('project_phase_id')->nullable();
            $table->string('address');
			$table->unsignedBigInteger('state_id');
			$table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('block_id');
            $table->unsignedBigInteger('panchayat_id')->nullable();
            $table->unsignedBigInteger('village_id')->nullable();
            $table->string('postcode',20)->nullable();
            $table->unsignedBigInteger('created_by');
            $table->tinyInteger('is_active')->default(1);
            $table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('project_phase_id')->references('id')->on('project_phases')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');
            $table->foreign('panchayat_id')->references('id')->on('panchayats')->onDelete('cascade');
            $table->foreign('village_id')->references('id')->on('villages')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_locations');
    }
};
