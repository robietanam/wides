<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'BlastTea',
            'email' => 'arya.jbr.999@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('123'),
        ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('123'),
        ]);

        User::factory()->create([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'role' => 'manager',
            'password' => Hash::make('123'),
        ]);

        User::factory()->create([
            'name' => 'visitor',
            'email' => 'visitor@gmail.com',
            'role' => 'visitor',
            'password' => Hash::make('123'),
        ]);
    }
}
