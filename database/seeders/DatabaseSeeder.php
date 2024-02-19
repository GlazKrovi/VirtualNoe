<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ItemSeeder::class, /* create user AFTER items (because some 
                items will be gived to him when user is created!) */
            UserSeeder::class,
            CreatureSeeder::class,
        ]);
    }
}
