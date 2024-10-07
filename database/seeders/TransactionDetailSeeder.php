<?php

namespace Database\Seeders;

use App\Models\TourPackage;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use App\Models\TransactionDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionDetailSeeder extends Seeder
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
            $totalAmount = 0;

            foreach ($selectedPackages as $tourPackage) {
                $quantity = rand(1, 10);
                $amount = $tourPackage->price * $quantity;
                $totalAmount += $amount;

                TransactionDetail::create([
                    'tour_package_id' => $tourPackage->id,
                    'transaction_id' => $transaction->id,
                    'package_name' => $tourPackage->name,
                    'price' => $tourPackage->price,
                    'quantity' => $quantity,
                ]);
            }
        }
    }
}
