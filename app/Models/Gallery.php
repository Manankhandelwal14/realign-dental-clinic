<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasMedia;

class Gallery extends Model
{
    use HasUuids, HasMedia;

    protected $fillable = [
        'title',
        'caption',
        'status',
        'featured',
        'order',
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


     public function scopeSearch($query, $search)
    {
        return $query->where(function ($query) use ($search) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('caption', 'like', '%' . $search . '%');
        });
    }

}
