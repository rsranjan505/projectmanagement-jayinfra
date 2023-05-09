<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class DepartmentSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Schema::disableForeignKeyConstraints();
		Department::truncate();
		Schema::enableForeignKeyConstraints();

		$departments = Arr::map(departments(), function ($item) {
			$item['created_at'] = now();
			$item['updated_at'] = now();
			return $item;
		});

		Department::insert($departments);
	}
}
