<?php

namespace App\Observers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Cache;

class TransactionObserver
{
    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        // Clear cache if needed
        Cache::forget('transactions_data');
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        // Clear cache on update
        Cache::forget('transactions_data');

    }

    /**
     * Handle the Transaction "deleted" event.
     */
    public function deleted(Transaction $transaction): void
    {
        // Clear cache on delete
        Cache::forget('transactions_data');
    }

    /**
     * Handle the Transaction "restored" event.
     */
    public function restored(Transaction $transaction): void
    {
        // Optionally, clear cache or handle restored event
        Cache::forget('transactions_data');
    }

    /**
     * Handle the Transaction "force deleted" event.
     */
    public function forceDeleted(Transaction $transaction): void
    {
        // Clear cache on force delete
        Cache::forget('transactions_data');
    }

    public function updating(Transaction $transaction)
    {
    }
}
