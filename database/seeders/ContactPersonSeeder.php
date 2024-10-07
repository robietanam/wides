<?php

namespace Database\Seeders;

use App\Models\ContactPerson;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContactPerson::create([
            'name' => 'Alice Johnson',
            'role' => 'transaksi',
            'number' => '08123456789',
        ]);

        ContactPerson::create([
            'name' => 'Bob Smith',
            'role' => 'beranda',
            'number' => '08987654321',
        ]);
    }
}
