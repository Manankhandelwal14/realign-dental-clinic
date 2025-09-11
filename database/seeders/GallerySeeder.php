<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 11; $i++) {
            $gallery = Gallery::create([
                'title' => 'Image - ' . $i,
                'caption' => 'caption of Image ' . $i,
                'status' => true
            ]);

            $publicPath = public_path("images/gallery/$i.webp");
            $originalName = $member['image'] ?? basename($publicPath);
            $galleryImage = new UploadedFile(
                    $publicPath,
                    $originalName,
                    File::mimeType($publicPath),
                    null,
                    true // Set to true to bypass upload validation
                );
            $gallery->addMedia($galleryImage, 'image', 'public');
        }
    }
}
