<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reel extends Model
{
    use HasUuids, HasMedia, SoftDeletes;

    protected $fillable = [
        'title',
        'caption',
        'status',
        'featured',
        'order',
        'service_id',
        'user_id',
    ];

    protected $appends = ['poster', 'video'];

    public function getPosterAttribute(): ?string
    {
        return $this->getFirstMediaUrl('poster') ?: null;
    }

    public function getVideoAttribute(): ?string
    {
        return $this->getFirstMediaUrl('video') ?: null;
    }


    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    // ordered
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    // active scope
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }


    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMetadata::class, 'seoable', 'seoable_type', 'seoable_id');
    }
}
