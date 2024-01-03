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
        /* FOOD */
        Food::create([
            'name' => 'Pet Food',
            'type' => 'Food',
            'price' => 5,
            'calories' => 10,
        ]);

        Food::create([
            'name' => 'Cookie',
            'type' => 'Food',
            'price' => 10,
            'calories' => 5,
        ]);

        /* CARE */
        Item::create([
            'name' => 'Healing Potion',
            'type' => 'Care',
            'price' => 20,
        ]);

        Item::create([
            'name' => 'Grooming Kit',
            'type' => 'Care',
            'price' => 15,
        ]);        
    }
}
