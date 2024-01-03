<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Boost;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /* create user AFTER items 
        (because some items will be gived to him when user is created!) */
        $this->call([
            FoodSeeder::class,
            BoostSeeder::class,
            UserSeeder::class,

        ]);
    }
}
