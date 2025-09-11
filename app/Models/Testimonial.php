<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Testimonial extends Model
{
    use HasUuids, HasMedia;

    protected $fillable = [
        'author',
        'caption',
        'path',
        'status',
        'featured',
        'order',
        'service_id',
        'user_id',
        'date'
    ];


    protected $casts = [
        'date' => 'datetime',
    ];

    protected $appends = ['poster', 'video'];

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function getPosterAttribute(): ?string
    {
        return $this->getFirstMediaUrl('poster') ?: null;
    }

    public function getVideoAttribute(): ?string
    {
        return $this->getFirstMediaUrl('video') ?: null;
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
