<?php

namespace App\Filament\Resources\TransaksiResource\Pages;

use App\Filament\Resources\TransaksiResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransaksi extends EditRecord
{
    protected static string $resource = TransaksiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

public function mount(int|string $record): void
{
    parent::mount($record);

    // Get the transaction record
    $transaction = $this->record; // Assuming $this->record is the Transaction model instance
    $discount = intval($transaction->discount ?? 0);
    $quantity = intval($transaction->quantity ?? 1);
    $price = intval($transaction->price ?? 0);

    // Calculate total before discount
    $totalBeforeDiscount = $price * $quantity;

    // Apply discount
    $finalTotal = $this->applyDiscount($totalBeforeDiscount, $discount);
    // Fill the form with the transaction data
    $this->form->fill([
        'name' => $transaction->name, // Updated to match your model
        'email' => $transaction->email,
        'noTelp' => $transaction->noTelp,
        'discount' => $discount,
        'status' => $transaction->status,
        'payment_method' => $transaction->payment_method,
        'quantity' => $transaction->quantity,
        'total' => $finalTotal,
        'price' => $transaction->price,
        'transaction_code' => $transaction->transaction_code, // Include transaction code
        'visit_date' => $transaction->visit_date, // Include visit date if needed
        'package_name' => $transaction->package_name, // Include package name if needed
    ]);
}


// Fungsi untuk menerapkan diskon
protected function applyDiscount($total, $discount)
    {
        $discountAmount = ($discount / 100) * $total;
        return number_format($total - $discountAmount, 0, ',', '.');
    }
   

}
