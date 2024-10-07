<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\TourPackage;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tourPackages = TourPackage::inRandomOrder()->get();
        $transactions = Transaction::get();

        foreach ($transactions as $transaction) {
            $numDetails = rand(1, $tourPackages->count());
            $selectedPackages = $tourPackages->random($numDetails);

            foreach ($selectedPackages as $tourPackage) {
                Ticket::create([
                    'tour_package_id' => $tourPackage->id,
                    'transaction_id' => $transaction->id,
                    'visitor_name' => $tourPackage->name,
                ]);
            }
        }
    }
}
