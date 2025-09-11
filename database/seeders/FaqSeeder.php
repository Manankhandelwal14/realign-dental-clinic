<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'Why Realign Dental Clinic is the Best Dental Hospital in India?',
                'answer' => 'Realign Dental Clinic stands out as India’s premier dental destination, blending advanced dental solutions with compassionate, patient-centered care. Led by our esteemed team of dental experts, we leverage state-of-the-art technology to deliver personalized treatments tailored to every patient’s unique needs. From routine dental care to intricate surgical procedures, Realign offers a comprehensive suite of services under one roof. Our unwavering commitment to exceptional hygiene, patient safety, and innovative dental practices sets us apart. Designed to create a calming and welcoming environment, Realign Dental Clinic ensures a stress-free experience, making us the trusted choice for transformative dental care in India.',
                'featured' => true,
            ],
            [
                'question' => 'How to Book an Appointment at Realign Dental Clinic?',
                'answer' => 'Scheduling an appointment at Realign Dental Clinic is quick and convenient. Reach out to us by phone, email, or use our user-friendly online booking system available on our website to secure your visit with ease.',
                'featured' => true,
            ],
            [
                'question' => 'What Kind of After-Care Support Does Realign Dental Clinic Offer?',
                'answer' => 'At Realign Dental Clinic, your comfort and recovery are our top priorities. We provide comprehensive post-treatment guidance and are always available to answer any questions or address concerns following your procedure.',
                'featured' => true,
            ]
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
