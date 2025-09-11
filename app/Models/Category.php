<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Category extends Model
{

    use HasUuids, SoftDeletes, HasMedia;

    protected $fillable = ['name', 'slug', 'banner', 'description', 'sort_description', 'status', 'featured', 'order', 'parent_id', 'branch_id'];


    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean',
    ];

    protected $appends = ['banner'];

    public function getBannerAttribute(): ?string
    {
        return $this->getFirstMediaUrl('banner') ?: null;
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
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
                ->orWhere('description', 'like', '%' . $search . '%');
        });
    }


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function meta(): MorphOne
    {
        return $this->morphOne(SeoMetadata::class, 'seoable', 'seoable_type', 'seoable_id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
