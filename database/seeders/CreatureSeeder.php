<?php

namespace Database\Seeders;

use App\Models\Creature;
use App\Models\User;
use Illuminate\Database\Seeder;

class CreatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owner = User::where('name', 'a')->first();

        // create fake creature
        Creature::create([
            'name' => "Bozlov",
            'species' => "Dog",
            'user_id' => $owner->id(),
        ]);
    }  
}
