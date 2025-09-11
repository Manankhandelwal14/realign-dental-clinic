<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Support\Facades\Storage;

class Team extends Model
{
    use HasUuids, SoftDeletes, HasMedia;

    protected $fillable = [
        'name',
        'about',
        'sort_description',
        'designation',
        'social_media',
        'status',
        'featured',
        'order',
    ];

    protected $casts = [
        'social_media' => 'array',
    ];

    protected $appends = [
        'image',
    ];

    public function getImageAttribute(): ?string
    {
        return $this->getFirstMediaUrl('image') ?: null;
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeStatusFilter($query, $status)
    {
        switch ($status) {
            case 'active':
                return $query->where('status', true);
            case 'inactive':
                return $query->where('status', false);
            case 'featured':
                return $query->where('featured', true);
            case 'unfeatured':
                return $query->where('featured', false);
            case 'deleted':
                return $query->onlyTrashed();
            case 'all':
                return $query->withTrashed();
            default:
                return $query;
        }
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('about', 'like', '%' . $search . '%')
                ->orWhere('designation', 'like', '%' . $search . '%')
                ->orWhere('sort_description', 'like', '%' . $search . '%');
        });
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($team) {
            $team->slug = Str::slug($team->name);
        });
    }

    public function meta(): MorphOne
    {
        return $this->morphOne(SeoMetadata::class, 'seoable', 'seoable_type', 'seoable_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function content()
    {
        return $this->morphOne(Content::class, 'contentable');
    }
}
