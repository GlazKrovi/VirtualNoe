<?php

namespace Database\Seeders;

use App\Models\Boost;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BoostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $TYPE = 'Boost';

        Boost::create([
            'name' => 'Vitamin',
            'type' => $TYPE,
            'price' => 18,
            'energy' => 8,
        ]);

        Boost::create([
            'name' => 'Energy Elixir',
            'type' => $TYPE,
            'price' => 25,
            'energy' => 15,
        ]);
    }
}
