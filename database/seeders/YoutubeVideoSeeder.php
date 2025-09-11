<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\YoutubeVideo;

class YoutubeVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $videos = [
            [
                'title' => 'Discover Dentistry: Your Guide to a Healthy Smile',
                'description' => 'Unlock the secrets of dentistry with this engaging step-by-step guide! Learn how dental care enhances your oral health and empowers your smile. 🦷✨ #Dentistry #OralHealth #SmileDesign',
                'video_id' => 'BGUpL2jy5ps',
                'thumbnail' => 'https://img.youtube.com/vi/BGUpL2jy5ps/hqdefault.jpg',
            ],
            [
                'title' => 'Groom’s One-Day Smile Transformation for the Big Day',
                'description' => 'Witness a groom’s stunning smile transformation in just one day! Perfect for wedding photos, this makeover ensures a flawless smile in every picture. 📸 #SmileMakeover #WeddingSmile #DentalCare',
                'video_id' => '636xbpehHBw',
                'thumbnail' => 'https://img.youtube.com/vi/636xbpehHBw/hqdefault.jpg',
            ],
            [
                'title' => 'Crafting Your Perfect Smile with Expert Dentistry',
                'description' => 'Transform your smile with expert dental care! From braces to teeth alignment, discover how we create stunning smiles that boost confidence. 💖 #Braces #SmileDesign #DentalCare',
                'video_id' => '8v-t4SGgRjo',
                'thumbnail' => 'https://img.youtube.com/vi/8v-t4SGgRjo/hqdefault.jpg',
            ],
            [
                'title' => 'Pain-Free Braces for a Confident Smile',
                'description' => 'Get the smile you’ve always wanted with pain-free braces! Our comfortable orthodontic solutions make your journey to perfect teeth a breeze. 🤩 #PainFreeBraces #Orthodontics #SmileDesign',
                'video_id' => 'aEfvpnFKw_0',
                'thumbnail' => 'https://img.youtube.com/vi/aEfvpnFKw_0/hqdefault.jpg',
            ],
            [
                'title' => 'Protect Your Smile: Say No to Tobacco',
                'description' => 'Tobacco harms your oral health. Learn why saying no to tobacco is key to a healthy, radiant smile. Join us to kick the habit! 🚭 #NoTobacco #DentalHealth #SmileDesign',
                'video_id' => '21wMawD8czE',
                'thumbnail' => 'https://img.youtube.com/vi/21wMawD8czE/hqdefault.jpg',
            ],
            [
                'title' => 'Invisible Aligners for a Flawless Smile',
                'description' => 'Achieve perfectly straight teeth with invisible aligners! Comfortable and discreet, our orthodontic treatments deliver stunning results. 😁 #Invisalign #InvisibleBraces #SmileDesign',
                'video_id' => 'ANHWGjmbH4E',
                'thumbnail' => 'https://img.youtube.com/vi/ANHWGjmbH4E/hqdefault.jpg',
            ],
            [
                'title' => 'Pre-Bridal Smile Makeover for Your Dream Wedding',
                'description' => 'Shine on your wedding day with a pre-bridal smile makeover! From veneers to braces, our cosmetic treatments ensure a radiant smile. 🌟 #BridalMakeover #SmileDesign #CosmeticDentistry',
                'video_id' => 'sf-4vZyO904',
                'thumbnail' => 'https://img.youtube.com/vi/sf-4vZyO904/hqdefault.jpg',
            ],
        ];

        foreach ($videos as $key => $video) {
            $savedVideo = YoutubeVideo::create([
                'title' => $video['title'],
                'description' => $video['description'],
                'video_id' => $video['video_id'],
                'published_at' => now(),
                'status' => true,
                'featured' => true,
                'order' => $key + 1,
            ]);
            $savedVideo->addMediaFromUrl($video['thumbnail'], 'thumbnail');
        }
    }
}
