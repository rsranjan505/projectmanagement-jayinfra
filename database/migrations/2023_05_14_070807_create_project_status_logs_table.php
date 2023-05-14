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
        Schema::create('project_status_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('project_status_id');
            $table->unsignedBigInteger('created_by');
            $table->tinyInteger('is_active')->default(1);
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();

            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('project_status_id')->references('id')->on('project_statuses')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_status_logs');
    }
};
