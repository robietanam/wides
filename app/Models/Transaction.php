<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Observers\TransactionObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'transaction_code'; // Custom primary key
    public $incrementing = false; // Disable auto-incrementing
    protected $keyType = 'string'; // Primary key is string type

    protected $fillable = [
        'transaction_code',
        'name',
        'email',
        'noTelp',
        'payment_method', // This will store the payment method name for this transaction
        'visit_date',
        'status',
        'discount',
        'price',
        'quantity',
        'package_name', // This will store the package name for this transaction
        'transaction_date'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method', 'payment_name'); // Foreign key and local key
    }

    public function tourPackage()
    {
        return $this->belongsTo(TourPackage::class, 'package_name', 'name'); // Foreign key and local key
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include completed transactions.
     */
    public function scopeCompleted(Builder $query): Builder
    {
        return $query->where('status', 'complete');
    }

    /**
     * Calculate the total amount of all transaction details.
     */
    public function getTotalAmountAttribute(): float
    {
        $total = $this->price * $this->quantity;
    
        $discountAmount = ($this->discount / 100) * $total;
    
        return $total - $discountAmount;
    }

    /**
     * Check if the transaction is refundable.
     */
    public function getIsRefundableAttribute(): bool
    {
        $refundableStatuses = ['complete', 'shipped'];
        return in_array($this->status, $refundableStatuses);
    }

    /**
     * Get the formatted transaction date.
     */
    public function getFormattedTransactionDateAttribute(): string
    {
        return $this->transaction_date->format('d-m-Y H:i:s');
    }

    /**
     * Configuration state booting.
     */
    public static function boot()
    {
        parent::boot();

        Transaction::observe(TransactionObserver::class);
    }

    /**
     * Create transaction code for customer
     */

     public function generateTransactionCode(bool $isAdmin = false): string
     {
         // Determine the prefix based on the isAdmin boolean
         $rolePrefix = $isAdmin ? 'AM' : 'VS'; // 'AM' for admin, 'VS' for visitor
     
         do {
             $randomCode = strtoupper(Str::random(14)); // Generate a random 14-character string
             $transactionCode = sprintf('%s%s', $rolePrefix, $randomCode); // Combine prefix and random code
             // Check if the generated transaction code already exists
             $exists = DB::table('transactions')->where('transaction_code', $transactionCode)->exists();
         } while ($exists); // Loop until a unique code is generated
     
         return $transactionCode; // Return the unique transaction code
     }

    /**
     * This label will be use in resources filament transaction
     */
    public function getPaymentMethodLabelAttribute()
    {
        $options = [
            'cash' => 'Cash',
            'credit_card' => 'Kartu Kredit',
            'bank_transfer' => 'Transfer Bank',
            'e-wallet' => 'E-Walet',
        ];

        return $options[$this->payment_method] ?? $this->payment_method;
    }
}
