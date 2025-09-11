<?php

namespace App\Traits;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HasMedia
{
    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function addMedia(UploadedFile $file, string $collection = 'default', ?string $disk = null): Media
    {
        $disk = $disk ?: config('media.default_disk', 'public');

        $fileHash = hash_file('sha256', $file->getRealPath());

        $existingMedia = Media::where([
            'model_type' => get_class($this),
            'model_id' => $this->id,
            'collection_name' => $collection,
            'file_hash' => $fileHash,
        ])->first();

        if ($existingMedia) {
            return $existingMedia;
        }

        $path = $this->getMediaPath($collection);
        $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();

        Storage::disk($disk)->putFileAs($path, $file, $fileName);

        return Media::create([
            'model_type' => get_class($this),
            'model_id' => $this->id,
            'collection_name' => $collection,
            'name' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
            'file_name' => $fileName,
            'mime_type' => $file->getMimeType(),
            'disk' => $disk,
            'file_hash' => $fileHash,
            'size' => $file->getSize(),
            'order_column' => $this->media()->max('order_column') + 1,
        ]);
    }

    public function addMediaFromUrl(string $url, string $collection = 'default', ?string $disk = null): Media
    {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new \InvalidArgumentException('Invalid URL provided.');
        }

        $disk = $disk ?: config('media.default_disk', 'public');

        // Guess mime type and name from URL
        $name = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_FILENAME);
        $mimeType = $this->guessMimeTypeFromUrl($url);

        return Media::create([
            'model_type' => get_class($this),
            'model_id' => $this->id,
            'collection_name' => $collection,
            'name' => $name ?: 'external_media',
            'file_name' => pathinfo($url, PATHINFO_BASENAME),
            'external_url' => $url,
            'mime_type' => $mimeType,
            'disk' => $disk,
            'size' => 0,
            'file_hash' => hash('sha256', $url),
            'order_column' => $this->media()->max('order_column') + 1,
        ]);
    }

    public function getMedia(string $collection = 'default')
    {
        return $this->media()->where('collection_name', $collection)->orderBy('order_column')->get();
    }

    public function getFirstMediaUrl(string $collection = 'default'): string
    {
        $media = $this->media()->where('collection_name', $collection)->orderBy('order_column')->first();
        return $media ? $media->getUrl() : '';
    }

    public function deleteMedia(string $collection = 'default'): void
    {
        $mediaItems = $this->getMedia($collection);
        foreach ($mediaItems as $media) {
            if (!$media->external_url && $media->disk && $media->file_name) {
                Storage::disk($media->disk)->delete($media->getPath());
            }
            $media->delete();
        }
    }

    protected function getMediaPath(string $collection): string
    {
        $modelName = strtolower(class_basename(get_class($this)));
        return "{$modelName}/{$this->id}/{$collection}";
    }

    protected function guessMimeTypeFromUrl(string $url): ?string
    {
        $extension = strtolower(pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));
        return match ($extension) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'pdf' => 'application/pdf',
            'mp4' => 'video/mp4',
            default => null,
        };
    }

    // hasMedia trait methods
    public function hasMedia(string $collection = 'default'): bool
    {
        return $this->media()->where('collection_name', $collection)->exists();
    }
}
