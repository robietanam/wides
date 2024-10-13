<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Homepage\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Homepage\IndexController;
use App\Http\Controllers\Homepage\OrderController;
use App\Http\Controllers\UserTicket\MyticketController;

// Route for Homepage
Route::get('/', [IndexController::class, 'index'])->name('home');

// Routes for Orders, with middleware applied to the group
Route::prefix('order')->name('order.')->group(function () {
    Route::get('/{name}', [OrderController::class, 'index'])->name('show');
    Route::post('/', [OrderController::class, 'store'])->name('store');
});

Route::prefix('transaksi')->name('transaction.')->group(function () {
    Route::get('/{name}', [TransactionController::class, 'index'])->name('show');
    Route::get('/', [TransactionController::class, 'search'])->name('search');
});
Route::prefix('artikel')->name('article.')->group(function () {
    Route::get('/qr-code/{id}', [ArticleController::class, 'downloadQrCode'])->name('qr-code');
    Route::get('/id/{id}', [ArticleController::class, 'showId'])->name('show-id');
    Route::get('/', [ArticleController::class, 'index'])->name('index');
});


// Routes for User Tickets
Route::middleware(['auth', 'verified'])->prefix('my-ticket')->name('myticket.')->group(function () {
    Route::get('/', [MyticketController::class, 'index'])->name('show');
    Route::get('/data', [MyticketController::class, 'getTicketUser'])->name('data');
});

// Routes for User Profile
Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});

// Auth routes
require __DIR__ . '/auth.php';
