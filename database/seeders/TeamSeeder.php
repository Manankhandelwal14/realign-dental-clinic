<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Team;
use Illuminate\Http\UploadedFile;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teamMembers = [
            [
                'name' => 'Dr. Anjali Uttwani Arora',
                'designation' => 'Orthodontist, Smile Stylist & Co-founder, Realign Dental Clinic',
                'description' => 'Gold Medalist Orthodontist at Realign Dental Clinic, Jaipur, specializing in invisible aligners, digital smile designing, and painless dentistry to craft your perfect, confident smile!',
                'image' => '1.png',
                'content' => '{
    "time": 1749488103681,
    "blocks": [
        {
            "id": "pHnuW82Loe",
            "data": {
                "text": "Dr. Anjali Uttwani Arora – Orthodontist and Co-founder of Realign Dental Clinic",
                "level": 1
            },
            "type": "header"
        },
        {
            "id": "E-UjTz_Wlz",
            "data": {
                "text": "About Dr. Anjali",
                "level": 2
            },
            "type": "header"
        },
        {
            "id": "Ndf6cazrve",
            "data": {
                "text": "Dr. Anjali Uttwani Arora is an orthodontist and co-founder of Realign Dental Clinic, passionate about creating confident smiles through innovative dental care. She specializes in modern orthodontic solutions, including digital smile design, invisible aligners, and painless treatments, ensuring every patient leaves with a smile they love."
            },
            "type": "paragraph"
        },
        {
            "id": "ZastwO8c1T",
            "data": {
                "text": "Professional Background",
                "level": 2
            },
            "type": "header"
        },
        {
            "id": "T4UU4vuX5C",
            "data": {
                "text": "Dr. Anjali holds an MDS in Orthodontics and Dentofacial Orthopedics, where she earned a Gold Medal for her excellence. She has practiced at Mahatma Gandhi Dental College &amp; Hospital and served as a Senior Lecturer at Mahatma Gandhi University of Health Sciences, guiding the next generation of dental professionals. Her focus is on blending science and artistry to deliver exceptional results."
            },
            "type": "paragraph"
        },
        {
            "id": "cyGcBbtyxt",
            "data": {
                "text": "Expertise",
                "level": 2
            },
            "type": "header"
        },
        {
            "id": "X58dJB-Hd4",
            "data": {
                "meta": [],
                "items": [
                    {
                        "meta": [],
                        "items": [],
                        "content": "Gold Medalist in Orthodontics and Dentofacial Orthopedics"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Expert in smile aesthetics and jaw alignment corrections"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Proficient in invisible aligners, digital smile design, and painless dentistry"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Co-founder of Realign Dental Clinic, where advanced technology meets personalized care"
                    }
                ],
                "style": "unordered"
            },
            "type": "list"
        },
        {
            "id": "MOlCIXJqj5",
            "data": {
                "text": "Achievements",
                "level": 2
            },
            "type": "header"
        },
        {
            "id": "RIyhcrnFhU",
            "data": {
                "meta": [],
                "items": [
                    {
                        "meta": [],
                        "items": [],
                        "content": "Presented award-winning research on surgical orthodontics and laser therapy"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Participated in international conferences on cutting-edge orthodontic techniques"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Trained in 3D digital orthodontics, self-ligating brackets, and mobile dental photography"
                    }
                ],
                "style": "unordered"
            },
            "type": "list"
        },
        {
            "id": "izRiHtZyYz",
            "data": {
                "text": "Languages Spoken",
                "level": 2
            },
            "type": "header"
        },
        {
            "id": "x1OK67taNH",
            "data": {
                "meta": [],
                "items": [
                    {
                        "meta": [],
                        "items": [],
                        "content": "English"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Hindi"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Sindhi"
                    }
                ],
                "style": "unordered"
            },
            "type": "list"
        },
        {
            "id": "hPbjMUNq1X",
            "data": {
                "text": "Why Choose Dr. Anjali?",
                "level": 2
            },
            "type": "header"
        },
        {
            "id": "NJyGepTIpt",
            "data": {
                "text": "With a commitment to transforming smiles and boosting confidence, Dr. Anjali combines expertise, innovation, and a patient-centered approach to deliver outstanding orthodontic care at Realign Dental Clinic."
            },
            "type": "paragraph"
        }
    ],
    "version": "2.31.0-rc.7"
}',
                'html' => '<h1 class="ce-header">Dr. Anjali Uttwani Arora – Orthodontist and Co-founder of Realign Dental Clinic</h1><h2 class="ce-header">About Dr. Anjali</h2><p class="cdx-block">Dr. Anjali Uttwani Arora is an orthodontist and co-founder of Realign Dental Clinic, passionate about creating confident smiles through innovative dental care. She specializes in modern orthodontic solutions, including digital smile design, invisible aligners, and painless treatments, ensuring every patient leaves with a smile they love.</p><h2 class="ce-header">Professional Background</h2><p class="cdx-block">Dr. Anjali holds an MDS in Orthodontics and Dentofacial Orthopedics, where she earned a Gold Medal for her excellence. She has practiced at Mahatma Gandhi Dental College &amp; Hospital and served as a Senior Lecturer at Mahatma Gandhi University of Health Sciences, guiding the next generation of dental professionals. Her focus is on blending science and artistry to deliver exceptional results.</p><h2 class="ce-header">Expertise</h2><ul class="cdx-list"><li class="cdx-list__item">Gold Medalist in Orthodontics and Dentofacial Orthopedics</li><li class="cdx-list__item">Expert in smile aesthetics and jaw alignment corrections</li><li class="cdx-list__item">Proficient in invisible aligners, digital smile design, and painless dentistry</li><li class="cdx-list__item">Co-founder of Realign Dental Clinic, where advanced technology meets personalized care</li></ul><h2 class="ce-header">Achievements</h2><ul class="cdx-list"><li class="cdx-list__item">Presented award-winning research on surgical orthodontics and laser therapy</li><li class="cdx-list__item">Participated in international conferences on cutting-edge orthodontic techniques</li><li class="cdx-list__item">Trained in 3D digital orthodontics, self-ligating brackets, and mobile dental photography</li></ul><h2 class="ce-header">Languages Spoken</h2><ul class="cdx-list"><li class="cdx-list__item">English</li><li class="cdx-list__item">Hindi</li><li class="cdx-list__item">Sindhi</li></ul><h2 class="ce-header">Why Choose Dr. Anjali?</h2><p class="cdx-block">With a commitment to transforming smiles and boosting confidence, Dr. Anjali combines expertise, innovation, and a patient-centered approach to deliver outstanding orthodontic care at Realign Dental Clinic.</p>',
                'meta' => [
                    'title' => 'Dr. Anjali Uttwani Arora - Orthodontist and Co-founder of Realign Dental Clinic',
                    'description' => 'Gold Medalist Orthodontist at Realign Dental Clinic, Jaipur, specializing in invisible aligners, digital smile designing, and painless dentistry to craft your perfect, confident smile!',
                    'keywords' => 'Dr. Anjali Uttwani Arora, Orthodontist, Co-founder, Realign Dental Clinic, Jaipur, Invisible Aligners, Digital Smile Design, Painless Dentistry',
                ]
            ],
            [
                'name' => 'Dr. Ayush Arora',
                'designation' => 'Co-founder | Dental Surgeon | Perfectionist in Precision Dentistry',
                'description' => 'Co-founder of Realign Dental Clinic, specializing in restorative, cosmetic, and pain-free dentistry with advanced tech for stunning smile makeovers.',
                'image' => '2.png',
                'content' => '{
    "time": 1749490020829,
    "blocks": [
        {
            "id": "rOWMLJTrob",
            "data": {
                "text": "Dr. Ayush Arora – Dental Surgeon and Co-founder of Realign Dental Clinic",
                "level": 1
            },
            "type": "header"
        },
        {
            "id": "KIjY31vuvQ",
            "data": {
                "text": "About Dr. Ayush",
                "level": 2
            },
            "type": "header"
        },
        {
            "id": "0tFOyc3Lhs",
            "data": {
                "text": "Dr. Ayush Arora is a dedicated Dental Surgeon and Co-founder of Realign Dental Clinic, where he combines precision, innovation, and a patient-first approach to create confident smiles. His expertise in modern dentistry ensures every treatment is effective, comfortable, and tailored to meet individual needs."
            },
            "type": "paragraph"
        },
        {
            "id": "WQ1EI40bDp",
            "data": {
                "text": "Professional Background",
                "level": 2
            },
            "type": "header"
        },
        {
            "id": "FEW_NSp2-0",
            "data": {
                "text": "Dr. Ayush earned his BDS from KLE Dental College, Belgaum, a renowned institution known for its rigorous training. As a co-founder of Realign Dental Clinic, he is committed to redefining dental care by integrating advanced technology and pain-free techniques to deliver exceptional results."
            },
            "type": "paragraph"
        },
        {
            "id": "DPUR_KHSqg",
            "data": {
                "text": "Expertise",
                "level": 2
            },
            "type": "header"
        },
        {
            "id": "Ygu67fsc2h",
            "data": {
                "meta": [],
                "items": [
                    {
                        "meta": [],
                        "items": [],
                        "content": "Specialist in restorative and cosmetic dentistry for smile enhancements"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Proficient in cutting-edge technologies, including digital X-rays and 3D treatment planning"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Skilled in delivering pain-free dental treatments for a stress-free experience"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Co-founder of Realign Dental Clinic, driving innovation in patient care"
                    }
                ],
                "style": "unordered"
            },
            "type": "list"
        },
        {
            "id": "GNgMu5pCHn",
            "data": {
                "text": "Achievements",
                "level": 2
            },
            "type": "header"
        },
        {
            "id": "Upq7fzOXIn",
            "data": {
                "meta": [],
                "items": [
                    {
                        "meta": [],
                        "items": [],
                        "content": "Trained in advanced restorative and cosmetic dental procedures"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Expert in leveraging digital tools for precise diagnostics and treatment planning"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Recognized for creating a welcoming, patient-centered dental environment"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Committed to making dentistry accessible, modern, and comfortable"
                    }
                ],
                "style": "unordered"
            },
            "type": "list"
        },
        {
            "id": "ap8Jne-Jiy",
            "data": {
                "text": "Why Choose Dr. Ayush?",
                "level": 2
            },
            "type": "header"
        },
        {
            "id": "S5IjauomRM",
            "data": {
                "text": "Dr. Ayush’s passion for precision dentistry, combined with his innovative use of technology and focus on patient comfort, makes him a trusted choice at Realign Dental Clinic. He is dedicated to crafting smiles that inspire confidence and reflect each patient’s unique personality."
            },
            "type": "paragraph"
        }
    ],
    "version": "2.31.0-rc.7"
}',
                'html' => '<h1 class="ce-header">Dr. Ayush Arora – Dental Surgeon and Co-founder of Realign Dental Clinic</h1><h2 class="ce-header">About Dr. Ayush</h2><p class="cdx-block">Dr. Ayush Arora is a dedicated Dental Surgeon and Co-founder of Realign Dental Clinic, where he combines precision, innovation, and a patient-first approach to create confident smiles. His expertise in modern dentistry ensures every treatment is effective, comfortable, and tailored to meet individual needs.</p><h2 class="ce-header">Professional Background</h2><p class="cdx-block">Dr. Ayush earned his BDS from KLE Dental College, Belgaum, a renowned institution known for its rigorous training. As a co-founder of Realign Dental Clinic, he is committed to redefining dental care by integrating advanced technology and pain-free techniques to deliver exceptional results.</p><h2 class="ce-header">Expertise</h2><ul class="cdx-list"><li class="cdx-list__item">Specialist in restorative and cosmetic dentistry for smile enhancements</li><li class="cdx-list__item">Proficient in cutting-edge technologies, including digital X-rays and 3D treatment planning</li><li class="cdx-list__item">Skilled in delivering pain-free dental treatments for a stress-free experience</li><li class="cdx-list__item">Co-founder of Realign Dental Clinic, driving innovation in patient care</li></ul><h2 class="ce-header">Achievements</h2><ul class="cdx-list"><li class="cdx-list__item">Trained in advanced restorative and cosmetic dental procedures</li><li class="cdx-list__item">Expert in leveraging digital tools for precise diagnostics and treatment planning</li><li class="cdx-list__item">Recognized for creating a welcoming, patient-centered dental environment</li><li class="cdx-list__item">Committed to making dentistry accessible, modern, and comfortable</li></ul><h2 class="ce-header">Why Choose Dr. Ayush?</h2><p class="cdx-block">Dr. Ayush’s passion for precision dentistry, combined with his innovative use of technology and focus on patient comfort, makes him a trusted choice at Realign Dental Clinic. He is dedicated to crafting smiles that inspire confidence and reflect each patient’s unique personality.</p>',
                'meta' => [
                    'title' => 'Dr. Ayush Arora - Dental Surgeon and Co-founder of Realign Dental Clinic',
                    'description' => 'Co-founder of Realign Dental Clinic, specializing in restorative, cosmetic, and pain-free dentistry with advanced tech for stunning smile makeovers.',
                    'keywords' => 'Dr. Ayush Arora, Dental Surgeon, Co-founder, Realign Dental Clinic, Restorative Dentistry, Cosmetic Dentistry, Pain-free Dentistry',
                ]
            ],
            [
                'name' => 'Dr. Mitali Arora',
                'designation' => 'Creative Head & Dental Surgeon | Smile Enthusiast',
                'description' => 'Creative Head at Realign Dental Clinic, blending art and science for stunning smile makeovers with expertise in clear aligners, painless restorations, and preventive care.',
                'image' => '3.png',
                'content' => '{
    "time": 1749489311271,
    "blocks": [
        {
            "id": "STwDcSE38S",
            "data": {
                "text": "Dr. Mitali Arora – Dental Surgeon and Creative Head of Realign Dental Clinic",
                "level": 1
            },
            "type": "header"
        },
        {
            "id": "pFjID9Oz5s",
            "data": {
                "text": "About Dr. Mitali",
                "level": 2
            },
            "type": "header"
        },
        {
            "id": "IcyQYQoWSt",
            "data": {
                "text": "Dr. Mitali Arora is a skilled Dental Surgeon and the Creative Head at Realign Dental Clinic, where she blends artistry and science to craft confident, radiant smiles. With a patient-centered approach, she ensures every visit is comfortable, modern, and tailored to deliver stunning results."
            },
            "type": "paragraph"
        },
        {
            "id": "rjVuydTOEb",
            "data": {
                "text": "Professional Background",
                "level": 2
            },
            "type": "header"
        },
        {
            "id": "lWk1-N5QYy",
            "data": {
                "text": "Dr. Mitali holds a BDS from Mahatma Gandhi University of Medical Science &amp; Technology. Her passion for innovative dentistry drives her to stay at the forefront of dental advancements, specializing in pain-free treatments and transformative smile makeovers that leave patients feeling confident and ready to shine."
            },
            "type": "paragraph"
        },
        {
            "id": "o-7xAzK-xe",
            "data": {
                "text": "Expertise",
                "level": 2
            },
            "type": "header"
        },
        {
            "id": "5gPHxLTDT9",
            "data": {
                "meta": [],
                "items": [
                    {
                        "meta": [],
                        "items": [],
                        "content": "Expert in restorative dentistry, preventive care, and clear aligner treatments"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Proficient in digital scanning, 3D imaging, and advanced dental technologies"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Skilled in gentle extractions and painless smile transformations"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Creative leader at Realign Dental Clinic, combining vision with dental precision"
                    }
                ],
                "style": "unordered"
            },
            "type": "list"
        },
        {
            "id": "6lkH0UvmzT",
            "data": {
                "text": "Achievements",
                "level": 2
            },
            "type": "header"
        },
        {
            "id": "x-ADOvt242",
            "data": {
                "meta": [],
                "items": [
                    {
                        "meta": [],
                        "items": [],
                        "content": "Specialized in clear aligner treatments for discreet teeth straightening"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Trained in cutting-edge dental technologies, including digital scanning and 3D imaging"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Advocates for preventive dentistry to promote long-term oral health"
                    },
                    {
                        "meta": [],
                        "items": [],
                        "content": "Recognized for a friendly, approachable style that puts patients at ease"
                    }
                ],
                "style": "unordered"
            },
            "type": "list"
        },
        {
            "id": "k8tbIBuAI8",
            "data": {
                "text": "Why Choose Dr. Mitali?",
                "level": 2
            },
            "type": "header"
        },
        {
            "id": "UFKTDWlLzy",
            "data": {
                "text": "Dr. Mitali’s unique blend of creativity, technical expertise, and a warm, welcoming demeanor makes her a standout at Realign Dental Clinic. Whether it’s a smile makeover or preventive care, she’s dedicated to delivering exceptional results with a stress-free experience."
            },
            "type": "paragraph"
        }
    ],
    "version": "2.31.0-rc.7"
}',
                'html' => '<h1 class="ce-header">Dr. Mitali Arora – Dental Surgeon and Creative Head of Realign Dental Clinic</h1><h2 class="ce-header">About Dr. Mitali</h2><p class="cdx-block">Dr. Mitali Arora is a skilled Dental Surgeon and the Creative Head at Realign Dental Clinic, where she blends artistry and science to craft confident, radiant smiles. With a patient-centered approach, she ensures every visit is comfortable, modern, and tailored to deliver stunning results.</p><h2 class="ce-header">Professional Background</h2><p class="cdx-block">Dr. Mitali holds a BDS from Mahatma Gandhi University of Medical Science &amp; Technology. Her passion for innovative dentistry drives her to stay at the forefront of dental advancements, specializing in pain-free treatments and transformative smile makeovers that leave patients feeling confident and ready to shine.</p><h2 class="ce-header">Expertise</h2><ul class="cdx-list"><li class="cdx-list__item">Expert in restorative dentistry, preventive care, and clear aligner treatments</li><li class="cdx-list__item">Proficient in digital scanning, 3D imaging, and advanced dental technologies</li><li class="cdx-list__item">Skilled in gentle extractions and painless smile transformations</li><li class="cdx-list__item">Creative leader at Realign Dental Clinic, combining vision with dental precision</li></ul><h2 class="ce-header">Achievements</h2><ul class="cdx-list"><li class="cdx-list__item">Specialized in clear aligner treatments for discreet teeth straightening</li><li class="cdx-list__item">Trained in cutting-edge dental technologies, including digital scanning and 3D imaging</li><li class="cdx-list__item">Advocates for preventive dentistry to promote long-term oral health</li><li class="cdx-list__item">Recognized for a friendly, approachable style that puts patients at ease</li></ul><h2 class="ce-header">Why Choose Dr. Mitali?</h2><p class="cdx-block">Dr. Mitali’s unique blend of creativity, technical expertise, and a warm, welcoming demeanor makes her a standout at Realign Dental Clinic. Whether it’s a smile makeover or preventive care, she’s dedicated to delivering exceptional results with a stress-free experience.</p>',
                'meta' => [
                    'title' => 'Dr. Mitali Arora - Dental Surgeon and Creative Head of Realign Dental Clinic',
                    'description' => 'Creative Head at Realign Dental Clinic, blending art and science for stunning smile makeovers with expertise in clear aligners, painless restorations, and preventive care.',
                    'keywords' => 'Dr. Mitali Arora, Dental Surgeon, Creative Head, Realign Dental Clinic, Smile Makeovers, Clear Aligners, Preventive Care',
                ]
            ],
        ];

        foreach ($teamMembers as $key => $member) {
            $publicPath = public_path('images/doctors/' . $member['image']);
            if (File::exists($publicPath)) {
                $team = Team::create([
                    'name' => $member['name'],
                    'designation' => $member['designation'],
                    'sort_description' => $member['description'],
                    'featured' => 1,
                    'status' => 1,
                    'order' => $key + 1,
                ]);

                $originalName = $member['image'] ?? basename($publicPath);

                $profileImage = new UploadedFile(
                    $publicPath,
                    $originalName,
                    File::mimeType($publicPath),
                    null,
                    true // Set to true to bypass upload validation
                );

                // Add media using UploadedFile instances
                $team->addMedia($profileImage, 'image', 'public');

                // add content and html
                if (isset($member['content']) && isset($member['html'])) {
                    if ($team->content) {
                        $team->content()->update([
                            'content' => $member['content'],
                            'html' => $member['html'],
                        ]);
                    } else {
                        $team->content()->create([
                            'content' => json_decode($member['content']),
                            'html' => $member['html'],
                        ]);
                    }
                }

                if (isset($member['meta'])) {
                    $team->meta()->updateOrCreate(
                        ['seoable_id' => $team->id, 'seoable_type' => Team::class],
                        [
                            'title' => $member['meta']['title'],
                            'description' => $member['meta']['description'],
                            'keywords' => explode(',', $member['meta']['keywords']),
                        ]
                    );
                }
            }
        }
    }
}
