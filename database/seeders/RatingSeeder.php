<?php

namespace Database\Seeders;

use App\Models\Rating;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rating::create([
            'name' => 'Hanif Pandu Nugroho',
            'stars' => 5,
            'image' => null,
            'description' => 'Terimakasih telah menerima saya untuk melaksanakan kegiatan praktikum 🙏🏻, semoga rumpi jember semakin berkembang dan sukses selalu aamiin ya rabbal alamin',
            'is_displayed' => true,
            'created_at' => Carbon::now()->subMonths(9), // Set created_at to 9 months ago
            'updated_at' => Carbon::now()->subMonths(9),
        ]);
        Rating::create([
            'name' => 'BUFF TRAVELER',
            'stars' => 5,
            'image' => null,
            'description' => 'Cool and educative place at, karangharjo village, silo, Jember. Fun education Center for public and students. We can learn anything about history, sains, and edupark. The owner is friendly and family. Important think is, tadabur, trip, silaturahmi.',
            'is_displayed' => true,
            'created_at' => Carbon::now()->subMonths(12), // Set created_at to 9 months ago
            'updated_at' => Carbon::now()->subMonths(12),
        ]);
        Rating::create([
            'name' => 'Amrullah',
            'stars' => 5,
            'image' => null,
            'description' => 'Edukatif dan inspiratif',
            'is_displayed' => true,
            'created_at' => Carbon::now()->subMonths(36), // Set created_at to 9 months ago
            'updated_at' => Carbon::now()->subMonths(36),
        ]);
    }
}
