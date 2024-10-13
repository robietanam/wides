<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'phone_number',
        'contact_person',
        'contact_person_transaction',
        'email',
        'facebook',
        'instagram',
        'landing_image',
        'video_profile',
        'gallery',
        'profile_title',
        'profile_desc',
    ];

    protected $casts = [
        'gallery' => 'array', 
    ];
 
}
