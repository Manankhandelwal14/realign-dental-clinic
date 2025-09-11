<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = ['question', 'answer', 'status', 'featured'];

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }

    // search scope
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
            $query->where('question', 'like', '%' . $search . '%')
                ->orWhere('answer', 'like', '%' . $search . '%');
        });
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    // active
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}
