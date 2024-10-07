<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'payment_name';
    public $incrementing = false;
    protected $fillable = ['type', 'payment_name', 'account_holder', 'account_number', 'isActivated'];

    /**
     * Scope a query to only include active payment methods.
     */
    public function scopeActive($query)
    {
        return $query->where('isActivated', true);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'payment_name', 'payment_name'); // Foreign key and local key
    }
}
