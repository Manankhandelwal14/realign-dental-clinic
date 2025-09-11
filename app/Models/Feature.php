<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feature extends Model
{

    use HasUuids, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'featured',
        'status',
        'order',
    ];


    // featured scope

    public function scopeFeatured($query)
    {
        return $query->where('featured', 1);
    }
}
