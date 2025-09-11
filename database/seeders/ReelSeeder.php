<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Reel;
use Illuminate\Http\UploadedFile;

class ReelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reels = [
            [
                'title' => 'Smile Transformation Journey',
                'caption' => 'Witness the magic of a perfect smile with Realign Dental!',
                'status' => true,
                'featured' => true,
                'date' => '2025-05-01',
                'video' => 'video.mp4',
                'poster' => 'poster.jpg',
                'folder' => 'reel1',
            ],
            [
                'title' => 'Invisible Aligners Explained',
                'caption' => 'Get the smile you deserve with our painless aligners!',
                'status' => true,
                'featured' => true,
                'date' => '2025-05-02',
                'video' => 'video.mp4',
                'poster' => 'poster.jpg',
                'folder' => 'reel2',
            ],
            [
                'title' => 'Painless Dentistry Secrets',
                'caption' => 'Discover how we make dentistry comfortable and fun!',
                'status' => true,
                'featured' => true,
                'date' => '2025-05-03',
                'video' => 'video.mp4',
                'poster' => 'poster.jpg',
                'folder' => 'reel3',
            ],
            [
                'title' => 'Cosmetic Dentistry Magic',
                'caption' => 'Transform your smile with our advanced cosmetic techniques.',
                'status' => true,
                'featured' => true,
                'date' => '2025-05-04',
                'video' => 'video.mp4',
                'poster' => 'poster.jpg',
                'folder' => 'reel4',
            ],
            [
                'title' => 'Smile Design Tech',
                'caption' => 'See how digital smile designing creates flawless results!',
                'status' => true,
                'featured' => true,
                'date' => '2025-05-05',
                'video' => 'video.mp4',
                'poster' => 'poster.jpg',
                'folder' => 'reel5',
            ],
            [
                'title' => 'Realign Dental Experience',
                'caption' => 'A glimpse into our world of precision and care.',
                'status' => true,
                'featured' => true,
                'date' => '2025-05-06',
                'video' => 'video.mp4',
                'poster' => 'poster.jpg',
                'folder' => 'reel6',
            ],
        ];

        foreach ($reels as $reelData) {
            $videoPublicPath = public_path('reels/' . $reelData['folder'] . '/' . $reelData['video']);
            $posterPublicPath = public_path('reels/' . $reelData['folder'] . '/' . $reelData['poster']);

            if (File::exists($videoPublicPath) && File::exists($posterPublicPath)) {
                $reel = Reel::create([
                    'title' => $reelData['title'],
                    'caption' => $reelData['caption'],
                    'status' => $reelData['status'],
                    'featured' => $reelData['featured'],
                    'date' => $reelData['date'],
                ]);

                // Create UploadedFile instances
                $videoFile = new UploadedFile(
                    $videoPublicPath,
                    $reelData['video'],
                    File::mimeType($videoPublicPath),
                    null,
                    true // Set to true to bypass upload validation
                );

                $posterFile = new UploadedFile(
                    $posterPublicPath,
                    $reelData['poster'],
                    File::mimeType($posterPublicPath),
                    null,
                    true // Set to true to bypass upload validation
                );

                // Add media using UploadedFile instances
                $reel->addMedia($videoFile, 'video', 'public');
                $reel->addMedia($posterFile, 'poster', 'public');
            }
        }
    }
}
