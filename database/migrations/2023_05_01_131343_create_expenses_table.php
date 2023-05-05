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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('model_id')->nullable();
			$table->string('model_type')->nullable();
            $table->unsignedBigInteger('expanse_type_id');
            $table->string('status');
            $table->date('date')->nullable();
            $table->decimal('amount',12,2);
            $table->string('description');
            $table->unsignedBigInteger('checked_by')->nullable();
            $table->string('cancel_reason')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->tinyInteger('is_active')->default(1);
			$table->timestamp('created_at')->nullable();
			$table->timestamp('updated_at')->nullable();
            $table->foreign('expanse_type_id')->references('id')->on('expense_types')->onDelete('cascade');
            $table->foreign('checked_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};
