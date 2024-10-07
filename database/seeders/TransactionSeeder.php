<?php

namespace Database\Seeders;

use App\Models\PaymentMethod;
use App\Models\Ticket;
use App\Models\TourPackage;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transactions = Transaction::factory(100)->create();
        $tourPackages = TourPackage::inRandomOrder()->get();
        $paymentMethods = PaymentMethod::inRandomOrder()->get();

        foreach ($transactions as $transaction) {
            $quantity = rand(1, 10);
            $selectedPackages = $tourPackages->random();
            $randomPaymentMethod = $paymentMethods->random();

            $transaction->update([
                'payment_method' => $randomPaymentMethod->payment_name, 
                'package_name' => $selectedPackages->name, 
                'quantity' => $quantity,
                'price' => $selectedPackages->price,
            ]);
            // foreach ($selectedPackages as $tourPackage) {
            //     TransactionDetail::create([
            //         'transaction_id' => $transaction->id,
            //         'tour_package_id' => $tourPackage->id,
            //         'package_name' => $tourPackage->name,
            //         'price' => $tourPackage->price,
            //         'quantity' => $quantity,
            //     ]);

            //     // for ($i=0; $i < $quantity; $i++) {
            //     //     Ticket::factory()->create([
            //     //         'ticket_code' => (new Ticket())->generateTicketCode($transaction->transaction_code, $tourPackage->tour_package_code),
            //     //         'tour_package_id' => $tourPackage->id,
            //     //         'transaction_id' => $transaction->id,
            //     //         'visitor_name' => $transaction->customer_name,
            //     //     ]);
            //     // }
            // }
        }
    }
}
