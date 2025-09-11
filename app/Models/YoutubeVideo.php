<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class YoutubeVideo extends Model
{
    use HasUuids, HasMedia, SoftDeletes;

    protected $fillable = [
        'id',
        'title',
        'description',
        'video_id',
        'published_at',
        'status',
        'featured',
        'service_id',
        'brand_id',
        'order',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'status' => 'boolean',
        'featured' => 'boolean',
    ];

    protected $appends = ['thumbnail'];

    public function getThumbnailAttribute(): ?string
    {
        return $this->getFirstMediaUrl('thumbnail') ?: null;
    }

    // ordered
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    // active
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // featured
    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }
}
