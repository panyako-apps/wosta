<?php

namespace Database\Seeders;

use App\Models\Slide;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slides = [
            [
                'user_id'=>1,
                'slideshow_id'=>1,
                'title'=>'Grab an <span class="text-secondary">opportunity to</span>',
                'image'=> 'slideshow1-1.jpg',
                'description'=> 'Work and Study <span class="title-secondary">Abroad</span>',
                'isPublished'=> true,
                'published_by'=>1,
                'published_at'=>now(),
            ],
            [
                'user_id'=>1,
                'slideshow_id'=>1,
                'title'=>'Experience <span class="text-secondary">firsthand</span>',
                'image'=> 'slideshow1-2.jpg',
                'description'=> 'Career-Focused <span class="title-secondary">Counseling</span> for Success.',
                'isPublished'=> true,
                'published_by'=>1,
                'published_at'=>now(),
            ],
            [
                'user_id'=>1,
                'slideshow_id'=>1,
                'title'=>'Professional <span class="text-secondary">guidance on</span>',
                'image'=> 'slideshow1-3.jpg',
                'description'=> 'Visa & Passport <span class="title-secondary">Processing</span>.',
                'isPublished'=> true,
                'published_by'=>1,
                'published_at'=>now(),
            ],
            [
                'user_id'=>1,
                'slideshow_id'=>1,
                'title'=>'We <span class="text-secondary">highlight</span>',
                'image'=> 'slideshow1-4.jpg',
                'description'=> 'Document Integrity to <span class="title-secondary">Quicken</span> your Transition.',
                'isPublished'=> true,
                'published_by'=>1,
                'published_at'=>now(),
            ],
         
        ];

        foreach ($slides as $slide) {
            Slide::create($slide);
        }
    }
}
