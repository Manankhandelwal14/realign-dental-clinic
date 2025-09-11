<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $openingHours = [
            [
                'day' => 'Monday',
                'slots' => [
                    ['opening' => '09:00', 'closing' => '14:00'],
                    ['opening' => '16:00', 'closing' => '20:00']
                ]
            ],
            [
                'day' => 'Tuesday',
                'slots' => [
                    ['opening' => '09:00', 'closing' => '14:00'],
                    ['opening' => '16:00', 'closing' => '20:00']
                ]
            ],
            [
                'day' => 'Wednesday',
                'slots' => [
                    ['opening' => '09:00', 'closing' => '14:00'],
                    ['opening' => '16:00', 'closing' => '20:00']
                ]
            ],
            [
                'day' => 'Thursday',
                'slots' => [
                    ['opening' => '09:00', 'closing' => '14:00'],
                    ['opening' => '16:00', 'closing' => '20:00']
                ]
            ],
            [
                'day' => 'Friday',
                'slots' => [
                    ['opening' => '09:00', 'closing' => '14:00'],
                    ['opening' => '16:00', 'closing' => '20:00']
                ]
            ],
            [
                'day' => 'Saturday',
                'slots' => [
                    ['opening' => '09:00', 'closing' => '14:00'],
                    ['opening' => '16:00', 'closing' => '20:00']
                ]
            ],
            [
                'day' => 'Sunday',
                'slots' => [
                    ['opening' => '09:00', 'closing' => '14:00'],
                    ['opening' => '16:00', 'closing' => '20:00']
                ]
            ]
        ];

        $branches = [
            [
                'name' => 'Pediatric Dentist In Jaipur',
                'slug' => 'pediatric-dentist-in-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Tonk Road, Jaipur, Rajasthan 302018',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dentist In Pratap Nagar Jaipur',
                'slug' => 'dentist-in-pratap-nagar-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Pratap Nagar, Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Mansarovar Jaipur',
                'slug' => 'dental-clinic-in-mansarovar-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Mansarovar, Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Jagatpura Jaipur',
                'slug' => 'dental-clinic-in-jagatpura-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jagatpura, Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Vaishali Nagar Jaipur',
                'slug' => 'dental-clinic-in-vaishali-nagar-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Vaishali Nagar, Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Vidhyadhar Nagar Jaipur',
                'slug' => 'dental-clinic-in-vidhyadhar-nagar-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Vidhyadhar Nagar, Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic Malviya Nagar Jaipur',
                'slug' => 'dental-clinic-malviya-nagar-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Malviya Nagar, Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dentist In Chitrakoot Jaipur',
                'slug' => 'dentist-in-chitrakoot-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Chitrakoot, Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Nirman Nagar Jaipur',
                'slug' => 'dental-clinic-in-nirman-nagar-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Nirman Nagar, Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Raja Park Jaipur',
                'slug' => 'dental-clinic-in-raja-park-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Raja Park, Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dentist In C Scheme Jaipur',
                'slug' => 'dentist-in-c-scheme-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'C Scheme, Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Murlipura Jaipur',
                'slug' => 'dental-clinic-in-murlipura-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Murlipura, Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Metal Braces Cost In Jaipur',
                'slug' => 'metal-braces-cost-in-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Best Dental Hospital In Jaipur',
                'slug' => 'best-dental-hospital-in-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaipur, Rajasthan 302021',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Best Dental Implant Clinic In Jaipur',
                'slug' => 'best-dental-implant-clinic-in-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaipur, Rajasthan 302017',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'One Day Teeth Implant In Jaipur',
                'slug' => 'one-day-teeth-implant-in-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaipur, Rajasthan 302001',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Best Smile Designing Treatment In Jaipur',
                'slug' => 'best-smile-designing-treatment-in-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Full Mouth Dental Implants In Jaipur',
                'slug' => 'full-mouth-dental-implants-in-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Cracked Tooth Treatment In Jaipur',
                'slug' => 'cracked-tooth-treatment-in-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Zygomatic Dental Implant In Jaipur',
                'slug' => 'zygomatic-dental-implant-in-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Broken Teeth Treatment In Jaipur',
                'slug' => 'broken-teeth-treatment-in-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Best Dentist In Jaipur',
                'slug' => 'best-dentist-in-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Best Dental Implant Center In Jaipur',
                'slug' => 'best-dental-implant-center-in-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Best Implant Dentist In Jaipur',
                'slug' => 'best-implant-dentist-in-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Teeth Gap Treatment In Jaipur',
                'slug' => 'teeth-gap-treatment-in-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Zirconia Cap Treatment In Jaipur',
                'slug' => 'zirconia-cap-treatment-in-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Best Teeth Implant Hospital In Jaipur',
                'slug' => 'best-teeth-implant-hospital-in-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Smile Makeover In Jaipur',
                'slug' => 'smile-makeover-in-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Immediate Dental Implant In Jaipur',
                'slug' => 'immediate-dental-implant-in-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            // Uttarakhand
            [
                'name' => 'Dental Clinic In Dehradun',
                'slug' => 'dental-clinic-in-dehradun',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Dehradun, Uttarakhand 248001',
                'district' => 'Dehradun',
                'city' => 'Dehradun',
                'state' => 'Uttarakhand',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Haridwar',
                'slug' => 'dental-clinic-in-haridwar',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Haridwar, Uttarakhand 249401',
                'district' => 'Haridwar',
                'city' => 'Haridwar',
                'state' => 'Uttarakhand',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Nainital',
                'slug' => 'dental-clinic-in-nainital',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Nainital, Uttarakhand 263001',
                'district' => 'Nainital',
                'city' => 'Nainital',
                'state' => 'Uttarakhand',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Rishikesh',
                'slug' => 'dental-clinic-in-rishikesh',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Rishikesh, Uttarakhand 249201',
                'district' => 'Dehradun',
                'city' => 'Rishikesh',
                'state' => 'Uttarakhand',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Shimla',
                'slug' => 'dental-clinic-in-shimla',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Shimla, Himachal Pradesh 171001',
                'district' => 'Shimla',
                'city' => 'Shimla',
                'state' => 'Himachal Pradesh',
                'opening_hours' => $openingHours,
            ],
            // Haryana
            [
                'name' => 'Dental Clinic In Faridabad',
                'slug' => 'dental-clinic-in-faridabad',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Faridabad, Haryana 121007',
                'district' => 'Faridabad',
                'city' => 'Faridabad',
                'state' => 'Haryana',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Gurugram',
                'slug' => 'dental-clinic-in-gurugram',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Gurugram, Haryana 122022',
                'district' => 'Gurugram',
                'city' => 'Gurugram',
                'state' => 'Haryana',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Hisar',
                'slug' => 'dental-clinic-in-hisar',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Hisar, Haryana 125001',
                'district' => 'Hisar',
                'city' => 'Hisar',
                'state' => 'Haryana',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Karnal',
                'slug' => 'dental-clinic-in-karnal',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Karnal, Haryana 132001',
                'district' => 'Karnal',
                'city' => 'Karnal',
                'state' => 'Haryana',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Panipat',
                'slug' => 'dental-clinic-in-panipat',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Panipat, Haryana 132103',
                'district' => 'Panipat',
                'city' => 'Panipat',
                'state' => 'Haryana',
                'opening_hours' => $openingHours,
            ],
            // Rajasthan (other cities) 
            [
                'name' => 'Dental Hospital In Rajasthan',
                'slug' => 'dental-hospital-in-rajasthan',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Hospital In Udaipur',
                'slug' => 'dental-hospital-in-udaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Udaipur, Rajasthan',
                'district' => 'Udaipur',
                'city' => 'Udaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Hospital In Jodhpur',
                'slug' => 'dental-hospital-in-jodhpur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jodhpur, Rajasthan',
                'district' => 'Jodhpur',
                'city' => 'Jodhpur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Hospital In Jaipur',
                'slug' => 'dental-hospital-in-jaipur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaipur, Rajasthan',
                'district' => 'Jaipur',
                'city' => 'Jaipur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Hospital In Jaisalmer',
                'slug' => 'dental-hospital-in-jaisalmer',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jaisalmer, Rajasthan',
                'district' => 'Jaisalmer',
                'city' => 'Jaisalmer',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Hospital In Kota',
                'slug' => 'dental-hospital-in-kota',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Kota, Rajasthan',
                'district' => 'Kota',
                'city' => 'Kota',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Hospital In Ajmer',
                'slug' => 'dental-hospital-in-ajmer',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Ajmer, Rajasthan',
                'district' => 'Ajmer',
                'city' => 'Ajmer',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Hospital In Bikaner',
                'slug' => 'dental-hospital-in-bikaner',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Bikaner, Rajasthan',
                'district' => 'Bikaner',
                'city' => 'Bikaner',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Hospital In Alwar',
                'slug' => 'dental-hospital-in-alwar',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Alwar, Rajasthan',
                'district' => 'Alwar',
                'city' => 'Alwar',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Hospital In Bharatpur',
                'slug' => 'dental-hospital-in-bharatpur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Bharatpur, Rajasthan',
                'district' => 'Bharatpur',
                'city' => 'Bharatpur',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Hospital In Sikar',
                'slug' => 'dental-hospital-in-sikar',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Sikar, Rajasthan',
                'district' => 'Sikar',
                'city' => 'Sikar',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Hospital In Pali',
                'slug' => 'dental-hospital-in-pali',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Pali, Rajasthan',
                'district' => 'Pali',
                'city' => 'Pali',
                'state' => 'Rajasthan',
                'opening_hours' => $openingHours,
            ],
            // Uttar Pradesh
            [
                'name' => 'Dental Clinic In Agra',
                'slug' => 'dental-clinic-in-agra',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Agra, Uttar Pradesh',
                'district' => 'Agra',
                'city' => 'Agra',
                'state' => 'Uttar Pradesh',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Ayodhya',
                'slug' => 'dental-clinic-in-ayodhya',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Ayodhya, Uttar Pradesh',
                'district' => 'Ayodhya',
                'city' => 'Ayodhya',
                'state' => 'Uttar Pradesh',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Ghaziabad',
                'slug' => 'dental-clinic-in-ghaziabad',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Ghaziabad, Uttar Pradesh',
                'district' => 'Ghaziabad',
                'city' => 'Ghaziabad',
                'state' => 'Uttar Pradesh',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Kanpur',
                'slug' => 'dental-clinic-in-kanpur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Kanpur, Uttar Pradesh',
                'district' => 'Kanpur',
                'city' => 'Kanpur',
                'state' => 'Uttar Pradesh',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Lucknow',
                'slug' => 'dental-clinic-in-lucknow',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Lucknow, Uttar Pradesh',
                'district' => 'Lucknow',
                'city' => 'Lucknow',
                'state' => 'Uttar Pradesh',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Mathura',
                'slug' => 'dental-clinic-in-mathura',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Mathura, Uttar Pradesh',
                'district' => 'Mathura',
                'city' => 'Mathura',
                'state' => 'Uttar Pradesh',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Meerut',
                'slug' => 'dental-clinic-in-meerut',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Meerut, Uttar Pradesh',
                'district' => 'Meerut',
                'city' => 'Meerut',
                'state' => 'Uttar Pradesh',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Noida',
                'slug' => 'dental-clinic-in-noida',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Noida, Uttar Pradesh',
                'district' => 'Gautam Buddh Nagar',
                'city' => 'Noida',
                'state' => 'Uttar Pradesh',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Prayagraj',
                'slug' => 'dental-clinic-in-prayagraj',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Prayagraj, Uttar Pradesh',
                'district' => 'Prayagraj',
                'city' => 'Prayagraj',
                'state' => 'Uttar Pradesh',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Varanasi',
                'slug' => 'dental-clinic-in-varanasi',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Varanasi, Uttar Pradesh',
                'district' => 'Varanasi',
                'city' => 'Varanasi',
                'state' => 'Uttar Pradesh',
                'opening_hours' => $openingHours,
            ],
            // Madhya Pradesh
            [
                'name' => 'Dental Clinic In Bhopal',
                'slug' => 'dental-clinic-in-bhopal',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Bhopal, Madhya Pradesh',
                'district' => 'Bhopal',
                'city' => 'Bhopal',
                'state' => 'Madhya Pradesh',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Gwalior',
                'slug' => 'dental-clinic-in-gwalior',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Gwalior, Madhya Pradesh',
                'district' => 'Gwalior',
                'city' => 'Gwalior',
                'state' => 'Madhya Pradesh',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Indore',
                'slug' => 'dental-clinic-in-indore',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Indore, Madhya Pradesh',
                'district' => 'Indore',
                'city' => 'Indore',
                'state' => 'Madhya Pradesh',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Jabalpur',
                'slug' => 'dental-clinic-in-jabalpur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jabalpur, Madhya Pradesh',
                'district' => 'Jabalpur',
                'city' => 'Jabalpur',
                'state' => 'Madhya Pradesh',
                'opening_hours' => $openingHours,
            ],
            // West Bengal
            [
                'name' => 'Dental Clinic In Kolkata',
                'slug' => 'dental-clinic-in-kolkata',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Kolkata, West Bengal',
                'district' => 'Kolkata',
                'city' => 'Kolkata',
                'state' => 'West Bengal',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Malda',
                'slug' => 'dental-clinic-in-malda',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Malda, West Bengal',
                'district' => 'Malda',
                'city' => 'Malda',
                'state' => 'West Bengal',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Asansol',
                'slug' => 'dental-clinic-in-asansol',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Asansol, West Bengal',
                'district' => 'Paschim Bardhaman',
                'city' => 'Asansol',
                'state' => 'West Bengal',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Durgapur',
                'slug' => 'dental-clinic-in-durgapur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Durgapur, West Bengal',
                'district' => 'Paschim Bardhaman',
                'city' => 'Durgapur',
                'state' => 'West Bengal',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Mumbai',
                'slug' => 'dental-clinic-in-mumbai',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Mumbai, Maharashtra',
                'district' => 'Mumbai',
                'city' => 'Mumbai',
                'state' => 'Maharashtra',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Nagpur',
                'slug' => 'dental-clinic-in-nagpur',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Nagpur, Maharashtra',
                'district' => 'Nagpur',
                'city' => 'Nagpur',
                'state' => 'Maharashtra',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Nashik',
                'slug' => 'dental-clinic-in-nashik',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Nashik, Maharashtra',
                'district' => 'Nashik',
                'city' => 'Nashik',
                'state' => 'Maharashtra',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Pune',
                'slug' => 'dental-clinic-in-pune',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Pune, Maharashtra',
                'district' => 'Pune',
                'city' => 'Pune',
                'state' => 'Maharashtra',
                'opening_hours' => $openingHours,
            ],
            // India
            [
                'name' => 'Braces Treatment In India',
                'slug' => 'braces-treatment-in-india',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'New Delhi, Delhi',
                'district' => null,
                'city' => null,
                'state' => null,
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Braces Treatment Cost In India',
                'slug' => 'braces-treatment-cost-in-india',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'New Delhi, Delhi',
                'district' => null,
                'city' => null,
                'state' => null,
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Jaw Correction Surgery In India',
                'slug' => 'jaw-correction-surgery-in-india',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'New Delhi, Delhi',
                'district' => null,
                'city' => null,
                'state' => null,
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Best Dental Implant Clinic In India',
                'slug' => 'best-dental-implant-clinic-in-india',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'New Delhi, Delhi',
                'district' => null,
                'city' => null,
                'state' => null,
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'One Day Teeth Implant In India',
                'slug' => 'one-day-teeth-implant-in-india',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'New Delhi, Delhi',
                'district' => null,
                'city' => null,
                'state' => null,
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Best Smile Designing Treatment In India',
                'slug' => 'best-smile-designing-treatment-in-india',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'New Delhi, Delhi',
                'district' => null,
                'city' => null,
                'state' => null,
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Full Mouth Dental Implants In India',
                'slug' => 'full-mouth-dental-implants-in-india',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'New Delhi, Delhi',
                'district' => null,
                'city' => null,
                'state' => null,
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Cracked Tooth Treatment In India',
                'slug' => 'cracked-tooth-treatment-in-india',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'New Delhi, Delhi',
                'district' => null,
                'city' => null,
                'state' => null,
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Zygomatic Dental Implant In India',
                'slug' => 'zygomatic-dental-implant-in-india',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'New Delhi, Delhi',
                'district' => null,
                'city' => null,
                'state' => null,
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Broken Teeth Treatment In India',
                'slug' => 'broken-teeth-treatment-in-india',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'New Delhi, Delhi',
                'district' => null,
                'city' => null,
                'state' => null,
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Best Dentist In India',
                'slug' => 'best-dentist-in-india',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'New Delhi, Delhi',
                'district' => null,
                'city' => null,
                'state' => null,
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Best Dental Implant Center In India',
                'slug' => 'best-dental-implant-center-in-india',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'New Delhi, Delhi',
                'district' => null,
                'city' => null,
                'state' => null,
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Best Implant Dentist In India',
                'slug' => 'best-implant-dentist-in-india',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'New Delhi, Delhi',
                'district' => null,
                'city' => null,
                'state' => null,
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Teeth Gap Treatment In India',
                'slug' => 'teeth-gap-treatment-in-india',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'New Delhi, Delhi',
                'district' => null,
                'city' => null,
                'state' => null,
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Zirconia Cap Treatment In India',
                'slug' => 'zirconia-cap-treatment-in-india',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'New Delhi, Delhi',
                'district' => null,
                'city' => null,
                'state' => null,
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Best Teeth Implant Hospital In India',
                'slug' => 'best-teeth-implant-hospital-in-india',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'New Delhi, Delhi',
                'district' => null,
                'city' => null,
                'state' => null,
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Smile Makeover In India',
                'slug' => 'smile-makeover-in-india',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'New Delhi, Delhi',
                'district' => null,
                'city' => null,
                'state' => null,
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Immediate Dental Implant In India',
                'slug' => 'immediate-dental-implant-in-india',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'New Delhi, Delhi',
                'district' => null,
                'city' => null,
                'state' => null,
                'opening_hours' => $openingHours,
            ],
            // Gujarat
            [
                'name' => 'Dental Clinic In Ahmedabad',
                'slug' => 'dental-clinic-in-ahmedabad',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Ahmedabad, Gujarat',
                'district' => 'Ahmedabad',
                'city' => 'Ahmedabad',
                'state' => 'Gujarat',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Surat',
                'slug' => 'dental-clinic-in-surat',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Surat, Gujarat',
                'district' => 'Surat',
                'city' => 'Surat',
                'state' => 'Gujarat',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Vadodara',
                'slug' => 'dental-clinic-in-vadodara',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Vadodara, Gujarat',
                'district' => 'Vadodara',
                'city' => 'Vadodara',
                'state' => 'Gujarat',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Rajkot',
                'slug' => 'dental-clinic-in-rajkot',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Rajkot, Gujarat',
                'district' => 'Rajkot',
                'city' => 'Rajkot',
                'state' => 'Gujarat',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Gandhinagar',
                'slug' => 'dental-clinic-in-gandhinagar',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Gandhinagar, Gujarat',
                'district' => 'Gandhinagar',
                'city' => 'Gandhinagar',
                'state' => 'Gujarat',
                'opening_hours' => $openingHours,
            ],
            // Punjab
            [
                'name' => 'Dental Clinic In Amritsar',
                'slug' => 'dental-clinic-in-amritsar',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Amritsar, Punjab',
                'district' => 'Amritsar',
                'city' => 'Amritsar',
                'state' => 'Punjab',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Bathinda',
                'slug' => 'dental-clinic-in-bathinda',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Bathinda, Punjab',
                'district' => 'Bathinda',
                'city' => 'Bathinda',
                'state' => 'Punjab',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Jalandhar',
                'slug' => 'dental-clinic-in-jalandhar',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Jalandhar, Punjab',
                'district' => 'Jalandhar',
                'city' => 'Jalandhar',
                'state' => 'Punjab',
                'opening_hours' => $openingHours,
            ],
            [
                'name' => 'Dental Clinic In Patiala',
                'slug' => 'dental-clinic-in-patiala',
                'banner' => null,
                'tagline' => 'Transforming Smiles with Expert Care',
                'address' => 'Patiala, Punjab',
                'district' => 'Patiala',
                'city' => 'Patiala',
                'state' => 'Punjab',
                'opening_hours' => $openingHours,
            ],
        ];

        foreach ($branches as $key => $branch) {
            $branchStore = Branch::create([
                'name' => $branch['name'],
                'tagline' => $branch['tagline'],
                'address' => $branch['address'],
                'district' => $branch['district'],
                'city' => $branch['city'],
                'state' => $branch['state'],
                'map_iframe' => null,
                'opening_hours' => $branch['opening_hours'],
                'status' => true,
                'featured' => 1,
                'order' => $key + 1,
                // contact
                'phone' => '+917891012206',
                'email' => 'contact@realigndental.com',
                'website' => 'https://realigndental.com',
            ]);

            $branchStore->content()->create([
                'html' => '<h1 class="ce-header">Realign Dental Clinic: The Best Dental Care in ' . $branch['city'] . '</h1><p class="cdx-block">Welcome to Realign Dental Clinic, your trusted destination for premium dental care at ' . $branch['address'] . '. Whether you need routine check-ups, orthodontic treatments, or advanced dental procedures, our clinic offers comprehensive care tailored to your needs. Our team of skilled dentists and orthodontists ensures that every patient leaves with a healthy and confident smile.</p><h3 class="ce-header">Why Choose Realign Dental Clinic?</h3><p class="cdx-block">Realign Dental Clinic is dedicated to providing the highest standards of oral care. With a focus on preventive, restorative, and cosmetic dentistry, we aim to meet the unique needs of every patient. Whether you are seeking expert care from an orthodontist for teeth alignment or a general dentist for regular check-ups, we offer the perfect blend of expertise and comfort.</p><p class="cdx-block">Our Key Services</p><p class="cdx-block">1. Dental Check-ups and Preventive Care
Prevention is the first step to good oral health. At Realign Dental Clinic, we offer regular dental check-ups to detect potential issues before they become serious.</p><ul class="cdx-list"><li class="cdx-list__item">Comprehensive oral examinations
</li><li class="cdx-list__item">Teeth cleaning and fluoride treatment
</li><li class="cdx-list__item">Digital X-rays for precise diagnosis
Routine visits to our dental clinic ensure healthy teeth and gums throughout your life.
</li></ul><p class="cdx-block">2. Orthodontic Treatments: Align Your Smile with Confidence
Our experienced orthodontist provides advanced solutions for correcting teeth alignment and bite issues. We offer a variety of orthodontic treatments suitable for all ages.</p><ul class="cdx-list"><li class="cdx-list__item">Braces (metal and ceramic)
</li><li class="cdx-list__item">Invisalign and clear aligners
</li><li class="cdx-list__item">Early intervention for children and teens
Our customized orthodontic care helps improve both function and aesthetics, giving you a perfect smile.
</li></ul><p class="cdx-block">3. Cosmetic Dentistry: Transform Your Smile
Looking for a smile makeover? Realign Dental Clinic offers a range of cosmetic dentistry services to enhance the appearance of your teeth.</p><ul class="cdx-list"><li class="cdx-list__item">Teeth whitening for a brighter smile
</li><li class="cdx-list__item">Veneers to correct chipped or discolored teeth
</li><li class="cdx-list__item">Smile design and contouring
Our expert dentists use advanced tools and techniques to deliver flawless cosmetic results.
</li></ul><p class="cdx-block">4. Restorative Dentistry: Repair and Replace Damaged Teeth
If you have damaged or missing teeth, our dental clinic offers effective restorative solutions to bring back your oral health.</p><ul class="cdx-list"><li class="cdx-list__item">Tooth-colored fillings and crowns
</li><li class="cdx-list__item">Root canal treatments
</li><li class="cdx-list__item">Dental implants and bridges
With a focus on long-lasting results, our restorative services improve both function and appearance.
</li></ul><p class="cdx-block">5. Pediatric Dentistry: Caring for Young Smiles
We understand that children need special care. Our friendly dentists make visits fun and comfortable for kids while focusing on preventive dental care.</p><ul class="cdx-list"><li class="cdx-list__item">Fluoride treatments and sealants
</li><li class="cdx-list__item">Cavity prevention education
</li><li class="cdx-list__item">Orthodontic evaluations for growing children
We aim to make every child’s visit a positive experience to build lifelong healthy dental habits.
</li></ul><p class="cdx-block">6. Emergency Dental Care: Relief When You Need It
Dental emergencies can happen unexpectedly. Our clinic provides prompt care for issues like toothaches, injuries, or broken restorations.</p><ul class="cdx-list"><li class="cdx-list__item">Emergency appointments for immediate relief
</li><li class="cdx-list__item">Treatment of tooth fractures and infections
</li><li class="cdx-list__item">Management of severe pain and swelling
Realign Dental Clinic is always ready to help during your time of need.
</li></ul><p class="cdx-block">Meet Our Expert Team
At Realign Dental Clinic, we take pride in our highly qualified team of dentists and orthodontists. With years of experience and a passion for patient care, we ensure that every treatment is safe, effective, and tailored to your needs. Our friendly staff makes sure that you feel comfortable throughout your visit.</p><p class="cdx-block">Why Regular Dental Visits are Essential</p><ul class="cdx-list"><li class="cdx-list__item">Prevents dental issues from becoming severe
</li><li class="cdx-list__item">Ensures timely treatment for misaligned teeth
</li><li class="cdx-list__item">Maintains optimal oral hygiene
</li><li class="cdx-list__item">Provides professional advice from skilled dentists and orthodontists
With the right care from our dental clinic, you can enjoy a lifetime of healthy smiles!
</li></ul><p class="cdx-block">Conclusion: Healthy Smiles Start at Realign Dental Clinic
At Realign Dental Clinic, we are dedicated to providing exceptional dental care in Mansarovar, Jaipur. From routine check-ups to advanced orthodontic treatments, our expert dentists and orthodontists are here to ensure your oral health is in the best hands. We focus not only on treatment but also on preventive care to help you maintain a healthy, confident smile for life.
Whether you need dental care for your family, orthodontic solutions, or cosmetic dentistry, Realign Dental Clinic offers personalized services in a friendly and comfortable environment. Visit us today and take the first step towards better oral health!</p><p class="cdx-block">Visit Realign Dental Clinic for the Best Dental Care in Jaipur
At Realign Dental Clinic, we are committed to providing comprehensive dental care with a patient-first approach. Whether you need a routine check-up, orthodontic consultation, or cosmetic dental treatment, we’ve got you covered. Trust us to give you the best care for all your dental needs.
Your journey to a healthier smile starts here—schedule your appointment today!</p>',
                'content' => '{
    "time": 1749381109501,
    "blocks": [
        {
            "id": "XPR3WRFIr8",
            "data": {
                "text": "Realign Dental Clinic: The Best Dental Care in Mansarovar, Jaipur",
                "level": 1
            },
            "type": "header"
        },
        {
            "id": "2lNRPGi31k",
            "data": {
                "text": "Welcome to Realign Dental Clinic, your trusted destination for premium dental care at 94/40, Vijay Path, Sector 9, Mansarovar, Jaipur, Rajasthan 302020. Whether you need routine check-ups, orthodontic treatments, or advanced dental procedures, our clinic offers comprehensive care tailored to your needs. Our team of skilled dentists and orthodontists ensures that every patient leaves with a healthy and confident smile."
            },
            "type": "paragraph"
        },
        {
            "id": "DE7UoEWdrP",
            "data": {
                "text": "Why Choose Realign Dental Clinic?",
                "level": 3
            },
            "type": "header"
        },
        {
            "id": "h7kb4zj2V7",
            "data": {
                "text": "Realign Dental Clinic is dedicated to providing the highest standards of oral care. With a focus on preventive, restorative, and cosmetic dentistry, we aim to meet the unique needs of every patient. Whether you are seeking expert care from an orthodontist for teeth alignment or a general dentist for regular check-ups, we offer the perfect blend of expertise and comfort."
            },
            "type": "paragraph"
        },
        {
            "id": "CzEqkek80V",
            "data": {
                "text": "Our Key Services"
            },
            "type": "paragraph"
        },
        {
            "id": "LY4FW8KhwL",
            "data": {
                "text": "1. Dental Check-ups and Preventive Care\nPrevention is the first step to good oral health. At Realign Dental Clinic, we offer regular dental check-ups to detect potential issues before they become serious."
            },
            "type": "paragraph"
        },
        {
            "id": "yGNg-9BdG7",
            "data": {
                "meta": [],
                "items": [
                    {
                        "meta": [],
                        "items": [],
                        "content": "Comprehensive oral examinations"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Teeth cleaning and fluoride treatment"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Digital X-rays for precise diagnosis\nRoutine visits to our dental clinic ensure healthy teeth and gums throughout your life."
                    }
                ],
                "style": "unordered"
            },
            "type": "list"
        },
        {
            "id": "Hn0AWQIekk",
            "data": {
                "text": "2. Orthodontic Treatments: Align Your Smile with Confidence\nOur experienced orthodontist provides advanced solutions for correcting teeth alignment and bite issues. We offer a variety of orthodontic treatments suitable for all ages."
            },
            "type": "paragraph"
        },
        {
            "id": "FdfRUwNy2L",
            "data": {
                "meta": [],
                "items": [
                    {
                        "meta": [],
                        "items": [],
                        "content": "Braces (metal and ceramic)"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Invisalign and clear aligners"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Early intervention for children and teens\nOur customized orthodontic care helps improve both function and aesthetics, giving you a perfect smile."
                    }
                ],
                "style": "unordered"
            },
            "type": "list"
        },
        {
            "id": "kNLN6Vt5_P",
            "data": {
                "text": "3. Cosmetic Dentistry: Transform Your Smile\nLooking for a smile makeover? Realign Dental Clinic offers a range of cosmetic dentistry services to enhance the appearance of your teeth."
            },
            "type": "paragraph"
        },
        {
            "id": "7VR0JsDMQd",
            "data": {
                "meta": [],
                "items": [
                    {
                        "meta": [],
                        "items": [],
                        "content": "Teeth whitening for a brighter smile"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Veneers to correct chipped or discolored teeth"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Smile design and contouring\nOur expert dentists use advanced tools and techniques to deliver flawless cosmetic results."
                    }
                ],
                "style": "unordered"
            },
            "type": "list"
        },
        {
            "id": "YK1lvMt0t1",
            "data": {
                "text": "4. Restorative Dentistry: Repair and Replace Damaged Teeth\nIf you have damaged or missing teeth, our dental clinic offers effective restorative solutions to bring back your oral health."
            },
            "type": "paragraph"
        },
        {
            "id": "hDvCY_I253",
            "data": {
                "meta": [],
                "items": [
                    {
                        "meta": [],
                        "items": [],
                        "content": "Tooth-colored fillings and crowns"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Root canal treatments"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Dental implants and bridges\nWith a focus on long-lasting results, our restorative services improve both function and appearance."
                    }
                ],
                "style": "unordered"
            },
            "type": "list"
        },
        {
            "id": "zdeH-eHMON",
            "data": {
                "text": "5. Pediatric Dentistry: Caring for Young Smiles\nWe understand that children need special care. Our friendly dentists make visits fun and comfortable for kids while focusing on preventive dental care."
            },
            "type": "paragraph"
        },
        {
            "id": "H4IVJcPT12",
            "data": {
                "meta": [],
                "items": [
                    {
                        "meta": [],
                        "items": [],
                        "content": "Fluoride treatments and sealants"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Cavity prevention education"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Orthodontic evaluations for growing children\nWe aim to make every child’s visit a positive experience to build lifelong healthy dental habits."
                    }
                ],
                "style": "unordered"
            },
            "type": "list"
        },
        {
            "id": "z7fW88LTDf",
            "data": {
                "text": "6. Emergency Dental Care: Relief When You Need It\nDental emergencies can happen unexpectedly. Our clinic provides prompt care for issues like toothaches, injuries, or broken restorations."
            },
            "type": "paragraph"
        },
        {
            "id": "H2eeHqew7A",
            "data": {
                "meta": [],
                "items": [
                    {
                        "meta": [],
                        "items": [],
                        "content": "Emergency appointments for immediate relief"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Treatment of tooth fractures and infections"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Management of severe pain and swelling\nRealign Dental Clinic is always ready to help during your time of need."
                    }
                ],
                "style": "unordered"
            },
            "type": "list"
        },
        {
            "id": "_jKRLeiB39",
            "data": {
                "text": "Meet Our Expert Team\nAt Realign Dental Clinic, we take pride in our highly qualified team of dentists and orthodontists. With years of experience and a passion for patient care, we ensure that every treatment is safe, effective, and tailored to your needs. Our friendly staff makes sure that you feel comfortable throughout your visit."
            },
            "type": "paragraph"
        },
        {
            "id": "0rw9r1jyg3",
            "data": {
                "text": "Why Regular Dental Visits are Essential"
            },
            "type": "paragraph"
        },
        {
            "id": "Aph8hYH7fN",
            "data": {
                "meta": [],
                "items": [
                    {
                        "meta": [],
                        "items": [],
                        "content": "Prevents dental issues from becoming severe"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Ensures timely treatment for misaligned teeth"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Maintains optimal oral hygiene"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Provides professional advice from skilled dentists and orthodontists\nWith the right care from our dental clinic, you can enjoy a lifetime of healthy smiles!"
                    }
                ],
                "style": "unordered"
            },
            "type": "list"
        },
        {
            "id": "tKMjTQBE6a",
            "data": {
                "text": "Conclusion: Healthy Smiles Start at Realign Dental Clinic\nAt Realign Dental Clinic, we are dedicated to providing exceptional dental care in Mansarovar, Jaipur. From routine check-ups to advanced orthodontic treatments, our expert dentists and orthodontists are here to ensure your oral health is in the best hands. We focus not only on treatment but also on preventive care to help you maintain a healthy, confident smile for life.\nWhether you need dental care for your family, orthodontic solutions, or cosmetic dentistry, Realign Dental Clinic offers personalized services in a friendly and comfortable environment. Visit us today and take the first step towards better oral health!"
            },
            "type": "paragraph"
        },
        {
            "id": "wVlIxWe4hO",
            "data": {
                "text": "Visit Realign Dental Clinic for the Best Dental Care in Jaipur\nAt Realign Dental Clinic, we are committed to providing comprehensive dental care with a patient-first approach. Whether you need a routine check-up, orthodontic consultation, or cosmetic dental treatment, we’ve got you covered. Trust us to give you the best care for all your dental needs.\nYour journey to a healthier smile starts here—schedule your appointment today!"
            },
            "type": "paragraph"
        }
    ],
    "version": "2.31.0-rc.7"
}',
            ]);

            $branchStore->meta()->updateOrCreate(
                ['seoable_id' => $branchStore->id, 'seoable_type' => Branch::class],
                [
                    'title' => $branch['name'] . ' | Realign Dental Clinic',
                    'description' => $branch['tagline'],
                    'keywords' => ['dental clinic', 'dentist', 'orthodontist', 'dental care', 'Jaipur'],
                ]
            );

        }
    }
}
