<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            [
                'author' => 'Kushmita Mittal',
                'content' => 'I strongly recommend Dr. Anjali\'s dental place. I find her clinic to be clean & efficient. You"Can expect to get really good and responsive care. At every she makes you feel listened to and comfortable about procedures, calming nerve at every turn. Highly recommend 🤗 At last you wil end up smiling broad😄',
                'rating' => 5,
                'date' => now()->subMonths(2),
                'status' => true,
                'featured' => true,
                'image' => 'https://lh3.googleusercontent.com/a-/ALV-UjU0xm8-c21Oij-IeLp97Ybhk2ybAZoBK9JMAjoFQB1P4xbcdzfS=s128-c0x00000000-cc-rp-mo'
            ],
            [
                'author' => 'Prateek Jain',
                'content' => 'I recently had a smile makeover, and the results are truly life-changing! Dr Arora took the time to explain every step of the process, from teeth whitening to veneers, ensuring I felt comfortable and informed throughout. The transformation is incredible—my teeth are now perfectly aligned, bright, and natural-looking. The entire team was professional, friendly, and focused on giving me the best possible care. If you’re looking for the best dentist for a smile makeover, I highly recommend this clinic. It’s amazing how much a beautiful smile can boost your confidence. Thank you for giving me the smile of my dreams!',
                'rating' => 5,
                'date' => now()->subMonths(4),
                'status' => true,
                'featured' => true,
                'image' => 'https://lh3.googleusercontent.com/a-/ALV-UjUKHJKgzhabTLNs4QEhGwoOZosI85oMwRmrYyb5CFa6kb1EEhXf=s128-c0x00000000-cc-rp-mo-ba2'
            ],
            [
                'author' => 'Pramod Jain',
                'content' => 'I recently visited Realign Dental Clinic for a tooth cavity, and I’m so glad I did! Dr. Anjali was extremely professional and made the entire process smooth and painless. She thoroughly explained the procedure, and her attention to detail was outstanding. The filling was done perfectly, and I felt comfortable throughout. The clinic is clean, modern, and well-equipped, and the staff is friendly and supportive. I highly recommend Realign Dental Clinic to anyone in need of dental care.',
                'rating' => 5,
                'date' => now()->subMonths(4),
                'status' => true,
                'featured' => true,
                'image' => 'https://lh3.googleusercontent.com/a/ACg8ocLAgPWzkcX7IHTpYs5U8hkZxZ9DmJKRtJe0HlO7eI7DGCMWIg=s128-c0x00000000-cc-rp-mo'
            ],
            [
                'author' => 'Manu Seb',
                'content' => 'I was in severe pain over the weekend and was so relieved to find Realign Dental Clinic open. The doctor was incredibly kind, attentive, and treated me with utmost care. I felt instant relief, and the professionalism was outstanding. Truly grateful for their weekend availability and top-notch service!',
                'rating' => 5,
                'date' => now()->subMonths(2),
                'status' => true,
                'featured' => true,
                'image' => 'https://lh3.googleusercontent.com/a-/ALV-UjWvVaYi6rA-nQMtCQhwU2mFuSeMELX-XIWvv7gqrCGJb05i5j4=s128-c0x00000000-cc-rp-mo'
            ],
            [
                'author' => 'Prateek Jain',
                'content' => 'I was in massive pain and couldn’t eat from one side due to an impacted tooth and another tooth with deep decay caused by it. Dr. Anjali at Realign Dental Clinic, the best dentist in Jaipur, performed a painless root canal (RCT) on the decayed tooth and extracted the impacted one. Within 7 days, I was completely relieved of pain. I can now chew comfortably from both sides, and she even saved the useful tooth. Thank you, Realign Dental Clinic, for the amazing care! Highly recommend for anyone looking for effective and painless procedures.',
                'rating' => 5,
                'date' => now()->subMonths(4),
                'status' => true,
                'featured' => true,
                'image' => 'https://lh3.googleusercontent.com/a/ACg8ocJycxXgKiudpo3mrEjqU1Lb9JxO1nNhPU8MPH50_-dHFZ5mSA=s128-c0x00000000-cc-rp-mo'
            ]
        ];

        foreach ($reviews as $review) {
            Review::create([
                'author' => $review['author'],
                'content' => $review['content'],
                'rating' => $review['rating'],
                'date' => $review['date'],
                'status' => $review['status'],
                'featured' => $review['featured'],
                'image' => $review['image']
            ]);
        }
    }
}
