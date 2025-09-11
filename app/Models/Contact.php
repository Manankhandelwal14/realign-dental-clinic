<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasUuids;
    
    protected $fillable = [
        'website',
        'phone',
        'email',
        'whatsapp',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'youtube',
        'street',
        'city',
        'state',
        'zip',
        'country',
        'google_map_iframe',
        'opening_hours',
    ];

    protected $casts = [
        'opening_hours' => 'array',
    ];
}
