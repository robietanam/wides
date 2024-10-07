<?php

namespace App\Http\Controllers\UserTicket;

use App\Models\TourPackage;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MyticketController extends Controller
{
    public function index()
    {
        return view('pages.my-ticket');
    }

    public function getTicketUser()
    {
        $ticketUser = Transaction::where('user_id', auth()->id())
            ->where('status', 'invoice')
            ->with(['transactionDetails.tourPackage'])
            ->select('id', 'transaction_code', 'status', 'payment_method', 'discount', 'visit_date')
            ->get();

        return response()->json([
            'ticketUser' => $ticketUser
        ]);
    }
}
