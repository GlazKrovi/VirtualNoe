<?php

namespace Database\Seeders;

use App\Models\Item;
use App\Models\Food;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $TYPE = 'Food';

        Food::create([
            'name' => 'Pet Food',
            'type' => $TYPE,
            'price' => 5,
            'calories' => 10,
        ]);

        Food::create([
            'name' => 'Cookie',
            'type' => $TYPE,
            'price' => 10,
            'calories' => 5,
        ]);
    }
}
