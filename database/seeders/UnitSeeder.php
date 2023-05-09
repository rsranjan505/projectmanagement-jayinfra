<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class UnitSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Schema::disableForeignKeyConstraints();
		Unit::truncate();
		Schema::enableForeignKeyConstraints();

		$units = Arr::map(units(), function ($item) {
			$item['created_at'] = now();
			$item['updated_at'] = now();
			return $item;
		});

		Unit::insert($units);
	}
}
