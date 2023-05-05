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
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile')->nullable()->after('email');
            $table->string('gender',20)->nullable()->after('password');
            $table->unsignedBigInteger('department_id')->nullable()->after('gender');
            $table->unsignedBigInteger('designation_id')->nullable()->after('department_id');
            $table->unsignedBigInteger('role_id')->nullable()->after('designation_id');
            $table->unsignedBigInteger('team_id')->nullable()->after('role_id');
            $table->string('employee_id')->nullable()->after('team_id');
            $table->enum('employee_type',['full time', 'contract', 'part time'])->nullable()->after('employee_id');
            $table->unsignedBigInteger('reporting_manager_id')->nullable()->after('employee_type');
            $table->string('address')->nullable()->after('reporting_manager_id');
            $table->unsignedBigInteger('country_id')->nullable()->after('address');
			$table->unsignedBigInteger('state_id')->nullable()->after('country_id');
			$table->unsignedBigInteger('city_id')->nullable()->after('state_id');
            $table->string('postcode',20)->nullable()->after('city_id');
            $table->tinyInteger('is_active')->default(1)->after('postcode');
            $table->tinyInteger('is_admin')->default(0)->after('is_active');
            $table->dateTime('last_login')->nullable()->after('is_admin');
            $table->foreign('reporting_manager_id')->references('id')->on('users');
			$table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
			$table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
			$table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
