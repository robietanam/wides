<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_code',
        'tour_package_id',
        'transaction_id',
        'visitor_name',
        'visit_date',
        'status',
    ];

    // Definisikan relasi dengan PackageTour
    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class);
    }

    // Definisikan relasi dengan Transaction
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'transaction_code'); // Updated for clarity
    }

    public function generateTicketCode($transactionCode, $packageCode): string
    {
        if (empty($transactionCode) || empty($packageCode)) {
            throw new \Exception('Transaction code and package code are required.');
        }

        do {
            $uniqueCode = mt_rand(1000, 9999);

            // Format akhir kode tiket: TRANSACTIONCODE-PACKAGECODE-UNIQUE
            $ticketCode = sprintf('%s-%s-%04d', $transactionCode, $packageCode, $uniqueCode);
            $exists = DB::table('tickets')->where('ticket_code', $ticketCode)->exists();
        } while ($exists);

        return $ticketCode;
    }
}
