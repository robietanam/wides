<?php

namespace App\Models;

use App\Casts\MoneyCast;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourPackage extends Model
{
    use HasFactory;

    protected $table = 'tour_packages';

    protected $fillable = [
        'name',
        'price',
        'description',
        'is_visible',
        'image_icon',
        'discount',
        'tour_package_code'
    ];

    protected $casts = [
        'price' => MoneyCast::class,
    ];

    public function getImageUrlAttribute()
    {
        return $this->image_icon ? Storage::disk('public')->url($this->image_icon) : null;
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'package_name', 'name'); 
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    public function generateTourPackageCode(): string
    {
        do {
            $randomCode = strtoupper(Str::random(4));
            $exists = DB::table('tour_packages')->where('tour_package_code', $randomCode)->exists();
        } while ($exists);
        return $randomCode;
    }
}
