<?php

namespace Database\Seeders;

use App\Models\Designation;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class DesignationSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Schema::disableForeignKeyConstraints();
		Designation::truncate();
		Schema::enableForeignKeyConstraints();

		$designations = Arr::map(designations(), function ($item) {
			$item['created_at'] = now();
			$item['updated_at'] = now();
			return $item;
		});

		Designation::insert($designations);
	}
}
