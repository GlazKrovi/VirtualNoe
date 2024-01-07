<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // fake
        User::createWithItems([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
        ]);
        
        User::createWithItems([
            'name' => 'Alice Smith',
            'email' => 'alice@example.com',
            'password' => Hash::make('password'),
        ]);
        
        User::createWithItems([
            'name' => 'Michael Johnson',
            'email' => 'michael@example.com',
            'password' => Hash::make('password'),
        ]);
        
        User::createWithItems([
            'name' => 'Emily Brown',
            'email' => 'emily@example.com',
            'password' => Hash::make('password'),
        ]);
        
        User::createWithItems([
            'name' => 'William Wilson',
            'email' => 'william@example.com',
            'password' => Hash::make('password'),
        ]);
        
        User::createWithItems([
            'name' => 'Sophia Garcia',
            'email' => 'sophia@example.com',
            'password' => Hash::make('password'),
        ]);
        
        User::createWithItems([
            'name' => 'Daniel Martinez',
            'email' => 'daniel@example.com',
            'password' => Hash::make('password'),
        ]);
        
        User::createWithItems([
            'name' => 'Olivia Lopez',
            'email' => 'olivia@example.com',
            'password' => Hash::make('password'),
        ]);
        
        User::createWithItems([
            'name' => 'Alexander Gonzalez',
            'email' => 'alexander@example.com',
            'password' => Hash::make('password'),
        ]);
        
        User::createWithItems([
            'name' => 'Isabella Rodriguez',
            'email' => 'isabella@example.com',
            'password' => Hash::make('password'),
        ]);

        // for tests
        User::createWithItems([ 
            'name' => 'a',
            'email' => 'a@gmail.com',
            'password' => 'a',
        ]);
    }        
}
