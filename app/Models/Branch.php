<?php

namespace App\Models;

use App\Traits\HasMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class Branch extends Model
{
    use HasFactory, SoftDeletes, HasUuids, HasMedia;
    protected $fillable = [
        'id',
        'name',
        'slug',
        'tagline',
        'address',
        'district',
        'city',
        'state',
        'location',
        'status',
        'featured',
        'order',
        'opening_hours',
        'phone',
        'email',
        'website'
    ];


    protected $casts = [
        'opening_hours' => 'array',
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

    // active
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // ordered
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    // scoope search
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%')
                ->orWhere('tagline', 'like', '%' . $search . '%')
                ->orWhere('address', 'like', '%' . $search . '%')
                ->orWhere('district', 'like', '%' . $search . '%')
                ->orWhere('city', 'like', '%' . $search . '%')
                ->orWhere('state', 'like', '%' . $search . '%');
        });
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
            case 'deleted':
                return $query->onlyTrashed();
            default:
                return $query;
        }
    }


    // when create then auto add slug
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($branch) {
            $branch->slug = Str::slug($branch->name);
        });
    }

    public array $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    public function meta(): MorphOne
    {
        return $this->morphOne(SeoMetadata::class, 'seoable', 'seoable_type', 'seoable_id');
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    // services
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function content()
    {
        return $this->morphOne(Content::class, 'contentable');
    }


    // clear cache
    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('branches_by_state');
        });
        static::deleted(function () {
            Cache::forget('branches_by_state');
        });
    }
}
