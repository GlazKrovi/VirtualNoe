<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::create([ 
            'name' => 'a',
            'email' => 'a@gmail.com',
            'password' => 'a',
        ]);
    }        
}
