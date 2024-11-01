<?php

namespace App\Http\Controllers\Homepage;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Ticket;
use App\Models\TourPackage;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\PaymentMethod;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(string $name)
    {
        $tourPackage = TourPackage::where('name', $name)->firstOrFail();
        $payment = PaymentMethod::where('isActivated', true)->get()->groupBy('type');
        $user = Auth::user();
        $images = Image::where('tour_package_id', $tourPackage->id)->get();
        $videos = Video::where('tour_package_id', $tourPackage->id)->get();

        $videosWithYoutubeIds = $videos->map(function ($video) {
            $video->youtube_id = null;

            if (strpos($video->video_url, 'youtube.com/watch?v=') !== false) {
                $parsedUrl = parse_url($video->video_url);
                parse_str($parsedUrl['query'], $queryParams);
                $videoId = $queryParams['v'];
                if (isset($videoId)) {
                    $video->youtube_id = $videoId;
                }
            } 

            elseif (strpos($video->video_url, 'youtube.com/shorts/') !== false) {
                $parsedUrl = parse_url($video->video_url);

                $pathSegments = explode('/', $parsedUrl['path']);
                $videoId = end($pathSegments);
                if (isset($videoId)) {
                    $video->youtube_id = $videoId;
                }
            }  
            elseif (strpos($video->video_url, 'youtu.be') !== false) {
                $parsedUrl = parse_url($video->video_url);

                $pathSegments = explode('/', $parsedUrl['path']);
                $videoId = end($pathSegments);
                if (isset($videoId)) {
                    $video->youtube_id = $videoId;
                }
            }
        
        
            return $video; // Return the modified video object
        });
        return view('pages.order', [
            'price' => $tourPackage->price,
            'tourPackage' => $tourPackage,
            'payment'=> $payment,
            'user' => $user ,
            'images'=> $images,
            'videos' => $videosWithYoutubeIds
        ]);
    }

    public function store(Request $request)
    {
        // Validasi awal dengan tambahan validasi tiket maksimal dan metode pembayaran
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'noTelp' => 'required|string',
            'package_id' => 'required',
            'ticket_quantity' => 'required|integer|min:1|max:30',
            'payment' => 'required|string',
            'visit_date' => 'required|date',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa teks.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'noTelp.required' => 'Nomor telepon harus diisi.',
            'noTelp.string' => 'Nomor telepon harus berupa teks.',
            'package_id.required' => ' paket harus diisi.',
            'ticket_quantity.required' => 'Jumlah tiket harus diisi.',
            'ticket_quantity.integer' => 'Jumlah tiket harus berupa angka.',
            'ticket_quantity.min' => 'Jumlah tiket minimal adalah 1.',
            'ticket_quantity.max' => 'Jumlah tiket maksimal adalah 30.',
            'payment.required' => 'Metode pembayaran harus diisi.',
            'payment.string' => 'Metode pembayaran harus berupa teks.',
            'visit_date.required' => 'Tanggal kunjungan harus diisi.',
            'visit_date.date' => 'Tanggal kunjungan tidak valid.',
        ]);
        try {
            $tourPackage = TourPackage::where('id', $validatedData['package_id'])->firstOrFail();
            $validatedData['visit_date'] = Carbon::parse($validatedData['visit_date'])->toDateString();
 
            $transaction = Transaction::create([
                'transaction_code' => (new Transaction())->generateTransactionCode(true), 
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'noTelp' => $validatedData['noTelp'],
                'payment_method' => $validatedData['payment'],
                'visit_date' => $validatedData['visit_date'],
                'status' => 'pending', 
                'discount' => $tourPackage->discount, 
                'quantity' => $validatedData['ticket_quantity'],
                'price' => $tourPackage->price,
                'package_id' => $validatedData['package_id'],
                
            ]);

            if (auth()->check()) {
                $transaction->user_id = auth()->id(); 
                $transaction->save(); 
            }
        
            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil dibuat.',
                'data' => $transaction,
            ], 201);

                // Periksa jika jumlah tiket yang diminta melebihi ketersediaan (disimpan dalam komentar)
                    /*
                    if ($tourPackage->available_tickets < $validatedData['ticket_quantity']) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Jumlah tiket yang diminta melebihi stok yang tersedia.',
                        ], 400);
                    }
                    */
                // TransactionDetail::create([
                //     'transaction_id' => $transaction->id,
                //     'tour_package_id' => $tourPackage->id,
                //     'name' => $tourPackage->name,
                //     'price' => $tourPackage->price,
                //     'quantity' => $validatedData['ticket_quantity'],
                // ]);

                // Create Ticket detail
                // for ($i = 0; $i < $validatedData['ticket_quantity']; $i++) {
                //     Ticket::create([
                //         'ticket_code' => (new Ticket())->generateTicketCode($transaction->transaction_code, $tourPackage->tour_package_code),
                //         'tour_package_id' => $tourPackage->id,
                //         'transaction_id' => $transaction->id,
                //         'visitor_name' => $transaction->customer_name,
                //         'visit_date' => $validatedData['visit_date'],
                //     ]);
                // }

                // $tourPackage->decrement('available_tickets', $validatedData['ticket_quantity']);
           
        } catch (\Exception $e) {
            Log::error('Error pada saat menyimpan transaksi: ' . $e->getMessage(), [
                'exception' => $e,
                'data' => $validatedData,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan, silakan coba lagi.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
