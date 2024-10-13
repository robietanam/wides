<?php

namespace App\Http\Controllers\UserTicket;

use App\Models\TourPackage;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class MyticketController extends Controller
{
    function getStatusMessage($status) {
        $statusMessages = [
            'pending'    => ['message' => 'Menunggu Pembayaran', 'class' => 'status-pending'],
            'processing' => ['message' => 'Sedang Diproses', 'class' => 'status-processing'],
            'invoice'    => ['message' => 'Invoice Dibuat', 'class' => 'status-invoice'],
            'completed'  => ['message' => 'Transaksi Selesai', 'class' => 'status-completed'],
            'rejected'   => ['message' => 'Transaksi Ditolak', 'class' => 'status-rejected'],
            'refunded'   => ['message' => 'Transaksi Direfund', 'class' => 'status-refunded'],
        ];

        return $statusMessages[$status] ?? ['message' => 'Status tidak diketahui', 'class' => 'text-black'];
    }
    public function index(Request $request)
    {

        $filter = $request->query('filter');

        $query = Transaction::where('user_id', auth()->id());
    
        if ($filter && $filter !== 'semua') {
            $query->where('status', $filter);
        }
    
        $ticketUser = $query->paginate(10);
    
        
        Carbon::setLocale('id');

        $transaction = $ticketUser->map(function ($__transaction) {
            $__transaction->statusInfo = $this->getStatusMessage($__transaction->status);
            $__transaction->visit_date = Carbon::parse($__transaction->visit_date)->translatedFormat('d F Y');
            $__transaction->transaction_date = Carbon::parse($__transaction->transaction_date)
            ->translatedFormat('H:i, d F Y ');
            return $__transaction;
        });
        return view('pages.my-ticket', ['transaction' => $transaction,]);
    }

    public function getTicketUser()
    {
        $ticketUser = Transaction::where('user_id', auth()->id())
            ->select('transaction_code', 'status', 'payment_method', 'discount', 'visit_date')
            ->get();

        return response()->json([
            'ticketUser' => $ticketUser
        ]);
    }
}
