<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'thumbnail',
        'short_descriptions', // JSON column
        'detailed_description',
    ];

    protected $casts = [
        'short_descriptions' => 'json', // Cast to JSON
    ];

    public function generateQrCode()
    {
        $url = url("/fauna/{$this->slug}");
        return QrCode::size(250)->generate($url);
    }
}
