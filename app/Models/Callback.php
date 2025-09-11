<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Callback extends Model
{

    use HasUuids, SoftDeletes;

    protected $fillable = ['name', 'phone', 'user_agent', 'ip', 'status'];

    // scope to get the latest callback requests

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', "%{$search}%")
            ->orWhere('phone', 'like', "%{$search}%")
            ->orWhere('ip', 'like', "%{$search}%")
            ->orWhere('user_agent', 'like', "%{$search}%");
    }

    public function scopeStatusFilter($query, $status)
    {
        switch ($status) {
            case 'pending':
                return $query->where('status', 'pending');
            case 'completed':
                return $query->where('status', 'completed');
            case 'failed':
                return $query->where('status', 'failed');
            case 'deleted':
                return $query->onlyTrashed();
            case 'all':
                return $query->withTrashed();
            default:
                return $query;
        }
    }
}
