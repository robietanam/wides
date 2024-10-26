<?php

namespace App\Http\Controllers\Homepage;

use Carbon\Carbon;
use App\Models\TourPackage;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\SiteInfo;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
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

    public function index(string $name)
    {
        $transaction = Transaction::where('transaction_code', $name)->first();

        if (!$transaction) {
            abort(411, 'Transaksi Tidak Ditemukan');
        }

        $tourPackage = TourPackage::where('id', $transaction->package_id)->first();

        $payment = PaymentMethod::where('payment_name', $transaction->payment_method)
                                    ->where('isActivated', true)
                                    ->first(); 

        $contact = SiteInfo::select('contact_person_transaction')->first();

        $statusInfo = $this->getStatusMessage($transaction->status);
        return view('pages.transaction', [
            'transaction' => $transaction,
            'tourPackage' => $tourPackage,
            'payment'=> $payment,
            'statusInfo' => $statusInfo,
            'contact' => $contact->contact_person_transaction
        ]);
    }
    
    public function search(Request $request)
    {
        if ($request->filled('noTelp'))
        {
            $defaultPageSize = 10; 
            $pageSize = $request->input('pageSize', $defaultPageSize);
            $_transaction = Transaction::where('noTelp', $request->noTelp)->paginate($pageSize);
            if ($_transaction->isEmpty()) {
                return view('pages.transaction-search')->with('error', 'No transactions found for the provided phone number.');
            }

            Carbon::setLocale('id');
            $transaction = $_transaction->map(function ($__transaction) {
                $__transaction->statusInfo = $this->getStatusMessage($__transaction->status);
                $__transaction->visit_date = Carbon::parse($__transaction->visit_date)->translatedFormat('d F Y');
                $__transaction->transaction_date = Carbon::parse($__transaction->transaction_date)
                ->translatedFormat('H:i, d F Y ');
                return $__transaction;
            });
        }else {
            $transaction = collect([]); 
        }
        
        return view('pages.transaction-search', compact('transaction', ));
    }
    

}
