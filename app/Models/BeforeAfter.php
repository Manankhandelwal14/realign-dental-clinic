<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;


class BeforeAfter extends Model
{
    use HasUuids, SoftDeletes, HasMedia;

    protected $fillable = ['title', 'description', 'status', 'featured'];

    protected $appends = ['before_image', 'after_image'];

    public function getBeforeImageAttribute(): ?string
    {
        return $this->getFirstMediaUrl('before_image') ?: null;
    }

    public function getAfterImageAttribute(): ?string
    {
        return $this->getFirstMediaUrl('after_image') ?: null;
    }

    // search scope
    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', "%$search%")
            ->orWhere('description', 'like', "%$search%");
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
            default:
                return $query;
        }
    }

    // active scope

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    public function seo(): MorphOne
    {
        return $this->morphOne(SeoMetadata::class, 'seoable', 'seoable_type', 'seoable_id');
    }

    public function content()
    {
        return $this->morphOne(Content::class, 'contentable');
    }
}
