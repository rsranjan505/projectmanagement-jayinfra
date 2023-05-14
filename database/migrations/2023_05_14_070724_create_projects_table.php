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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('short_desc');
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->longText('long_desc')->nullable();
            $table->enum('project_type',['internal','client-project','government'])->nullable();// here government for nal jal
            $table->date('start_date')->nullable();
            $table->date('deadline')->nullable();
            $table->string('duration')->nullable();
            $table->decimal('project_extimated_cost',15,2)->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('project_status_id')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->tinyInteger('is_active')->default(1);
            $table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('staff_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_status_id')->references('id')->on('project_statuses')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
