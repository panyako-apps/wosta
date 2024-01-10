<?php

namespace Database\Seeders;

use App\Models\Slideshow;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SlideshowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slideshows = [
            [
                'user_id'=>1,
                'name'=>'Featured Services',
                'slug'=>'featured-services',
                'position'=> 'homepage-hero-section',
                'description'=> 'Will be placed at the home page, Hero section.',
                'isPublished'=> true,
            ],
        ];

        foreach ($slideshows as $slideshow) {
            Slideshow::create($slideshow);
        }
    }
}

