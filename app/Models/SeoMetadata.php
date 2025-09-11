<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SeoMetadata extends Model
{
    use HasUuids;
    protected $fillable = ['title', 'description', 'keywords', 'canonical_url', 'tags', 'structured_data'];

    protected $casts = [
        'tags' => 'array',
        'structured_data' => 'array',
        'keywords' => 'array',
    ];

    public function seoable(): MorphTo
    {
        return $this->morphTo();
    }
}
