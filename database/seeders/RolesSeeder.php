<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class RolesSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Schema::disableForeignKeyConstraints();
		Role::truncate();
		Schema::enableForeignKeyConstraints();

		$roles = Arr::map(roles(), function ($item) {
			$item['created_at'] = now();
			$item['updated_at'] = now();
			return $item;
		});

		Role::insert($roles);
	}
}
