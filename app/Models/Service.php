<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasUuids, SoftDeletes, HasMedia;

    protected $fillable = [
        'name',
        'tagline',
        'price',
        'category_id',
        'sort_description',
        'slug',
        'status',
        'branch_id',
        'featured',
        'order',
    ];

    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean',
        'order' => 'integer',
    ];

    protected $appends = ['banner'];

    public function getBannerAttribute(): ?string
    {
        return $this->getFirstMediaUrl('banners') ?: null;
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Order by order column
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
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
                ->orWhere('tagline', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%' . $search . '%');
        });
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($service) {
            $service->slug = Str::slug($service->name);
        });
    }

    public function meta(): MorphOne
    {
        return $this->morphOne(SeoMetadata::class, 'seoable', 'seoable_type', 'seoable_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
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
