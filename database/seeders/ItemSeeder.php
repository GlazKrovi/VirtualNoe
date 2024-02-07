<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $FOOD_TYPE = 'Food';
        $BOOST_TYPE = 'Boost';
        $DRUG_TYPE = 'Drug';

        Item::updateOrCreate([
            'name' => 'Pet Food',
            'type' => $FOOD_TYPE,
            'price' => 5,
            'modificator' => 10,
        ]);
        Item::updateOrCreate([
            'name' => 'Cookie',
            'type' => $FOOD_TYPE,
            'price' => 10,
            'modificator' => 5,
        ]);

        Item::updateOrCreate([
            'name' => 'Vitamin',
            'type' => $BOOST_TYPE,
            'price' => 18,
            'modificator' => 8,
        ]);
        Item::updateOrCreate([
            'name' => 'Energy Elixir',
            'type' => $BOOST_TYPE,
            'price' => 25,
            'modificator' => 15,
        ]);

        Item::updateOrCreate([
            'name' => 'Morphine',
            'type' => $DRUG_TYPE,
            'price' => 10,
            'modificator' => 8,
        ]);
        Item::updateOrCreate([
            'name' => 'Pills',
            'type' => $DRUG_TYPE,
            'price' => 25,
            'modificator' => 40,
        ]);
    }
}
