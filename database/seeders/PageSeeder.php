<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
            [
                'user_id' => 1,
                'name' => 'home',
                'sections' => [
                    [
                        'name' => 'Section 1',
                        'title' => 'Welcome',
                        'intro' => 'Welcome to Wostac & <span class="title-secondary">Consult</span>.',
                        'description' => 'Welcome to Wosta Consult, your premier global agency for education, migration, and internship solutions. We specialize in guiding individuals towards their academic, professional, and personal goals on a global scale. Our expert team ensures a seamless transition into top-notch educational programs worldwide, providing comprehensive support for undergraduate and postgraduate studies, assisting in visa processes and connecting individuals with placements that align with their career goals.',

                        'image' => 'about-section1.jpg',
                        'footer'=>'',
                        'points' => [
                            'Providers of top quality career counseling and advisory services',
                            'Providers of best student placement opportunities',
                            'Easy approval by choosing top visa consultant',
                        ]
                    ],
                    [
                        'name' => 'Section 2',
                        'title' => 'Our Services',
                        'intro' => 'We provide expert <span class="title-secondary">Services</span>.',
                        'description' => '',
                        'image' => '',
                        'footer'=>''
                    ],
                    [
                        'name' => 'Section 3',
                        'title' => 'What We Do',
                        'intro' => 'We provide expert advisory services on <span class="title-secondary">work & study</span> placements.',
                        'description' => 'Wosta Consult, specializes in delivering expert advisory services on work and study placements. We are dedicated to guiding individuals through the intricate landscapes of international opportunities, smoothly blending academic pursuits with professional growth. Our team of seasoned advisors is committed to offering personalized insights, ensuring that every step of your journey towards work and study abroad is informed and strategically planned.',
                        'image' => 'home-section3.jpg',
                        'footer'=>''
                    ],
                    [
                        'name' => 'Section 4',
                        'title' => 'Favourite Destinations',
                        'intro' => 'Study in Your Dream <span class="title-secondary">Country</span>.',
                        'description' => '',
                        'image' => '',
                        'footer'=>''
                    ],
                    [
                        'name' => 'Section 5',
                        'title' => 'Testimonials',
                        'intro' => 'Feedback from <span class="title-secondary">Clients</span>.',
                        'description' => '',
                        'image' => 'home-section3.jpg',
                        'footer'=>''
                    ],
                    [
                        'name' => 'Section 6',
                        'title' => '',
                        'intro' => '',
                        'description' => '',
                        'image' => '',
                        'footer'=>''
                    ],
                    [
                        'name' => 'Section 7',
                        'title' => 'Latest News',
                        'intro' => 'Get informed from our pool of <span class="title-secondary">resourceful articles</span>.',
                        'description' => '',
                        'image' => '',
                        'footer'=>''
                    ],
                    [
                        'name' => 'Section 8',
                        'title' => '',
                        'intro' => '',
                        'description' => '',
                        'image' => '',
                        'footer'=>''
                    ],
                ],
                'isPublished' => false,
            ],
            [
                'user_id'=>1,
                'name'=>'about',
                'sections' => [
                    [
                        'name' => 'Section 1',
                        'title' => 'Why choose us',
                        'intro' => 'Why choose Wostac <span class="title-secondary">Consult</span>.',
                        'description' => 'Wosta Consult is a premier global agency for education, migration, and internship solutions. We specialize in guiding individuals towards their academic, professional, and personal goals on a global scale. Our expert team ensures a seamless transition into top-notch educational programs worldwide, providing comprehensive support for undergraduate and postgraduate studies, assisting in visa processes and connecting individuals with placements that align with their career goals.',
                        'image' => 'about-section1.jpg',
                        'footer'=>'',
                        'points' => [
                            'Providers of top quality career counseling and advisory services',
                            'Providers of best student placement opportunities',
                            'Easy approval by choosing top visa consultant',
                        ]
                    ],
                    [
                        'name' => 'Section 2',
                        'title' => 'What we offer',
                        'intro' => 'We create solutions for your future <span class="title-secondary">education & travel</span>',
                        'description' => '',
                        'image' => '',
                        'footer'=>''
                    ],
                    [
                        'name' => 'Section 3',
                        'title' => 'Our Team Members',
                        'intro' => 'Discover Wostac\'s <span class="title-secondary">Experts</span>',
                        'description' => '',
                        'image' => '',
                        'footer'=>''
                    ],
                    [
                        'name' => 'Section 4',
                        'title' => '',
                        'intro' => '',
                        'description' => '',
                        'image' => '',
                        'footer'=>''
                    ],
                    [
                        'name' => 'Section 5',
                        'title' => '',
                        'intro' => '',
                        'description' => '',
                        'image' => '',
                        'footer'=>''
                    ],
                ],
                'isPublished' => false,
            ],

        ];

        foreach($pages as $page){
            Page::create($page);
        }
    }
}
