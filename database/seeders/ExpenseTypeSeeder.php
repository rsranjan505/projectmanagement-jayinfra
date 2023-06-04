<?php

namespace Database\Seeders;

use App\Models\ExpenseType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Schema;

class ExpenseTypeSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Schema::disableForeignKeyConstraints();
		ExpenseType::truncate();
		Schema::enableForeignKeyConstraints();

		$expenseType = Arr::map(expenseType(), function ($item) {
			$item['created_at'] = now();
			$item['updated_at'] = now();
			return $item;
		});
		$collection =  collect($expenseType);
		$chunks = $collection->chunk(5000);
		$array = $chunks->all();
		foreach ($array as $expenseType) {
			ExpenseType::insert($expenseType->toArray());
		}
	}
}
