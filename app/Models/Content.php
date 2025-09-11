<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasUuids;

    protected $casts = [
        'content' => 'array',
    ];

    protected $fillable = [
        'contentable_id',
        'contentable_type',
        'html',
        'content',
    ];


    public function contentable()
    {
        return $this->morphTo();
    }
}
