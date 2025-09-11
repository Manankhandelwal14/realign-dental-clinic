<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasUuids;

    protected $fillable = [
        'model_type',
        'model_id',
        'collection_name',
        'name',
        'file_name',
        'mime_type',
        'disk',
        'size',
        'order_column',
        'external_url',
        'file_hash',
    ];

    // append the url attribute
    protected $appends = ['url'];

    public function getUrlAttribute(): string
    {
        return $this->getUrl();
    }

    public function model()
    {
        return $this->morphTo();
    }

    public function getUrl(): string
    {
        if ($this->external_url) {
            return $this->external_url;
        }
        return Storage::disk($this->disk)->url($this->getPath());
    }

    public function getPath(): string
    {
        if ($this->external_url) {
            return '';
        }
        $modelName = strtolower(class_basename($this->model_type));
        return "{$modelName}/{$this->model_id}/{$this->collection_name}/{$this->file_name}";
    }
}
