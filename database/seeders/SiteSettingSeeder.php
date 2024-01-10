<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $siteSettings = [
            [
                'custom_id'=>'slogan',
                'title'=>'Slogan',
                'description'=>'Your guide to international hooks.',
                'isPublished'=>true,
                'published_by'=>1,
                'published_at'=>now(),
            ],
            [
                'custom_id'=>'logo',
                'title'=>'Logo',
                'description'=>'logo.jpg',
                'isPublished'=>true,
                'published_by'=>1,
                'published_at'=>now(),
            ],
            [
                'custom_id'=>'appname',
                'title'=>'App Name',
                'description'=>'Wostac',
                'isPublished'=>true,
                'published_by'=>1,
                'published_at'=>now(),
            ],
            [
                'custom_id'=>'mission',
                'title'=>'Our Mission',
                'description'=>'Our mission is to empower individuals to pursue international work and study opportunities, ensuring access to quality education and meaningful career pathways. We strive to be a trusted partner, guiding our clients through every step of their journey, from academic pursuits to professional placements.',
                'isPublished'=>true,
                'published_by'=>1,
                'published_at'=>now(),
            ],
            [
                'custom_id'=>'vision',
                'title'=>'Our Vision',
                'description'=>'Our vision is to be a guiding force in transforming aspirations into tangible achievements, creating a global community of empowered individuals who thrive in diverse cultures and contribute meaningfully to the world. ',
                'isPublished'=>true,
                'published_by'=>1,
                'published_at'=>now(),
            ],
            [
                'custom_id'=>'address',
                'title'=>'Location or Address',
                'description'=>'Westlands Drive Nairobi, Kenya',
                'isPublished'=>true,
                'published_by'=>1,
                'published_at'=>now(),
            ],
            [
                'custom_id'=>'contact',
                'title'=>'Office Phone',
                'description'=>'+31 6 36387766 / +31 6 19757288',
                'isPublished'=>true,
                'published_by'=>1,
                'published_at'=>now(),
            ],
            [
                'custom_id'=>'email',
                'title'=>'Email Address',
                'description'=>'info@wostac.com',
                'isPublished'=>true,
                'published_by'=>1,
                'published_at'=>now(),
            ],
        ];

        foreach ($siteSettings as $setting) {
            SiteSetting::create($setting);
        }
    }
}
